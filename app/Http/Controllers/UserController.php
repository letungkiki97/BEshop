<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Efriandika\LaravelSettings\Facades\Settings;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Helpers\Thumbnail;
use Carbon\Carbon;
use Sentinel;
use Config;
use Flash;

class UserController extends Controller {
	protected $user;
	protected $non_read_meeages;
	protected $last_meeages;

	public function __construct() {
		$this->middleware( function ( $request, $next ) {
			if (Sentinel::check() && Sentinel::getUser()->status) {
				$this->user = Sentinel::getUser();
				$locale = $this->user->lang ?: 'en';
				Config::set('app.locale', $locale);
				Config::set('app.fallback_locale', $locale);
				view()->share( 'user_data', $this->user );
				view()->share( 'jquery_date', Settings::get( 'jquery_date' ) );
				view()->share( 'jquery_date_time', Settings::get( 'jquery_date_time' ) );
			} else {
				if (Sentinel::check()) {
					Flash::error(__('auth.account_not_activated'));
				}
				Sentinel::logout( null, true );
				return redirect( 'signin' )->send();
			}

			return $next( $request );
		} );
	}

	public function pageInfo($page, $length, $count) {
		$page = $page ?: 1;
        $from = ($page-1) * $length + 1;
        $to = ($page) * $length;
        $to = $to > $count ? $count : $to;
        $from = $from > $to ? $to : $from;
        return 'Showing ' . $from . ' to ' . $to . ' of ' . $count . ' entries';
	}

	public function uploadFile(UploadedFile $file, $path) {
		$destinationPath = public_path() . '/uploads/' . $path;
		if(!is_dir($destinationPath)){
            mkdir($destinationPath, 0777, true);
            copy(public_path() . '/uploads/index.html', $destinationPath . '/index.html');
            copy(public_path() . '/uploads/.ignore', $destinationPath . '/.gitignore');
        }
        $extension = $file->getClientOriginalExtension();
        $filename = $file->getClientOriginalName();
        $picture = str_slug(substr($filename, 0, strrpos($filename, "."))) . '_' . time() . '.' . $extension;
        $image = $file->move($destinationPath, $picture);
        if ($image) {
	        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
        		$sourcePath = $image->getPath() . '/' . $image->getFilename();
	        	$thumbPath = $image->getPath() . '/thumb_' . $image->getFilename();
	        	Thumbnail::generate_image_thumbnail($sourcePath, $thumbPath);
	    	}
	        return $image->getFileInfo()->getFilename();
        }
        return null;
	}
}
