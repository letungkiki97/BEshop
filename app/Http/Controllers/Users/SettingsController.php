<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\UserController;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use App\Models\Role;
use Efriandika\LaravelSettings\Facades\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class SettingsController extends UserController
{
    public function __construct()
    {
        parent::__construct();

        view()->share('type', 'setting');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tracking_number = unserialize(DB::table('settings')->where('setting_key', 'tracking_number')->first()->setting_value);
        Settings::set('tracking_number', $tracking_number);
        $title = __('setting.title');
        $max_upload_file_size = array(
            '1000' => '1MB',
            '2000' => '2MB',
            '3000' => '3MB',
            '4000' => '4MB',
            '5000' => '5MB',
            '6000' => '6MB',
            '7000' => '7MB',
            '8000' => '8MB',
            '9000' => '9MB',
            '10000' => '10MB',
        );
        $staffs = [];
        Role::where('permissions', 'like', '%sales_order.add%')->get()->map(function($item) use (&$staffs) {
            $item->users->map(function ($member) use (&$staffs) {
                 $staffs[$member->id] = $member->full_name;
            });
        });
        arsort($staffs);
        $staffs[''] = 'Select sales agent';
        $staffs = array_reverse($staffs, true);
        $email_list = Settings::get('email_list');
		return view('user.setting.index', compact('title', 'max_upload_file_size', 'staffs', 'email_list'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param SettingRequest|Request $request
     * @param Setting $setting
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(SettingRequest $request)
    {
        $site_logo = $request->site_logo ?: null;
        if ($request->hasFile('site_logo_file')) {
            $file = $request->file('site_logo_file');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $site_logo = Str::slug(substr($filename, 0, strrpos($filename, "."))) . '_' . time() . '.' . $extension;
            if($file->move(public_path().'/uploads/site/', $site_logo) && Settings::get('site_logo')) {
                @unlink(public_path().'/uploads/site/'.Settings::get('site_logo'));
            }
        }
        $request->merge(['site_logo' => $site_logo]);
		Settings::set('modules', []);
        $request->date_format = $request->date_format_custom;
        $request->time_format = $request->time_format_custom;
        if ($request->date_format == "") {
            $request->date_format = 'd.m.Y';
        }
        if ($request->time_format == "") {
            $request->time_format = 'H:i';
        }
        $email_list = [];
        if($request->mail_account){
            foreach ($request->mail_account as $k => $v) {
                $email_list[$v] = $request->mail_password[$k];
            }
            $request->merge([
                'email_list' => $email_list,
            ]);
        }
        
        $request->merge([
            'jquery_date' => $this->dateformat_PHP_to_jQueryUI($request->date_format),
            'jquery_date_time' => $this->dateformat_PHP_to_jQueryUI($request->date_format . ' ' . $request->time_format),
        ]);

        foreach ($request->except('_token', 'site_logo_file', 'date_format_custom', 'time_format_custom', 'type', 'role', 'mail_account', 'mail_password') as $key => $value) {
            Settings::set($key, $value);
        }

		return redirect()->to('quantri/setting')->with('status', __('message.setting_updated'));
	}

	/*
 * Matches each symbol of PHP date format standard
 * with jQuery equivalent codeword
 * @author Stojan Kukrika
 */
	function dateformat_PHP_to_jQueryUI($php_format)
	{
		$SYMBOLS_MATCHING = array(
			// Day
			'd' => 'DD',
			'D' => 'ddd',
			'j' => 'D',
			'l' => 'dddd',
			'N' => 'do',
			'S' => 'do',
			'w' => 'd',
			'z' => 'DDD',
			// Week
			'W' => 'w',
			// Month
			'F' => 'MMMM',
			'm' => 'MM',
			'M' => 'MMM',
			'n' => 'M',
			't' => '',
			// Year
			'L' => '',
			'o' => '',
			'Y' => 'YYYY',
			'y' => 'YY',
			// Time
			'a' => 'a',
			'A' => 'A',
			'B' => '',
			'g' => 'h',
			'G' => 'H',
			'h' => 'hh',
			'H' => 'HH',
			'i' => 'mm',
			's' => 'ss',
			'u' => ''
		);


		$jqueryui_format = "";
		$escaping = false;
		for($i = 0; $i < strlen($php_format); $i++)
		{
			$char = $php_format[$i];
			if($char === '\\') // PHP date format escaping character
			{
				$i++;
				if($escaping) $jqueryui_format .= $php_format[$i];
				else $jqueryui_format .= '\'' . $php_format[$i];
				$escaping = true;
			}
			else
			{
				if($escaping) { $jqueryui_format .= "'"; $escaping = false; }
				if(isset($SYMBOLS_MATCHING[$char]))
					$jqueryui_format .= $SYMBOLS_MATCHING[$char];
				else
					$jqueryui_format .= $char;
			}
		}
		return $jqueryui_format;
	}

    public function getContent() {
        $title = __('setting.title');   
        $customer_type = CustomerType::orderBy('name', 'asc')->pluck('name', 'id');
        $feature = Feature::pluck('name', 'id')->prepend('Select feature', '');
        if (Settings::get('default_filter')) {
            $default_filter = explode(',', Settings::get('default_filter'));
        }
        return view('user.setting.content', compact('title', 'customer_type', 'feature', 'default_filter'));
    }

    public function postContent(Request $request) {
        $category_top = $request->category_top ?: null;
        if ($request->hasFile('category_top_file')) {
            $file = $request->file('category_top_file');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $category_top = Str::slug(substr($filename, 0, strrpos($filename, "."))) . '_' . time() . '.' . $extension;
            if($file->move(public_path().'/uploads/site/', $category_top) && Settings::get('category_top')) {
                unlink(public_path().'/uploads/site/'.Settings::get('category_top'));
            }
        }
        $category_middle = $request->category_middle ?: null;
        if ($request->hasFile('category_middle_file')) {
            $file = $request->file('category_middle_file');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $category_middle = Str::slug(substr($filename, 0, strrpos($filename, "."))) . '_' . time() . '.' . $extension;
            if($file->move(public_path().'/uploads/site/', $category_middle) && Settings::get('category_middle')) {
                unlink(public_path().'/uploads/site/'.Settings::get('category_middle'));
            }
        }

        if ($request->default_filter) {
            $default_filter = implode(',', $request->default_filter);
        } else {
            $default_filter = '';
        }
        $request->merge([
            'category_top' => $category_top,
            'default_filter' => $default_filter,
            'category_middle' => $category_middle
        ]);

        foreach ($request->except('category_top_file', 'category_middle_file') as $key => $value) {
            Settings::set($key, $value);
        }
        return redirect()->to('/content_setting')->with('status', __('message.setting_updated'));
    }
}
