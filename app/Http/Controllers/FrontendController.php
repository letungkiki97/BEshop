<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function pageInfo($page, $length, $count) {
        $page = $page ?: 1;
        $from = ($page-1) * $length + 1;
        $to = ($page) * $length;
        $to = $to > $count ? $count : $to;
        $from = $from > $to ? $to : $from;
        return 'Showing ' . $from . ' to ' . $to . ' of ' . $count . ' entries';
    }

    public function index()
    {
        //
        $product = Product::where('published',1)->get();
        $categoryparents = Category::where('parent_id',0)->get();
        $productmaymocs = Product::where('catego',2)->get();
        return view('frontend.home',compact('product','categoryparents','productmaymocs'));
    }
    public function productall(Request $request)
    {
        $length = $request->length ?: 20;
        $product = Product::where('published',1)->orderBy('id', 'desc');
        $count = $product->count();
        $product = $product->paginate($length);
        $page_info = $this->pageInfo($request->page, $length, $count);

        return view('frontend.productall',compact('title', 'product', 'page_info'));
    }
    public function contact()
    {
        //
        return view('frontend.contact');
    }
    public function introduce()
    {
        //
        return view('frontend.introduce');
    }
    public function blog()
    {
        //
        return view('frontend.blog');
    }
    public function productcategory(Request $request,$slug)
    {
        $length = $request->length ?: 20;
        $product = Product::where('published',1)->orderBy('id', 'desc');
        if(!empty($slug)){
            $categry = Category::where('slug',$slug)->first();
            if(!empty($categry)){
                if($categry->parent_id == 0){
                   $categrys = Category::where('parent_id',$categry->id)->pluck('slug')->toArray();;
                   $product = $product->whereHas('category',function($q2) use ($categrys){
                        $q2->whereIn('slug',$categrys);
                    });
                }else{
                    $product = $product->whereHas('category',function($q2) use ($slug){
                        $q2->where('slug',$slug);
                    });
                }
            }
        }
        $count = $product->count();
        $product = $product->paginate($length);
        $page_info = $this->pageInfo($request->page, $length, $count);

        return view('frontend.productcategory',compact('title', 'product', 'page_info','slug'));
    }
    public function producttype(Request $request,$id)
    {
        $length = $request->length ?: 20;
        $product = Product::where('published',1)->orderBy('id', 'desc');
        $count = $product->count();
        $product = $product->paginate($length);
        $page_info = $this->pageInfo($request->page, $length, $count);
        switch ($id) {
            case 1:
                $loai = 'From mẫu ô tô';
                break;
            case 2:
                $loai = 'Máy móc công nghệ';
                break;
            case 3:
                $loai = 'Nguyên liệu vật tư';
                break;
            default:
                $loai = 'Khác';
                break;
        }
        return view('frontend.producttype',compact('title', 'product', 'page_info','loai'));
    }
    public function productdetail()
    {
        //
        return view('frontend.productdetail');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        //
        $tim = $request->q;
        $length = $request->length ?: 20;
        $product = Product::where('published',1)->orderBy('id', 'desc');
         if (!empty($tim)) {
            $product = $product->where(function ($q) use ($request) {
                $q->where('product_name', 'like', '%' . $request->q . '%');
                if(!empty($request->product_type)){
                $q->where('catego', 'like', '%' . $request->product_type. '%');   
                }
            });
        }
        $count = $product->count();
        $product = $product->paginate($length);
        $page_info = $this->pageInfo($request->page, $length, $count);

        return view('frontend.search',compact('title', 'product', 'page_info','tim'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
