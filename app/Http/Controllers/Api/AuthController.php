<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\EmailTemplate;
use Carbon\Carbon;
use Mail;
use Validator;
use Settings;
use Auth;

class AuthController extends Controller 
{
    public function __construct() {
        $this->middleware('auth:api', ['only' => ['getProfile', 'postProfile', 'changePassword', 'resetPassword']]);
    }

	public function login(Request $request) {
        if (Auth::guard('client')->attempt(['contact_email' => $request->email, 'password' => $request->password], $request->remember)) {
            $user = Auth::guard('client')->user();
            $user->update(['api_token' => bcrypt(str_random(60))]);
            return response()->json([
                'message'     => 'OK',
                'status_code' => 200,
                'user'     => $user,
            ], 200);
        }
        return response()->json([
            'message'     => 'Email hoặc mật khẩu không chính xác',
            'status_code' => 401,
        ], 200);
    }

    public function logout(Request $request) {
        if (Auth::guard('client')->user()) {
            Auth::guard('client')->user()->update(['api_token' => null]);
        }
        Auth::guard('client')->logout();
        return response()->json([
            'message'     => 'OK',
            'status_code' => 200,
        ], 200);
    }

    public function register(Request $request) {
        if (!Settings::get('professional_customer') || !Settings::get('individual_customer')) {
            return response()->json([
                'message'       => 'Vui lòng kiểm tra cài đặt CMS',
                'status_code'   => 401,
            ], 200);
        }
        $user = Customer::where('contact_email', $request->email)->whereNull('password')->first();
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message'       => 'Vui lòng kiểm tra lại các trường bắt buộc',
                'status_code'   => 401,
            ], 200);
        }
        if (!$user) {
            $validator = Validator::make($request->all(),[
                'email' => 'unique:customers,contact_email',
            ]);
        }
        if ($validator->fails()) {
            return response()->json([
                'message'       => 'Email là duy nhất',
                'status_code'   => 401,
            ], 200);
        }
        $user_data = [
            'name' => '',
            'contact_email' => $request->email,
            'phone_number' => $request->phone ?: '',
            'city_id' => 0,
            'district_id' => 0,
            'customer_type' => (int) Settings::get('individual_customer'),
            'password' => bcrypt($request->password),
            'api_token' => bcrypt(str_random(60)),
            'status' => 1,
            'gender' => 1,
            'signed_up' => Carbon::now()->format('Y-m-d H:i:s'),
        ];
        if ($user) {
            $user->update($user_data);
        } else {
            $user = Customer::create($user_data);
        }
        return response()->json([
            'message'     => 'OK',
            'status_code' => 200,
            'user'     => $user,
        ], 201);
    }

    public function getProfile(Request $request) {
        $user = Customer::where('api_token', $request->api_token)->first();
        if ($user) {
            return response()->json([
                'message'     => 'OK',
                'status_code' => 200,
                'user' => $user,
            ], 200);
        }
        return response()->json([
            'message'     => 'Không tìm thấy người dùng',
            'status_code' => 404,
        ], 200);
    }

    public function postProfile(Request $request) {
        $user = Customer::where('api_token', $request->api_token)->first();
        if (!$user) {
            return response()->json([
                'message'     => 'Không tìm thấy người dùng',
                'status_code' => 404,
            ], 200);
        }
        $validator = Validator::make($request->all(),[
            'email' => 'email|unique:customers,contact_email,'.$user->id,
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message'       => 'Email không đúng định dạng hoặc đã tồn tại trong hệ thống',
                'status_code'   => 401,
            ], 200);
        }
        $user->update([
            'name' => $request->name ?: $user->name,
            'contact_email' => $request->email ?: $user->contact_email,
            'address' => $request->address ?: $user->address,
            'phone_number' => $request->phone ?: $user->phone_number,
            'website' => $request->website ?: $user->website,
            'company_name' => $request->company_name ?: $user->company_name,
            'company_email' => $request->company_email ?: $user->company_email,
            'city_id' => $request->city ?: $user->city_id,
            'district_id' => $request->district ?: $user->district_id,            
            'status' => 1,
            'gender' => $request->gender != '' ? $request->gender : $user->gender,
        ]);
        if ($request->has('type')) {
            $user->update([
                'customer_type' => $request->type ? Settings::get('professional_customer') : Settings::get('individual_customer'),
            ]);
            $this->welcomeUser($user, $request->type);
        }
        return response()->json([
            'message'     => 'OK',
            'status_code' => 200,
            'user' => $user,
        ], 200);
    }

    public function changePassword(Request $request) {
        $user = Customer::where('api_token', $request->api_token)->first();
        if (!$user) {
            return response()->json([
                'message'     => 'Không tìm thấy người dùng',
                'status_code' => 404,
            ], 200);
        }
        $validator = Validator::make($request->all(),[
            'old_password' => 'required',
            'new_password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message'       => 'Vui lòng kiểm tra lại các trường bắt buộc',
                'status_code'   => 401,
            ], 200);
        }
        if (!Auth::guard('client')->attempt(['contact_email' => $user->contact_email, 'password' => $request->old_password])) {
            return response()->json([
                'message'     => 'Mật khẩu cũ không đúng',
                'status_code' => 401,
            ], 200);
        }
        $user->update([
            'password' => bcrypt($request->new_password),
            'api_token' => bcrypt(str_random(60))
        ]);
        return response()->json([
            'message'     => 'OK',
            'status_code' => 200,
            'user' => $user,
        ], 200);
    }

    public function requestPassword(Request $request) {
        if (!$request->email || !$request->redirect) {
            return response()->json([
                'message'     => 'Thiếu email hoặc link chuyển trang',
                'status_code' => 401,
            ], 200);
        }
        $customer = Customer::where('contact_email', $request->email)->whereNotNull('password')->first();
        if (!$customer) {
            return response()->json([
                'message'     => 'Người dùng không tồn tại',
                'status_code' => 404,
            ], 200);
        }
        $customer->update(['api_token' => str_random(60)]);
        $name = explode("@",$customer->contact_email);
        $name[0] = str_replace('.', '', $name[0]);
        $email = implode('@', $name);
        $mail = EmailTemplate::where('type', 'password_mail')->first();
        $link = $request->redirect . '?api_token=' . $customer->api_token;
        $mail->text = str_replace('[link]', '<a href="' . $link . '">Ấn vào đây để đặt lại mật khẩu</a>', $mail->text);
        $mail->text = str_replace('[email]', '<a href="mailto:' . $customer->contact_email . '">'.$customer->contact_email.'</a>', $mail->text);
        $mail_list = Settings::get('email_list');
        if (array_key_exists($mail->from_address, $mail_list)) {
            config([
                'mail.username' => $mail->from_address,
                'mail.password' => $mail_list[$mail->from_address],
            ]);
        }
        $from = ucfirst(explode('@', config('mail.username'))[0]) . ' | ' . ucfirst(explode('@', config('mail.username'))[1]);
        Mail::send('user.mail.template', ['mail' => $mail], function($message) use ($email, $mail, $from) {
            $message->from(config('mail.username'), $from);
            $message->to($email);
            $message->subject($mail->subject);
        });
        if (!Mail::failures()) {
            return response()->json([
                'message'     => 'OK',
                'status_code' => 200,
            ], 200);
        }
    }

    public function resetPassword(Request $request) {
        $user = Customer::where('api_token', $request->api_token)->first();
        if (!$user) {
            return response()->json([
                'message'     => 'Không tìm thấy người dùng',
                'status_code' => 404,
            ], 200);
        }
        $time = Carbon::now()->subMinutes(15);
        if (Carbon::createFromFormat('Y-m-d H:i:s', $user->updated_at)->lt($time)) {
            return response()->json([
                'message'     => 'Token hết hạn',
                'status_code' => 401,
            ], 200);
        }
        $validator = Validator::make($request->all(),[
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message'       => 'Mật khẩu tối thiểu 6 kí tự',
                'status_code'   => 401,
            ], 200);
        }
        $user->update(['password' => bcrypt($request->password)]);
        return response()->json([
            'message'     => 'OK',
            'status_code' => 200,
        ], 200);
    }

    public function social(Request $request) {
        if (!Settings::get('professional_customer') || !Settings::get('individual_customer')) {
            return response()->json([
                'message'       => 'Vui lòng kiểm tra cài đặt CMS',
                'status_code'   => 401,
            ], 200);
        }
        if (!$request->api_token) {
            return response()->json([
                'message'     => 'API Token là bắt buộc',
                'status_code' => 401,
            ], 200);
        }
        $user = Customer::where('api_token', $request->api_token)->first();
        if ($user) {
            return response()->json([
                'message'     => 'OK',
                'status_code' => 200,
                'user'        => $user
            ], 200);
        }
        $user = Customer::where('contact_email', $request->email)->first();
        if (!$user) {
            $user = Customer::create([
                'address' => $request->address ?: '',
                'gender' => 1,
                'status' => 1,
                'customer_type' => Settings::get('individual_customer'),
                'phone_number' => $request->phone ?: '',
                'contact_email' => $request->email,
                'name' => $request->name ?: '',
                'city_id' => 0,
                'district_id' => 0,
                'signed_up' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
        $user->update(['api_token' => $request->api_token]);
        return response()->json([
            'message'     => 'OK',
            'status_code' => 200,
            'user' => $user,
        ], 200);
    }

    public function welcomeUser(Customer $customer, $type) {
        $name = explode("@",$customer->contact_email);
        $name[0] = str_replace('.', '', $name[0]);
        $email = implode('@', $name);
        $mail_type = $type ? 'pending_professional_mail' : 'normal_user_mail';
        $mail = EmailTemplate::where('type', $mail_type)->first();
        $mail_list = Settings::get('email_list');
        if (array_key_exists($mail->from_address, $mail_list)) {
            config([
                'mail.username' => $mail->from_address,
                'mail.password' => $mail_list[$mail->from_address],
            ]);
        }
        $from = ucfirst(explode('@', config('mail.username'))[0]) . ' | ' . ucfirst(explode('@', config('mail.username'))[1]);
        $customer_text = $customer->gender ? '(Mr.) ' . $customer->name : '(Ms.) '. $customer->name;
        $mail->text = str_replace('[customer]', $customer_text, $mail->text);
        $mail->text = str_replace('[CUSTOMER]', strtoupper($customer_text), $mail->text);
        $mail->subject = str_replace('[customer]', $customer_text, $mail->subject);
        $mail->subject = str_replace('[CUSTOMER]', strtoupper($customer_text), $mail->subject);
        $mail->title = str_replace('[customer]', $customer_text, $mail->title);
        $mail->title = str_replace('[CUSTOMER]', strtoupper($customer_text), $mail->title);
        Mail::send('user.mail.template', ['mail' => $mail], function($message) use ($email, $mail, $from) {
            $message->from(config('mail.username'), $from);
            $message->to($email);
            $message->subject($mail->subject);
        });
        if (!Mail::failures()) {
            return 0;
        }
        return 1;
    }
}
