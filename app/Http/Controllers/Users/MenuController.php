<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Models\Menu;
use App\Http\Requests\MenuRequest;
use App\Helpers\Thumbnail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MenuController extends UserController
{
    protected $list;
    public function __construct() {
        $this->middleware('authorized:menu.list', ['only' => ['index']]);
        $this->middleware('authorized:menu.add', ['only' => ['create']]);
        // $this->middleware('authorized:menu.edit', ['only' => ['edit']]);

        parent::__construct();

        view()->share('type', 'menu');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $title = __('menu.title');
        $this->recursive(Menu::all());
        $menus = $this->list;
        $nestable = view('user.menu._nestable', ['data' => Menu::where('parent_id', 0)->orderBy('position', 'asc')->get()])->render();
        return view('user.menu.index', compact('title', 'nestable', 'menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        if ($request->hasFile('image_file')) {
            $image = $this->uploadFile($request->image_file, 'menu');
            $request->merge(['image' => $image]);
        }
        if (!$request->parent_id) {
            $request->merge(['parent_id' => 0]);
        }
        $menu = Menu::create($request->except('image_file'));
        return redirect('menu');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return response()->json($menu, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        $image = $request->image ?: null;
        if ($request->hasFile('image_file')) {
            $image = $this->uploadFile($request->image_file, 'menu');
        }
        $request->merge(['image' => $image]);
        if (!$request->parent_id) {
            $request->merge(['parent_id' => 0]);
        }
        if (!$request->bold) {
            $request->merge(['bold' => 0]);
        }
        $menu->update($request->except('image_file'));
        return redirect('menu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Menu $menu)
    {
        $menu->delete();
        return 1;
    }

    public function recursive($data = array(), $current = 0, $parent = 0, $string = "") {
        foreach ($data as $val) {
            if ($val->parent_id == $parent) {
                $this->list .= "<option value=" . $val->id;
                if ($val->id == $current) {
                    $this->list .= " selected";
                }
                $this->list .= ">" . $string . $val->name . "</option>";
                $this->recursive($data, $current, $val->id, $string . "|--");
            }
        }
    }

    public function serialize(Request $request) {
        if (count($request->data)) {
            $this->updatePosition($request->data, 0);
        }
        return 1;
    }

    public function updatePosition($data, $parent) {
        foreach ($data as $key => $val) {
            $menu = Menu::find($val['id']);
            if ($menu) {
                $menu->update(['parent_id' => $parent, 'position' => $key + 1]);
                $menu->save();
                if (isset($val['children']) && count($val['children'])) {
                    $this->updatePosition($val['children'], $val['id']);
                }
            }
        }
    }
}
