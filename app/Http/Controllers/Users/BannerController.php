<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Requests\BannerRequest;
use App\Http\Controllers\UserController;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Image;
use App\Helpers\Thumbnail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class BannerController extends UserController
{
    public function __construct()
    {
        $this->middleware('authorized:banner.list', ['only' => ['index']]);
        $this->middleware('authorized:banner.add', ['only' => ['create']]);
        // $this->middleware('authorized:banner.edit', ['only' => ['edit']]);

        parent::__construct();

        $font = ['Arial', 'Helvetica', 'Times New Roman', 'Times', 'Courier New', 'Courier', 'Verdana', 'Georgia', 'Palatino', 'Garamond', 'Bookman', 'Comic Sans MS', 'Trebuchet MS', 'Arial Black', 'Impact'];
        sort($font);
        view()->share('type', 'banner');
        view()->share('font', $font);
    }

    public function index(Request $request)
    {
        $length = $request->length ?: 50;
        $banner = Banner::orderBy('id', 'desc');
        if ($request->search) {
            $banner = $banner->where('id', 'like', '%' . $request->search . '%')
                ->orwhere('name', 'like', '%' . $request->search . '%');
        }
        $count = $banner->count();
        $banner = $banner->paginate($length);
        $page_info = $this->pageInfo($request->page, $length, $count);
        $title = __('banner.title');
        $request->session()->put('redirect_banner', $request->fullUrl());
        return view('user.banner.index', compact('title', 'banner', 'page_info'));
    }

    public function create()
    {
        $title = __('banner.new');
        $this->generateParams();
        return view('user.banner.create', compact('title'));
    }

    public function store(BannerRequest $request)
    {
        $banner = Banner::create($request->only('name', 'size'));
        $images = [];
        if ($request->images) {
            $no = 0;
            foreach ($request->images as $k => $i) {
                $no++;
                $images[$k] = [
                    'link' => $request->link[$k],
                    'text_text' => $request->text_text[$k],
                    'text_color' => $request->text_color[$k],
                    'text_font' => $request->text_font[$k],
                    'text_size' => $request->text_size[$k],
                    'text_left' => $request->text_left[$k],
                    'text_right' => $request->text_right[$k],
                    'text_top' => $request->text_top[$k],
                    'text_bottom' => $request->text_bottom[$k],
                    'button_background' => $request->button_background[$k],
                    'button_text' => $request->button_text[$k],
                    'button_color' => $request->button_color[$k],
                    'button_font' => $request->button_font[$k],
                    'button_size' => $request->button_size[$k],
                    'button_left' => $request->button_left[$k],
                    'button_right' => $request->button_right[$k],
                    'button_top' => $request->button_top[$k],
                    'button_bottom' => $request->button_bottom[$k],
                    'position' => $no,
                ];
            }
        }
        $banner->images()->sync($images);

        return redirect("quantri/banner");
    }

    public function show(Banner $banner)
    {

    }

    public function edit(Banner $banner)
    {
        $title = __('banner.edit') . ' (' . $banner->id . ')';
        $this->generateParams();
        $html = '';
        $banner->images->map(function ($image) use (&$html) {
            $html .= view('user.banner._file', compact('image'))->render();
        });
        return view('user.banner.edit', compact('title', 'banner', 'html'));
    }

    public function update(BannerRequest $request, Banner $banner)
    {
        $banner->update($request->only('name', 'size'));
        $images = [];
        if ($request->images) {
            $no = 0;
            foreach ($request->images as $k => $i) {
                $no++;
                $images[$k] = [
                    'link' => $request->link[$k],
                    'text_text' => $request->text_text[$k],
                    'text_color' => $request->text_color[$k],
                    'text_font' => $request->text_font[$k],
                    'text_size' => $request->text_size[$k],
                    'text_left' => $request->text_left[$k],
                    'text_right' => $request->text_right[$k],
                    'text_top' => $request->text_top[$k],
                    'text_bottom' => $request->text_bottom[$k],
                    'button_background' => $request->button_background[$k],
                    'button_text' => $request->button_text[$k],
                    'button_color' => $request->button_color[$k],
                    'button_font' => $request->button_font[$k],
                    'button_size' => $request->button_size[$k],
                    'button_left' => $request->button_left[$k],
                    'button_right' => $request->button_right[$k],
                    'button_top' => $request->button_top[$k],
                    'button_bottom' => $request->button_bottom[$k],
                    'position' => $no,
                ];
            }
        }
        $banner->images()->sync($images);
        return redirect($request->session()->get('redirect_banner'));
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();
        return 1;
    }

    private function generateParams()
    {
        $status = [1 => 'Active', 0 => 'Inactive'];
        view()->share(['status' => $status]);
    }

    public function upload(Request $request)
    {
        $image = Image::create([
            'name' => $this->uploadFile($request->file('gallery'), 'banner'),
            'alt' => $request->img_alt,
            'title' => $request->img_title,
            'path' => 'banner',
        ]);
        $data = view('user.banner._file', compact('image'))->render();
        return $data;
    }

    public function uploadBanner()
    {
        extract($_GET);

        $data = '';
        if ($img_id) {
            $image = Image::find($img_id);
            $data = view('user.banner._file', compact('image'))->render();
        }
        return $data;
    }

    public function uploadFromUrl(Request $request)
    {
        $pathInfo = pathinfo($request->url);
        $name = $pathInfo['basename'];
        $ext = $pathInfo['extension'];
        if ($name && $ext && in_array($ext, ['jpg', 'png', 'jpeg', 'gif'])) {
            $name = str_replace('.' . $ext, '', $name);
            $name = str_slug($name) . '_' . time() . '.' . $ext;
            $to = public_path() . '/uploads/news/' . $name;
            if ($this->saveImage($request->url, $to)) {
                $image = Image::create([
                    'name' => $name,
                    'title' => $request->title,
                    'alt' => $request->alt,
                    'path' => 'news',
                    'status' => 1,
                ]);
                if (Thumbnail::generate_image_thumbnail($to, public_path() . '/uploads/news/thumb_' . $name)) {
                    $data = view('user.banner._file', compact('image'))->render();
                    return $data;
                }
            }
        }
        return null;
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
}
