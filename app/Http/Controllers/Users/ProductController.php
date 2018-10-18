<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\UserController;
use App\Models\Product;
use Illuminate\Http\Request;
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


}
