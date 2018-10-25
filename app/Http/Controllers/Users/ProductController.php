<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\UserController;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use App\Helpers\Functions;
use App\Helpers\Thumbnail;
use App\Http\Requests\ProductRequest;
use Excel;
use DB;

class ProductController extends UserController
{
    public function __construct()
    {
        $this->middleware('authorized:product.list', ['only' => ['index']]);
        $this->middleware('authorized:product.add', ['only' => ['create']]);
        $this->middleware('authorized:catalog.list', ['only' => ['catalog']]);
        // $this->middleware('authorized:product.edit', ['only' => ['edit']]);
        
        parent::__construct();

        view()->share('type', 'product');
    }

     public function search(Request $request)
    {
        $length = $request->length ?: 50;
        $product = Product::orderBy('id', 'desc');
        if ($this->user->hasAccess(['product.created'])) {
            $product = $product->where(function ($q) {
                $q->where('user_id', $this->user->id)
                ->orWhere('assigned_to', $this->user->id);
            });
        }
        if ($this->user->hasAccess(['product.published'])) {
            $product = $product->where('published', 0);
        }
        if ($request->search) {
            $stt = @strtolower($request->search);
            if ($stt == 'active') {
                $timsst = 1;
            } else if ($stt == 'inactive') {
                $timsst = 0;
            } else {
                $timsst = null;
            }
            $product = $product->where(function ($q) use ($request, $timsst) {
                $q->where('id', 'like', '%' . $request->search . '%')
                ->orWhere('product_name', 'like', '%' . $request->search . '%')
                ->orWhere('product_sku', 'like', '%' . $request->search . '%')
                ->orWhereHas('category', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%');
                })
                ->orWhere('main_sku', 'like', '%' . $request->search . '%');
                if ($timsst !== null) {
                    $q->orWhere('status', $timsst);
                }

            });
        }
        $count = $product->count();
        $product = $product->paginate($length);
        $page_info = $this->pageInfo($request->page, $length, $count);
        $title = __('product.title');
        $request->session()->put('redirect_product', $request->fullUrl());
        return view('product.search', compact('title', 'product', 'page_info'));
    }

    public function index(Request $request)
    {
        $length = $request->length ?: 50;
        $product = Product::orderBy('id', 'desc');
        if ($this->user->hasAccess(['product.created'])) {
            $product = $product->where(function ($q) {
                $q->where('user_id', $this->user->id)
                ->orWhere('assigned_to', $this->user->id);
            });
        }
        if ($this->user->hasAccess(['product.published'])) {
            $product = $product->where('published', 0);
        }
        if ($request->search) {
            $stt = @strtolower($request->search);
            if ($stt == 'active') {
                $timsst = 1;
            } else if ($stt == 'inactive') {
                $timsst = 0;
            } else {
                $timsst = null;
            }
            $product = $product->where(function ($q) use ($request, $timsst) {
                $q->where('id', 'like', '%' . $request->search . '%')
                ->orWhere('product_name', 'like', '%' . $request->search . '%')
                ->orWhere('product_sku', 'like', '%' . $request->search . '%')
                ->orWhereHas('category', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%');
                })
                ->orWhere('main_sku', 'like', '%' . $request->search . '%');
                if ($timsst !== null) {
                    $q->orWhere('status', $timsst);
                }

            });
        }
        $count = $product->count();
        $product = $product->paginate($length);
        $page_info = $this->pageInfo($request->page, $length, $count);
        $title = __('product.title');
        $request->session()->put('redirect_product', $request->fullUrl());
        return view('user.product.index', compact('title', 'product', 'page_info'));
    }

    public function create()
    {
        $title = __('product.new');

        $this->generateParams(0);

        return view('user.product.create', compact('title'));
    }

    public function store(ProductRequest $request)
    {
        $i = 0;
        $slug = $request->slug ?: str_slug($request->product_name);
        $newSlug = $slug;
        while (Product::where('slug', $newSlug)->first()) {
            $i++;
            $newSlug = $slug . '-' . $i;
        }
        $request->merge(['slug' => $newSlug]);

        $file_array = [];
        if ($request->hasFile('file_3d_file')) {
            foreach ($request->file('file_3d_file') as $file_3d_file) {
                $file_array[] = $this->uploadFile($file_3d_file, 'products');
            }
        }
        $file_3d = $file_array ? implode(',', $file_array) : null;
        $request->merge(['file_3d' => $file_3d]);

        if (!$request->product_image && $request->image_gallery) {
            $request->merge(['product_image' => $request->image_gallery[0]]);
        }
        $request->merge(['user_id' => $this->user->id]);
        
        $request->product_name = mb_strtoupper($request->product_name);
        $request->merge(['product_name' => $request->product_name]);

        if(!isset($request->hover_image)){
            $request->merge(['hover_image' => 0]);
        }
        
        $product = Product::create($request->except('file_3d_file', 'image_gallery', 'color'));

        $colors = [];

        if ($request->color) {
            $colors = array_unique(array_merge($request->color, $colors));
        }

        $product->color()->sync($colors);

        $product->images()->sync($request->image_gallery);

        $this->changeImgInfomation($product->id);

        return redirect("quantri/product/" .$product->id. "/edit" )->with('status', __('message.product_created'));
    }

    public function edit(Product $product)
    {
        $title = __('product.edit') . ' (' . $product->product_sku . ')';
        $group = [];
        $children = $product->getVariants()->get()->map(function($item) {
            $name = $value = $code = [];
            foreach ($item->variants as $key => $var) {
                $name[] = $var->property->value;
                $value[] = $var->property_id;
                $code[] = $var->property->code;
            }
            return [
                'id' => $item->id,
                'name' => $item->product_name,
                'code' => $item->product_sku,
                'data-name' => implode($name, ' '),
                'data-code' => implode($code, ''),
                'value' => implode($value, '-'),
                'sale_price' => number_format($item->sale_price),
                'promotion_price' => number_format($item->promotion_price),
                'promotion_date' => $item->promotion_from && $item->promotion_to ? $item->promotion_from . ' - ' . $item->promotion_to : '',
                'professional_price' => number_format($item->professional_price),
                'status' => $item->status,
                'main_variant' => $item->main_variant,
            ];
        });
        $product_feature = [];
        $category_feature = [];
        $property_feature = [];
        $property_main = [];
        $html = view('user.product._feature', compact('product_feature', 'category_feature', 'property_feature', 'property_main'))->render();

        $unlink = explode(',', $product->unlink);

        $this->generateParams($product->id);
        $product_color = $product->color()->get()->pluck('id')->toArray();

        return view('user.product.edit', compact('title', 'product', 'group', 'children', 'html', 'unlink', 'product_color'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $i = 0;
        $slug = $request->slug ?: str_slug($request->product_name);
        $newSlug = $slug;
        while (Product::where('slug', $newSlug)->where('slug', '<>', $product->slug)->first()) {
            $i++;
            $newSlug = $slug . '-' . $i;
        }
        $request->merge(['slug' => $newSlug]);

        $file_array = $request->old_file;

        if ($request->hasFile('file_3d_file')) {
            foreach ($request->file('file_3d_file') as $file_3d_file) {
                $file_array[] = $this->uploadFile($file_3d_file, 'products');
            }
        }
        $file_3d = $file_array ? implode(',', $file_array) : null;
        $request->merge(['file_3d' => $file_3d]);
        if (!$request->product_image) {
            if ($request->image_gallery) {
                $request->merge(['product_image' => $request->image_gallery[0]]);
            } else {
                $request->merge(['product_image' => null]);
            }
        }

        $colors = [];

        $request->product_name = mb_strtoupper($request->product_name);
        $request->merge(['product_name' => $request->product_name]);

        if(!isset($request->hover_image)){
            $request->merge(['hover_image' => 0]);
        }

        $product->update($request->except('file_3d_file', 'old_file', 'image_gallery', 'parent_gallery', 'color', 'main_variant'));

        ProductColor::where(['product_id' => $product->id])->delete();

        if ($request->color) {
            $colors = array_unique(array_merge($request->color, $colors));
        }

        $product->color()->sync($colors);
        $product->images()->sync($request->image_gallery);

        $this->changeImgInfomation($product->id);

        return redirect($request->session()->get('redirect_product'))->with('status', __('message.product_updated'));
    }

    public function deleted(Request $request)
    {
        $length = $request->length ?: 50;
        $product = Product::onlyTrashed()->orderBy('id', 'desc');
        if ($request->search) {
            $product = $product->where(function ($q) use ($request) {
                $q->where('id', 'like', '%' . $request->search . '%')
                    ->orwhere('product_name', 'like', '%' . $request->search . '%')
                    ->orWhere('product_sku', 'like', '%' . $request->search . '%')
                    ->orWhereHas('category', function ($q2) use ($request) {
                        $q2->where('name', 'like', '%' . $request->search . '%');
                    })
                    ->orWhere('main_sku', 'like', '%' . $request->search . '%');
            });
        }
        $count = $product->count();
        $product = $product->paginate($length);
        $page_info = $this->pageInfo($request->page, $length, $count);
        $title = __('product.deleted');
        return view('user.product.trash', compact('title', 'product', 'page_info'));
    }

    public function destroy(Product $product)
    {
        $count = 0;
        if(!$count) {
            $product->delete();
            return 1;
        }
    }

    public function restore(Request $request) {
        Product::withTrashed()->find(@$request->id)->restore();
        return 1;
    }

    private function generateParams($id = 0)
    {

        $categories = Category::orderBy("name", "asc")->get()->pluck('name','id');

        $category = Category::orderBy("name", "asc")->get()->pluck('name','id')->prepend('Select a product type', '');

        $toggle = [1 => 'Yes', 0 => 'No'];
        $status = [1 => 'Active', 0 => 'Inactive'];
        $catego = [1 => 'From mẫu ô tô', 2 => 'Máy móc công nghệ', 3 => 'Nguyên liệu vật tư'];

        $colors = Color::all()->pluck('color', 'id');
        if ($id) {
            $productGallery = Product::find($id)->images()->get();
            
            view()->share([
                'productGallery' => $productGallery,
            ]);
        }

        view()->share([
            'categories' => $categories,
            'category' => $category,
            'toggle' => $toggle,
            'status' => $status,
            'colors' => $colors,
            'catego' => $catego,
        ]);
    }
    public function suggest(Request $request) {
        $sku = DB::table('products')->select('product_name', 'main_sku')->where('main_sku', '<>', '')->distinct()->get()->map(function($item) {
            return [
                'name' => $item->product_name,
                'value' => $item->main_sku
            ];
        });
        return response()->json($sku, 200);
    }
    public function uploadFromUrl(Request $request) {
        $pathInfo = pathinfo($request->url);
        $name = $pathInfo['basename'];
        $ext = $pathInfo['extension'];
        if($name && $ext && in_array($ext, ['jpg', 'png', 'jpeg', 'gif'])) {
            $name = str_replace('.'.$ext, '', $name);
            $name = str_slug($name) . '.' . $ext;
            $to = public_path() .'/uploads/products/' . $name;
            if ($this->saveImage($request->url, $to)) {
                $image = Image::create([
                    'name' => $name,
                    'title' => $request->title,
                    'alt' => $request->alt,
                    'path' => 'products'
                ]);
                if(Thumbnail::generate_image_thumbnail($to,public_path() .'/uploads/products/thumb_' . $name)) {
                    return $image;
                }
            }
        }
        return null;
    }
     public function saveImage($url, $saveTo) {
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
    public function getSKU(Request $request) {
        if ($request->category) {
            return response()->json(Category::find($request->category)->getSKU($request->old_category), 200);
        }
    }
    public function changeImgInfomation($id)
    {
        $current_img = Product::join('product_image', 'products.id', '=', 'product_image.product_id')
            ->join('images', 'images.id', '=', 'product_image.image_id')
            ->where('products.id', $id)
            ->where('images.path', 'products')
            ->select('products.product_sku', 'products.product_name', 'images.name as img_name', 'products.slug', 'images.id as img_id', 'images.alt as img_alt', 'images.title as img_title')
            ->get();

        if (count($current_img) > 0) {
            $data_img = array();
            foreach ($current_img as $item) {
                $img_name = $item->img_name;
                $img_name_arr = explode('.', $img_name);
                $img_type = trim($img_name_arr[count($img_name_arr) - 1]);
                $new_img_name = $item->product_sku . '-' . $item->slug . '-' . $item->img_id . '.' . $img_type;
                $new_img_alt = $item->img_alt;
                $new_img_title = $item->img_title;
                if (!$item->img_alt) {
                    $new_img_alt = $item->product_name;
                }
                if (!$item->img_title) {
                    $new_img_title = $item->product_name . ' -lt';
                }
                $data_img['name'] = $new_img_name;
                $data_img['alt'] = $new_img_alt;
                $data_img['title'] = $new_img_title;
                $old_file_thumb = public_path() . "/uploads/products/thumb_" . $img_name;
                $old_file = public_path() . "/uploads/products/" . $img_name;
                if (file_exists($old_file)) {
                    rename($old_file, public_path() . "/uploads/products/" . $new_img_name);
                }
                if (file_exists($old_file_thumb)) {
                    rename($old_file_thumb, public_path() . "/uploads/products/thumb_" . $new_img_name);
                }

                $update = Functions::insertUpdate('update', new Image, $item->img_id, $data_img);
            }
        }
    }
    public function upload(Request $request) {
        $image      = Image::create([
            'name'  => $this->uploadFile($request->file('gallery'), 'products'),
            'alt'   => $request->img_alt,
            'title' => $request->img_title,
            'path'  => 'products',
        ]);
        return $image;
    }

}
