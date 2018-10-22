<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Yajra\Datatables\Datatables;
use App\Helpers\Functions;
use App\Models\Image;

class CategoryController extends UserController
{
    private $list = [];

    public function __construct()
    {
        $this->middleware('authorized:category.list', ['only' => ['index']]);
        $this->middleware('authorized:category.add', ['only' => ['create']]);
        // $this->middleware('authorized:category.edit', ['only' => ['edit']]);

        parent::__construct();

        view()->share('type', 'category');
    }

    public function index(Request $request)
    {
        $length = $request->length ?: 50;
        $category = Category::orderBy('id', 'desc');
        if ($request->search) {

            $parentname = $request->search;
            $filterparentname = 0;
            if ($parentname == 'Root Category') {
                $filterparentname = 1;
            }
            $category = $category->where(function ($q) use ($request, $filterparentname) {
                $q->where('id', 'like', '%' . $request->search . '%')
                    ->orWhere('name', 'like', '%' . $request->search . '%')
                    ->orWhere('code', 'like', '%'.$request->search.'%');
                if ($filterparentname == 1) {
                    $q->orWhere('parent_id', 0);
                } else {
                    $q->orWhereHas('parent', function ($q) use ($request) {
                        $q->where('name', 'like', '%' . $request->search . '%');
                    });
                }
            });
        }
        $count = $category->count();
        $category = $category->paginate($length);
        $page_info = $this->pageInfo($request->page, $length, $count);
        $title = __('category.title');
        $request->session()->put('redirect_category', $request->fullUrl());
        return view('user.category.index', compact('title', 'category', 'page_info'));
    }

    public function create()
    {
        $title = __('category.new');
        $this->generateParams(0);
        return view('user.category.create', compact('title'));
    }

    public function store(CategoryRequest $request)
    {
        $i = 0;
        $slug = $request->slug ?: str_slug($request->name);
        $newSlug = $slug;
        while (Category::where('slug', $newSlug)->first()) {
            $i++;
            $newSlug = $slug . '-' . $i;
        }
        $request->merge(['slug' => $newSlug]);

        $image = '';
        if ($request->hasFile('image_file')) {
            $image = $this->uploadFile($request->image_file, 'product_category');
        }
        $request->merge(['image' => $image]);

        $category = Category::create($request->except('feature', 'image_file'));

        return redirect("category");
    }

    public function show(Category $category)
    {
        
    }

    public function edit(Category $category)
    {
        $title = __('category.edit') . ' (' . $category->id . ')';
        $this->generateParams($category->id);
        return view('user.category.edit', compact('title', 'category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $i = 0;
        $slug = $request->slug ?: str_slug($request->name);
        $newSlug = $slug;
        while (Category::where('slug', $newSlug)->where('slug', '<>', $category->slug)->first()) {
            $i++;
            $newSlug = $slug . '-' . $i;
        }
        $request->merge(['slug' => $newSlug]);

        $image = $request->image ?: $category->image;
        if ($request->hasFile('image_file')) {
            $image = $this->uploadFile($request->image_file, 'product_category');
        }
        $request->merge(['image' => $image]);

        $category->update($request->except('category_id', 'feature', 'image_file'));
        
        return redirect($request->session()->get('redirect_category'));
    }

    public function destroy(Category $category)
    {
        $count = $category->products->count() + $category->categories->count() + $category->product_category->count() + $category->supplier_category->count() + $category->leg->count();
        if(!$count) {
            $category->delete();
            return 1;
        }
    }

    private function generateParams($id)
    {
        $this->list[0] = 'Select Category';
        $categories = Category::where('parent_id', 0)->where('id', '<>', $id)->orderBy('name', 'asc')->get();
        $this->getList($categories, $id);
        view()->share('categories', $this->list);
    }

    private function getList($list, $id, $str = '') {
        foreach ($list as $key => $val) {
            if ($val->id != $id) {
                $val->name = $str . $val->name;
                $this->list[$val->id] = $val->name;
                $this->getList($val->categories, $id, $str . '|--');
            }
        }
    }
}

