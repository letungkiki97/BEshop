<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $product = Product::get();
        $categoryparents = Category::where('parent_id',0)->get();
        $productmaymocs = Product::where('catego',2)->get();
        return view('frontend.home',compact('product','categoryparents','productmaymocs'));
    }
    public function productall()
    {
        //
        return view('frontend.productall');
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
    public function productcategory()
    {
        //
        return view('frontend.productcategory');
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
    public function create()
    {
        //
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
        $product = Product::find($id);

        if (empty($product)) {

            return redirect('/');
        }

        return view('frontend.productdetail',compact('product'));
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
