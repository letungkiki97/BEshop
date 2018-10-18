<?php

namespace App\Http\Controllers\Users;

use App\Models\SupplierPrice;
use App\Models\SupplierPriceTemp;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Models\Product;
use App\Models\Saleorder;
use DB;
use App\Models\Image;
use App\Helpers\Thumbnail;
use App\Models\Category;

class AjaxController extends UserController
{
    public function city(Request $request)
    {
        $result = DB::table('cities')->select('id', 'name');
        if ($request->has('q')) {
            $result = $result->where('name', 'LIKE', '%' . $request->q . '%');
        }
        $data = $result->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->name,
            ];
        });
        return response()->json($data, 200);
    }

    public function category(Request $request)
    {
        $result = DB::table('categories')->select('id', 'name');
        if ($request->has('q')) {
            $result = $result->where('name', 'LIKE', '%' . $request->q . '%')
                ->orWhere('code', 'LIKE', '%' . $request->q . '%');
        }
        $data = $result->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->name,
            ];
        });
        return response()->json($data, 200);
    }

    public function customer(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $result = DB::table('customers')->select('id', 'name', 'contact_email', 'phone_number')->where('name', 'LIKE', '%' . $request->q . '%')
                ->orWhere('phone_number', 'LIKE', '%' . $request->q . '%');
            $data = $result->get()->map(function ($item) {
                $text = $item->name . ' - ' . $item->phone_number;
                $text .= $item->contact_email ? ' - ' . $item->contact_email : '';
                return [
                    'id' => $item->id,
                    'text' => $text,
                ];
            });
        }
        return response()->json($data, 200);
    }

    public function delivery(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $result = DB::table('deliveries')->select('id', 'code')
                ->where('status', 1)
                ->where(function ($query) use ($request) {
                    $query->where('code', 'LIKE', '%' . $request->q . '%')
                        ->orWhere('id', 'LIKE', '%' . $request->q . '%');
                });

            $data = $result->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->id . ' | ' . $item->code,
                ];
            });
        }
        return response()->json($data, 200);
    }

    public function district($city_id, Request $request)
    {
        $result = DB::table('districts')->select('id', 'name')->where('city_id', $city_id);
        if ($request->has('q') && $city_id) {
            $result = $result->where('name', 'LIKE', '%' . $request->q . '%');
        }
        $data = $result->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->name,
            ];
        });
        return response()->json($data, 200);
    }

    public function fabric($fabric_book_id, Request $request)
    {
        $result = DB::table('fabric')->select('id', 'name')->where('fabric_book_id', $fabric_book_id);
        if ($request->has('q') && $fabric_book_id) {
            $result = $result->where('name', 'LIKE', '%' . $request->q . '%');
        }
        $data = $result->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->name,
            ];
        });
        return response()->json($data, 200);
    }

    public function fabric_book(Request $request)
    {
        $result = DB::table('fabric_book')->select('id', 'name');
        if ($request->has('q')) {
            $result = $result->where('name', 'LIKE', '%' . $request->q . '%');
        }
        $data = $result->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->name,
            ];
        });
        return response()->json($data, 200);
    }

    public function material(Request $request)
    {
        $result = DB::table('material')->select('id', 'name');
        if ($request->has('q')) {
            $result = $result->where('name', 'LIKE', '%' . $request->q . '%');
        }
        $data = $result->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->name,
            ];
        });
        return response()->json($data, 200);
    }

    public function material_color($material_id, Request $request)
    {
        $result = DB::table('material_color')->select('id', 'name')->where('material_id', $material_id);
        if ($request->has('q') && $material_id) {
            $result = $result->where('name', 'LIKE', '%' . $request->q . '%');
        }
        $data = $result->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->name,
            ];
        });
        return response()->json($data, 200);
    }

    public function product(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $result = DB::table('products')->select('id', 'product_name', 'product_sku', 'product_image')
                ->where(function ($query) use ($request) {
                    $query->where('product_name', 'LIKE', '%' . $request->q . '%')
                        ->orWhere('id', 'LIKE', '%' . $request->q . '%')
                        ->orWhere('product_sku', 'LIKE', '%' . $request->q . '%');
                });
            if ($request->has('page') && $request->page == 'production_order') {
                $result = $result->where('made_to_order', 1);
            }
            if ($request->has('page') && $request->page == 'sales_order') {
                $result = $result->where('status', 1);
            }
            $data = $result->get()->map(function ($item) use ($request) {
                $text = $item->product_sku . ' | ' . $item->product_name;
                if ($item->product_image) {
                    $image = DB::table('images')->select('id', 'name')->where('id', $item->product_image)->first() ? asset('uploads/products') . '/thumb_' . DB::table('images')->select('id', 'name')->where('id', $item->product_image)->first()->name : asset('img/no-img.png');
                } else {
                    $image = asset('img/no-img.png');
                }
                $text = '<img src="' . $image . '" class="thumb-data" /> <span>' . $text . '</span>';
                return [
                    'id' => $item->id,
                    'text' => $text,
                ];
            });
            if ($request->has('page') && (in_array($request->page, ['customer', 'requirement', 'news']))) {
                $data = $result->get()->map(function ($item) use ($request) {
                    return [
                        'id' => $item->id,
                        'text' => $item->product_sku . ' | ' . $item->product_name,
                    ];
                });
            }
        }
        return response()->json($data, 200);
    }

    public function productisdeliverycategory(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $result = Product::where(function ($query) use ($request) {
                $query->where('product_name', 'LIKE', '%' . $request->q . '%')
                    ->orWhere('id', 'LIKE', '%' . $request->q . '%')
                    ->orWhere('product_sku', 'LIKE', '%' . $request->q . '%');
            })->has('delivery_category', '>=', 1);

            $data = $result->get()->map(function ($item) use ($request) {
                @$text = @$item->product_sku . ' | ' . @$item->product_name;
                if ($item->product_image) {
                    $image = asset('uploads/products') . '/thumb_' . DB::table('images')->select('id', 'name')->where('id', $item->product_image)->first()->name;
                } else {
                    $image = asset('img/no-img.png');
                }
                $text = '<img src="' . $image . '" class="thumb-data" /> <span>' . $text . '</span>';
                return [
                    'id' => $item->id,
                    'text' => $text,
                ];
            });

        } else if ($request->has('id')) {
            $result = SupplierPriceTemp::with('product')->where('supplier_id', $request->id)->get();
            $data = $result->map(function ($item) use ($request) {
                $text = @$item->product->product_sku . ' | ' . @$item->product->product_name;
                $text = '<span>' . $text . '</span>';
                return [
                    'id' => $item->id,
                    'text' => $text,
                    'item' => $item
                ];
            });
        }
        return response()->json($data, 200);
    }

    public function feature(Request $request)
    {
        $result = DB::table('feature')->select('id', 'name');
        if ($request->has('q')) {
            $result = $result->where('name', 'LIKE', '%' . $request->q . '%');
        }
        $data = $result->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->name,
            ];
        });
        return response()->json($data, 200);
    }

    public function productFeature(Request $request)
    {
        $result = array();
        if (isset($_GET['cate_id']) && $_GET['cate_id']) {
            $category = Category::findOrFail($_GET['cate_id']);
            $result = $category->feature();
        }
        // dd($result);
        if (!isset($_GET['cate_id']) || count($result->get()) == 0) {
            $result = DB::table('feature')->select('id', 'name');
            if ($request->has('q')) {
                $result = $result->where('name', 'LIKE', '%' . $request->q . '%');
            }
        }

        $data = $result->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->name,
            ];
        });

        return response()->json($data, 200);
    }

    public function property_type(Request $request)
    {
        $result = DB::table('property_type')->select('id', 'name');
        if ($request->has('q')) {
            $result = $result->where('name', 'LIKE', '%' . $request->q . '%');
        }
        $data = $result->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->name,
            ];
        });
        return response()->json($data, 200);
    }

    public function property($property_type_id, Request $request)
    {
        $result = DB::table('properties')->select('id', 'value')->where('property_type_id', $property_type_id);
        if ($request->has('q') && $property_type_id) {
            $result = $result->where('value', 'LIKE', '%' . $request->q . '%');
        }
        $data = $result->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->value,
            ];
        });
        return response()->json($data, 200);
    }

    public function storage($warehouse_id, Request $request)
    {
        $result = DB::table('storages')->select('id', 'location')->where('warehouse_id', $warehouse_id);
        if ($request->has('q') && $warehouse_id) {
            $result = $result->where('location', 'LIKE', '%' . $request->q . '%');
        }
        $data = $result->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->id . ' | ' . $item->location,
            ];
        });
        return response()->json($data, 200);
    }

    public function supplier(Request $request)
    {
        $result = DB::table('suppliers')->select('id', 'name');
        if ($request->has('q')) {
            $result = $result->where('name', 'LIKE', '%' . $request->q . '%')
                ->orWhere('id', 'LIKE', '%' . $request->q . '%');
        }
        $data = $result->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->id . ' | ' . $item->name,
            ];
        });
        return response()->json($data, 200);
    }

    public function user(Request $request)
    {
        $result = DB::table('users')->select('id', 'first_name', 'last_name')->where('status', 1);
        if ($request->has('q')) {
            $result = $result->where(function ($q) use ($request) {
                $q->where('first_name', 'LIKE', '%' . $request->q . '%')->orWhere('last_name', 'LIKE', '%' . $request->q . '%');
            });
        }
        $data = $result->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->first_name . ' ' . $item->last_name,
            ];
        });
        return response()->json($data, 200);
    }

    public function warehouse(Request $request)
    {
        $result = DB::table('warehouses')->select('id', 'code', 'name');
        if ($request->has('q')) {
            $result = $result->where('name', 'LIKE', '%' . $request->q . '%')
                ->orWhere('code', 'LIKE', '%' . $request->q . '%');
        }
        $data = $result->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->code . ' | ' . $item->name,
            ];
        });
        return response()->json($data, 200);
    }

    public function loadImages()
    {
        extract($_GET);

        $take = 30;
        if ($type == 'load') {
            $skip_item = $skip * $take;
        } else {
            $skip_item = 0;
        }

        $current = Image::orderBy('id', 'DESC');
        if (isset($name) && $name) {
            $current = $current->where('name', 'LIKE', '%' . $name . '%');
        }
        $current = $current->skip($skip_item)->take($take)->get();
        $html = '';
        if (count($current) > 0) {
            foreach ($current as $item) {
                $html .= '<div class="image-item" data-title="' . $item->title . '" data-alt="' . $item->alt . '" data-id="' . $item->id . '" data-src="' . asset('uploads') . '/' . $item->path . '/' . $item->name . '" style="position: relative;">';
                $html .= '  <div class="wrap-check-icon"><i class="fa fa-check"></i></div>';
                $html .= '  <img class="lazy-image" src="' . asset('uploads') . "/" . $item->path . "/" . $item->name . '"/>';
                $html .= '</div>';
            }
            $html .= '<div class="wrap-loading-icon"><div class="lds-dual-ring"></div></div>';
        }

        $data['html'] = $html;
        $data['count'] = count($current);

        return json_encode($data);
    }

    public function updateImgLibrary()
    {
        extract($_GET);

        $html = '';
        $current = Image::where('id', $id)->first();
        if ($current) {
            $html .= '<div class="image-item" data-title="' . $current->title . '" data-alt="' . $current->alt . '" data-id="' . $current->id . '" data-src="' . asset('uploads') . '/' . $current->path . '/' . $current->name . '" style="position: relative;">';
            $html .= '  <div class="wrap-check-icon"><i class="fa fa-check"></i></div>';
            $html .= '  <img class="lazy-image" src="' . asset('uploads') . "/" . $current->path . "/" . $current->name . '"/>';
            $html .= '</div>';
            $html .= '<div class="wrap-loading-icon"><div class="lds-dual-ring"></div></div>';
        }

        return $html;
    }

    public function editImgTitleAlt()
    {
        extract($_GET);

        $pathInfo = pathinfo($src);

        $name = $pathInfo['basename'];
        $ext = $pathInfo['extension'];
        $current_img = Image::where('name', $name)->first();
        $result = array();
        $result['name'] = $name;
        $result['src'] = $src;
        $result['title'] = ($current_img) ? $current_img->title : '';
        $result['alt'] = ($current_img) ? $current_img->alt : '';

        return json_encode($result);
    }

    public function saveImage($url, $saveTo)
    {
        $fp = fopen($saveTo, 'w+');
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $code == 200 ? true : false;
    }


    public function addImgContent()
    {
        extract($_GET);

        $pathInfo       = pathinfo($src);
        $name           = $pathInfo['basename'];
        $ext            = $pathInfo['extension'];
        $result         = array();
        $image          = '';

        $current_img    = Image::where('name', $name)->first();
        if(!$current_img){
            if($name && $ext && in_array($ext, ['jpg', 'png', 'jpeg', 'gif'])) {
                $name = str_replace('.'.$ext, '', $name);
                $name = str_slug($name) .'_'. time() . '.' . $ext;
                $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/'.$path.'/' . $name;
                if ($this->saveImage($src, $to)) {
                    $image = Image::create([
                        'name' => $name,
                        'title' => $title,
                        'alt' => $alt,
                        'path' => $path,
                        'status' => 0,
                    ]);
                    if(Thumbnail::generate_image_thumbnail($to, $_SERVER['DOCUMENT_ROOT'] . '/uploads/'.$path.'/thumb_' . $name)){
                    }

                }
            }
        }

        $id = ($image && $image->id)?$image->id:$current_img->id;
        if($img_name != $name){
            $old_file_thumb = $_SERVER['DOCUMENT_ROOT']."/uploads/".$path."/thumb_".$name;
            $old_file       = $_SERVER['DOCUMENT_ROOT']."/uploads/".$path."/".$name;

            if (file_exists($old_file_thumb)) {
                rename($old_file_thumb, $_SERVER['DOCUMENT_ROOT']."/uploads/".$path."/thumb_".$img_name);
            }
            if(file_exists($old_file)){
                rename($old_file, $_SERVER['DOCUMENT_ROOT']."/uploads/".$path."/".$img_name);
            }
        }

        Image::where('id', $id)->update([
            'name' => $img_name,
            'status' => 0,
            'title' => $title,
            'alt' => $alt,
        ]);

        $result['src']      = asset("/uploads").'/'.$path.'/'.$img_name;
        $result['alt']      = $alt;
        $result['title']    = $title;
        $result['id']       = $id;
        
        return json_encode($result);
    }

    // AJAX update product price
    public function editProductPrice()
    {
        extract($_GET);

        $update = DB::table($table)->where('id', $id)->update([$type => $price]);
        return $price_convert;
    }

    // AJAX update product price
    public function editProductDate()
    {
        extract($_GET);
        $update = DB::table($table)->where('id', $id)->update([$type => $date]);
        return 1;
    }
}
