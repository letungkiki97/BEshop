<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Page;
use App\Models\Customer;
use App\Models\CustomerType;
use App\Models\Saleorder;
use App\Models\SaleorderProduct;
use App\Models\City;
use App\Models\District;
use App\Models\Advice;
use App\Models\Category;
use App\Models\Newsletter;
use App\Models\EmailTemplate;
use App\Models\Role;
use App\Models\Footer;
use Carbon\Carbon;
use Validator;
use Settings;
use Auth;
use Mail;
use DB;
use Illuminate\Support\Facades\App;
use App\Models\Image;

class HomeController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['only' => ['getOrder']]);
    }

    public function info(Request $request) {
        $list = ['hotline', 'site_logo', 'shipping_return', 'why_buy', 'title_1', 'content_1', 'link_1', 'title_2', 'content_2', 'link_2', 'title_3', 'content_3', 'link_3', 'title_4', 'content_4', 'link_4', 'category_top', 'category_middle', 'payment', 'facebook', 'instagram', 'pinterest', 'zalo', 'youtube'];
        $info = [];
        foreach ($list as $val) {
            $info[$val] = Settings::get($val);
        }
        return response()->json([
            'message'     => 'OK',
            'status_code' => 200,
            'info'        => $info,
        ], 200);
    }

    public function menu(Request $request) {
        $menu = Menu::with('sibling')->where(['parent_id' => 0, 'status' => 1])->orderBy('position', 'asc')->get();
        return response()->json([
            'message'     => 'OK',
            'status_code' => 200,
            'menu'        => $menu,
        ], 200);
    }

    public function footer(Request $request) {
        $footer = Footer::with('sibling')->where(['parent_id' => 0, 'status' => 1])->orderBy('position', 'asc')->get();
        return response()->json([
            'message'     => 'OK',
            'status_code' => 200,
            'footer'        => $footer,
        ], 200);
    }

    public function banner(Request $request) {
        $banner = Banner::with('images')->get();
        return response()->json([
            'message'       => 'OK',
            'status_code'   => 200,
            'banner'        => $banner,
        ], 200);
    }

    public function page(Request $request) {
        if (!$request->slug) {
            return response()->json([
                'message'     => 'Slug là bắt buộc',
                'status_code' => 401,
            ], 200);
        }
        $page = Page::where('slug', $request->slug)->first();
        if (!$page) {
            return response()->json([
                'message'     => 'Không tìm thấy trang',
                'status_code' => 404,
            ], 200);
        }
        return response()->json([
            'message'       => 'OK',
            'status_code'   => 200,
            'page'          => $page,
        ], 200);
    }

    public function getOrder(Request $request) {
        $user = Customer::where('api_token', $request->api_token)->first();
        if (!$user) {
            return response()->json([
                'message'     => 'Không tìm thấy người dùng',
                'status_code' => 404,
            ], 200);
        }
        $order = Saleorder::with('product_list', 'delivery', 'deliveryAgency')->where('customer_id', $user->id)->orderBy('id', 'desc')->get();

        if(count($order) > 0){
            foreach ($order as $item) {
                if($item->status == 'Cancelled'){
                    $item->shipping_fee = 0;
                    $item->final_price  = 0;
                }
            }
        }

        return response()->json([
            'message'       => 'OK',
            'status_code'   => 200,
            'order' => $order,
        ], 200);
    }

    public function postCheckPhoneOrder(Request $request){
        $check_phone  = Customer::where('phone_number', $request->phone)->first();
        $check_email  = Customer::where('contact_email', $request->email)->first();
        if(isset($request->api_token)){
            $check_phone = $check_email = false;
        }
        
        if($check_email){
            return response()->json([
                'message'       => 'Email đã được đăng ký',
                'status_code'   => 401,
            ], 200);
        }

        if($check_phone){
            return response()->json([
                'message'       => 'Số điện thoại đã được đăng ký',
                'status_code'   => 401,
            ], 200);
        }

        return response()->json([
            'message'       => 'OK',
            'status_code'   => 200,
        ], 201);
    }

    public function postOrder(Request $request) {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'product' => 'required|json',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message'       => 'Vui lòng kiểm tra các trường bắt buộc',
                'status_code'   => 401,
            ], 200);
        }
        if (!Settings::get('professional_customer') || !Settings::get('individual_customer') || !Settings::get('sales_person')) {
            return response()->json([
                'message'       => 'Vui lòng kiểm tra cài đặt CMS',
                'status_code'   => 401,
            ], 200);
        }

        $product = json_decode($request->product);
        $order_product = [];
        $total = $cost = $profit = 0;
        foreach ($product as $sku => $qty) {
            $p = Product::where('product_sku', $sku)->first();
            if (!$p || !is_numeric($qty)) {
                return response()->json([
                    'message'       => 'Chuỗi sản phẩm ko đúng định dạng',
                    'status_code'   => 401,
                ], 200);
            }
            $inOrder = 0;
            if ($p->promotion_from && $p->promotion_to && Carbon::createFromFormat(Settings::get('date_format'),$p->promotion_from)->lte(Carbon::now()) && Carbon::createFromFormat(Settings::get('date_format'),$p->promotion_to)->gte(Carbon::now())) {
                $inOrder = 1;
            }
            $type_id = $request->type ? Settings::get('professional_customer') : Settings::get('individual_customer');
            $customer_type = CustomerType::find($type_id);
            if ($customer_type->professional_price && (float)$p->professional_price) {
                $p->label = 'Professional';
                $p->price = $p->professional_price;
            } elseif ((float)$p->promotion_price && $inOrder) {
                $p->label = 'Promotion';
                $p->price = $p->promotion_price;
            } else {
                $p->label = 'Regular';
                $p->price = $p->sale_price;
            }
            $order_product[$p->id] = [
                'quantity' => $qty,
                'price' => $p->price,
                'sub_total' => $p->price * $qty,
                'cost' => $p->unit_value * $qty,
                'profit' => ($p->price - $p->unit_value) * $qty,
                'label' => $p->label,
            ];
            $total += $order_product[$p->id]['sub_total'];
            $cost += $order_product[$p->id]['cost'];
            $profit += $order_product[$p->id]['profit'];
        }
        $after_discount = (($total * (100 - $request->discount)) / 100) - $request->discount_amount;
        $profit = $profit - (($total * $request->discount) / 100) - $request->discount_amount;
        $grand_total = ($after_discount * $request->tax)/100 + $after_discount;
        $final_price = $grand_total + $request->shipping_fee;
        $deposit = $final_price * (Settings::get('deposit') / 100);
        if ($request->deposit && $request->deposit > $deposit && $request->deposit <= $final_price) {
            $deposit = $request->deposit;
        }
        $to_be_paid = $final_price - $deposit;
        $customer_data = [
            'name' => $request->name,
            'contact_email' => $request->email,
            'phone_number' => $request->phone,
            'company_name' => $request->company,
            'address' => $request->address,
            'city_id' => $request->city ?: 0,
            'district_id' => $request->district ?: 0,
            'customer_type' => $request->type ? Settings::get('professional_customer') : Settings::get('individual_customer'),
            'signed_up' => Carbon::now()->format('Y-m-d H:i:s'),
            'status' => 1,
        ];
        $customer = Customer::where(['contact_email' => $request->email])->first();
        if ($customer) {
            $customer->update($customer_data);
        } else {
            $customer = Customer::create($customer_data);
        }
        $tracking_number = (int)Settings::get('tracking_number');
        Settings::set('tracking_number', $tracking_number + 1);
        $order = Saleorder::create([
            'customer_id' => $customer->id,
            'delivery_address' => $request->address,
            'sales_person_id' => Settings::get('sales_person'),
            'status' => $request->status ? 'Waiting' : 'Pending',
            'delivery_agency' => $request->delivery_agency ?: 0,
            'deposit_received' => $request->deposit_received ?: 0,
            'discount' => $request->discount ?: 0,
            'discount_amount' => $request->discount_amount ?: 0,
            'tax' => $request->tax ?: 0,
            'shipping_fee' => $request->shipping_fee ?: 0,
            'deposit' => $deposit,
            'total' => $total,
            'after_discount' => $after_discount,
            'grand_total' => $grand_total,
            'final_price' => $final_price,
            'to_be_paid' => $to_be_paid,
            'order_cost' => $cost,
            'order_profit' => $profit,
            'date' => Carbon::now()->format(Settings::get('date_format')),
            'note' => $request->note ?: '',
            'sales_channel' => 0,
            'sales_campaign' => '',
            'tracking_number' => $tracking_number,
        ]);
        foreach ($order_product as $k => $p) {
            SaleorderProduct::create([
                'order_id' => $order->id,
                'product_id' => $k,
                'quantity' => $p['quantity'],
                'price' => $p['price'],
                'sub_total' => $p['sub_total'],
                'cost' => $p['cost'],
                'profit' => $p['profit'],
                'label' => $p['label'],
            ]);
        }
        // $this->sendmail($order);
        return response()->json([
            'message'       => 'OK',
            'status_code'   => 200,
            'order' => $order,
        ], 201);
    }

    public function sendMail(Request $request) {
        $saleorder = Saleorder::find($request->id);
        $filename = 'SalesOrder-' . $saleorder->tracking_number;
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('a4','portrait');
        $pdf->loadView('user.sales_order.pdf', compact('saleorder'));
        $pdf->save(public_path('pdf/' . $filename . '.pdf'));
        // dispatch(new SendOrderMail($saleorder));
        $url = url("pdf/SalesOrder-" . $saleorder->tracking_number . ".pdf");
        if ($saleorder->customer->contact_email) {
            $customer = $this->checkEmail($saleorder->customer->contact_email);
        }
        $email = [$this->checkEmail($saleorder->salesPerson->email)];
        $admin = Role::userWithRole('admin')->map(function($item) use (&$email) {
            $email[] = $this->checkEmail($item->email);
        });
        $subject = 'caza.vn - Đơn đặt hàng số ['.$saleorder->tracking_number.']';
        $data = [
            'total' => $saleorder->deposit,
            'name' => $saleorder->customer->name,
            'gender' => $saleorder->customer->gender,
        ];
        $mail = EmailTemplate::where('type', 'order_mail')->first();
        $customer_text = $saleorder->customer->gender ? '(Mr.) ' . $saleorder->customer->name : '(Ms.) '. $saleorder->customer->name;
        $mail->text = str_replace('[customer]', $customer_text, $mail->text);
        $mail->text = str_replace('[total]', number_format($saleorder->deposit), $mail->text);
        $mail->text = str_replace('[code]', $saleorder->tracking_number, $mail->text);
        $mail->subject = str_replace('[customer]', $customer_text, $mail->subject);
        $mail->subject = str_replace('[total]', number_format($saleorder->deposit), $mail->subject);
        $mail->subject = str_replace('[code]', $saleorder->tracking_number, $mail->subject);
        $mail->title = str_replace('[customer]', $customer_text, $mail->title);
        $mail->title = str_replace('[code]', $saleorder->tracking_number, $mail->title);
        $subject = $mail->subject;
        $mail_list = Settings::get('email_list');
        if (array_key_exists($mail->from_address, $mail_list)) {
            config([
                'mail.username' => $mail->from_address,
                'mail.password' => $mail_list[$mail->from_address],
            ]);
        }
        $from = ucfirst(explode('@', config('mail.username'))[0]) . ' | ' . ucfirst(explode('@', config('mail.username'))[1]);
        if (isset($customer)) {
            Mail::send('user.mail.template', ['mail' => $mail], function($message) use ($url, $customer, $subject, $from) {
                $message->from(config('mail.username'), $from);
                $message->to($customer);
                $message->subject($subject);
                $message->attach($url);
            });
        }
        Mail::send('user.mail.template', ['mail' => $mail], function($message) use ($url, $email, $subject, $from) {
            $message->from(config('mail.username'), $from);
            $message->to($email);
            $message->subject($subject);
            $message->attach($url);
        });
        if (!Mail::failures()) { 
            $saleorder->quotation = 1;
            $saleorder->save();
        }
        return 1;
    }

    public function checkEmail($email) {
        $name = explode("@",$email);
        $name[0] = str_replace('.', '', $name[0]);
        return(implode('@', $name));
    }

    public function city(Request $request) {
        $city = City::select('id', 'name')->orderBy('name', 'asc')->get();
        return response()->json([
            'message'     => 'OK',
            'status_code' => 200,
            'city'     => $city,
        ], 200);
    }

    public function district(Request $request) {
        if (!$request->city) {
            return response()->json([
                'message'     => 'City là bắt buộc',
                'status_code' => 401,
            ], 200);
        }
        $district = District::select('id', 'name')->where('city_id', $request->city)->orderBy('name', 'asc')->get();
        return response()->json([
            'message'     => 'OK',
            'status_code' => 200,
            'district'     => $district,
        ], 200);
    }

    public function advice(Request $request) {
        $limit = $request->limit ?: 6;
        $advice = Advice::with('image')->inRandomOrder()->take($limit)->get();
        return response()->json([
            'message'     => 'OK',
            'status_code' => 200,
            'advice'     => $advice,
        ], 200);
    }

    public function newsCategory() {
        $category = NewsCategory::get();
        foreach ($category as $value) {
            $value->full_path   = $value->thumb_path = '';
            if($value->image_id){
                $current_img = Image::find($value->image_id);
                if($current_img){
                    $value->full_path   = asset('/uploads').'/'.$current_img->path.'/'.$current_img->name;
                    $value->thumb_path  = asset('/uploads').'/'.$current_img->path.'/thumb_'.$current_img->name;
                }
            }
        }
        return response()->json([
            'message'       => 'OK',
            'status_code'   => 200,
            'category' => $category,
        ], 200);
    }

    public function productCategory() {
        $category = Category::get();
        return response()->json([
            'message'       => 'OK',
            'status_code'   => 200,
            'category' => $category,
        ], 200);
    }

    public function block(Request $request) {
        $total = (int)$request->total ?: 1;
        $count = (int)$request->count ?: 1;
        switch ($request->block) {
            case 'product':
                if ($request->promotion || $request->category) {
                    $now = Carbon::now()->format('Y-m-d');
                    if ($request->promotion && $request->category) {
                        $product = Product::active()->with('image', 'images')->where('category_id', $request->category)->where('promotion_price', '!=', 0)->where('promotion_from', '<=', $now)->where('promotion_to', '>=', $now)->take($total)->get();
                        $type = 'category_promotion';
                    } elseif ($request->promotion) {
                        $product = Product::active()->with('image', 'images')->where('promotion_price', '!=', 0)->where('promotion_from', '<=', $now)->where('promotion_to', '>=', $now)->take($total)->get();
                        $type = 'promotion';
                    } elseif ($request->category) {
                        $product = Product::active()->with('image', 'images')->where('category_id', $request->category)->take($total)->get();
                        $type = 'category';
                    } 
                } elseif ($request->tag) {
                    $product = Product::active()->with('image', 'images')->whereHas('tags', function($item) use($request) {
                        $item->where('tag_id', $request->tag);
                    })->take($total)->get();
                    $type = 'tag';
                } elseif ($request->sku) {
                    $product_sku  = array_filter(explode(',', $request->sku));
                    $product = [];
                    $i = 0;
                    if ($product_sku) {
                        foreach($product_sku as $sku) {
                            $i++;
                            if ($i <= $total) {
                                $product[] = Product::active()->with('image', 'images')->where('product_sku', $sku)->first();
                            }
                        }
                    }
                    $type = 'sku';
                } else {
                    $product = null;
                    $type = null;
                }
                return response()->json([
                    'message'       => 'OK',
                    'status_code'   => 200,
                    'product' => $product,
                    'type' => $type,
                    'count' => $count,
                    'grid' => $request->grid ? 1 : 0,
                ], 200);
                break;

            case 'blog':
                if ($request->lastest) {
                    $news = News::with('image')->where('status', 'Publish')->orderBy('id', 'desc')->take($total)->get();
                    $type = 'lastest';
                } elseif ($request->category) {
                    $news = News::with('image')->where('status', 'Publish')->where('category_id', $request->category)->take($total)->get();
                    $type = 'category';
                } elseif ($request->id) {
                    $news_id  = explode(',', $request->id);
                    $news = News::with('image')->where('status', 'Publish')->whereIn('id', $news_id)->take($total)->get();
                    $type = 'id';
                } else {
                    $news = null;
                    $type = null;
                }
                return response()->json([
                    'message'       => 'OK',
                    'status_code'   => 200,
                    'news' => $news,
                    'type' => $type,
                    'count' => $count,
                ], 200);
                break;

            case 'article':
                if ($request->lastest) {
                    $article = News::orderBy('id', 'desc')->first();
                    $type = 'lastest';
                } elseif ($request->category) {
                    $article = News::where('category_id', $request->category)->first();
                    $type = 'category';
                } elseif ($request->id) {
                    $article = News::find($request->id);
                    $type = 'id';
                } else {
                    $news = null;
                    $type = null;
                }
                return response()->json([
                    'message'       => 'OK',
                    'status_code'   => 200,
                    'article' => $article,
                    'type' => $type,
                ], 200);
                break;

            case 'banner': 
                $banner = Banner::with('images')->find($request->id);
                return response()->json([
                    'message'       => 'OK',
                    'status_code'   => 200,
                    'banner' => $banner,
                ], 200);
                break;
            
            case 'shop-by-category':
                $data       = array();
                $results    = array();
                $domain     = asset('uploads/product_category');
                $domain_fe  = (strpos(\URL::full(), 'cazacrm.yez.vn') !== FALSE )?\Config::get('app.domain_test_site'):\Config::get('app.domain');
                if(isset($request->categories_id) && $request->categories_id){
                    $categories_id  = explode(',', $request->categories_id);
                    $results        = Category::whereIn('id', $categories_id)->select('name', 'slug', 'image', 'meta_title', 'meta_description')->get();
                }
                if(count($results) > 0){
                    foreach ($results as $item) {
                        $item->link_category = $domain_fe.'/shop/category/'.$item->slug;
                        if($item->image){
                            $item->link_image = $domain.'/'.$item->image;
                        }else{
                            $item->link_image = asset('uploads/no-image.png');
                        }
                    }
                }

                return response()->json([
                    'message'       => 'OK',
                    'status_code'   => 200,
                    'categories'    => $results,
                    'count'         => $count,
                    'total'         => $total,
                ], 200);
                break;    

            default:
                return response()->json([
                    'message'       => 'Không tìm thấy kiểu',
                    'status_code'   => 404,
                ], 200);
                break;
        }
    }

    public function newsletter(Request $request) {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message'       => 'Email không đúng',
                'status_code'   => 401,
            ], 200);
        }
        $newsletter = Newsletter::where('email', $request->email)->first();
        if ($newsletter) {
            return response()->json([
                'message'       => 'Email đã tồn tại trong hệ thống',
                'status_code'   => 401,
            ], 200);
        }
        $newsletter = Newsletter::create(['email' => $request->email]);
        return response()->json([
            'message'       => 'OK',
            'status_code'   => 201,
        ], 200);
    }


    public function gtmCode(Request $request){
        $gtm_code   = DB::table('settings')->where('setting_key', 'gtm_code')->first();
        $ga_code    = DB::table('settings')->where('setting_key', 'ga_code')->first();
        if($gtm_code){
            $gtm_code   = unserialize($gtm_code->setting_value);
        }
        if($ga_code){
            $ga_code    = unserialize($ga_code->setting_value);
        }

        return response()->json([
            'message'           => 'OK',
            'status_code'       => 200,
            'gtm_code'          => $gtm_code,
            'ga_code'           => $ga_code,
        ], 200);
    }
}
