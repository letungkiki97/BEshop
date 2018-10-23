<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Models\Image;

class ImageController extends UserController
{
    public function __construct()
    {
        $this->middleware('authorized:image.list', ['only' => ['index']]);
        $this->middleware('authorized:image.add', ['only' => ['create']]);
        // $this->middleware('authorized:image.edit', ['only' => ['edit']]);
        
        parent::__construct();

        view()->share('type', 'image');
    }

    public function index(Request $request)
    {
        $length = $request->length ?: 50;
        $image = Image::orderBy('id', 'desc');
        if ($request->search) {
            $image = $image->where('name', 'like', '%'.$request->search.'%')
                        ->orWhere('title', 'like', '%'.$request->search.'%')
                        ->orWhere('alt', 'like', '%'.$request->search.'%');
        }
        $count = $image->count();
        $image = $image->paginate($length);
        $page_info = $this->pageInfo($request->page, $length, $count);
        $title = __('image.title');
        $request->session()->put('redirect_image', $request->fullUrl());
        return view('user.image.index', compact('title', 'image', 'page_info'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $image = Image::create([
            'name' => $this->uploadFile($request->file('gallery'), $request->img_path),
            'alt' => $request->img_alt,
            'title' => $request->img_title,
            'path' => $request->img_path,
        ]);
        return $image;
    }

    public function show(Image $image)
    {
        
    }

    public function edit(Image $image)
    {
        $info = pathinfo($image->name);
        $image->file_name = $info['filename'];

        return $image;
    }

    public function update(Request $request, Image $image)
    {
        $info = pathinfo($image->name);
        $name = $request->name;
        $file = $request->name . '.' . $info['extension'];
        if ($info['filename'] != $name) {
            $count = 0;
            while (file_exists(public_path('uploads/' . $image->path . '/' . $file))) {
                $count++;
                $name = $request->name . '-' . $count;
                $file = $name . '.' . $info['extension'];
            }
            if (file_exists(public_path('uploads/' . $image->path . '/' . $image->name))) {
                rename(public_path('uploads/' . $image->path . '/' . $image->name), public_path('uploads/' . $image->path . '/' . $file));
            }
            if (file_exists(public_path('uploads/' . $image->path . '/thumb_' . $image->name))) {
                rename(public_path('uploads/' . $image->path . '/thumb_' . $image->name), public_path('uploads/' . $image->path . '/thumb_' . $file));
            }
        }
        
        $request->merge(['name' => $file]);

        $image->update($request->except('image_id'));
        return redirect($request->session()->get('redirect_image'));
    }

    public function destroy(Image $image)
    {
        $count = $image->product->count() + $image->products->count() + $image->banner->count();
        if (!$count) {
            $image->delete();
            return 1;
        }
    }
}
