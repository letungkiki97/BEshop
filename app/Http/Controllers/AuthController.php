<?php

namespace App\Http\Controllers;

use App\Helpers\Thumbnail;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\PasswordConfirmRequest;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\StaffRequest;
use App\Http\Requests\UserRequest;
use App\Models\Email;
use App\Models\User;
use App\Models\UserLogin;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use Efriandika\LaravelSettings\Facades\Settings;
use Flash;
use Illuminate\Support\Facades\Mail;
use Sentinel;
use Session;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AuthController extends Controller
{

    use ResetsPasswords;

    protected $redirectTo = '/';

    public function index()
    {
        if (Sentinel::check()) {
            return redirect("/");
        }
        return view('login');
    }

    /**
     * Account sign in.
     *
     * @return View
     */
    public function getSignin()
    {
        if (Sentinel::check()) {
            if (Sentinel::getUser()->inRole('admin') || $user->authorized($permission)) {
                return redirect("/");
            } else {
                return redirect("customers");
            }
        }
        return view('login');
    }

    /**
     * Account sign up.
     *
     * @return View
     */
    public function getSignup($code)
    {
        $inviteUser = InviteUser::where('code', $code)->whereNull('claimed_at')->first();
        if (Sentinel::check() || !isset($inviteUser)) {
            return redirect("/");
        }

        return view('invite', compact('inviteUser'));
    }
    /**
     * Account sign in form processing.
     *
     * @return Redirect
     */
    public function postSignin(LoginRequest $request)
    {
        try {
            if ($user = Sentinel::authenticate($request->only('email', 'password'), $request->has('remember'))) {
                Flash::success(trans('auth.signin_success'));

                $userLogin = new UserLogin();
                $userLogin->user_id = $user->id;
                $userLogin->ip_address = $request->ip();
                $userLogin->save();

                return redirect('quantri');

                //redirect depending on logged in user role
                // if ($user->inRole('admin') || $user->inRole('staff')) {
                //     return redirect("/");
                // } else {
                //     return redirect("customers");
                // }
            }
            Flash::error(trans('auth.login_params_not_valid'));
        } catch (NotActivatedException $e) {
            Flash::error(trans('auth.account_not_activated'));
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            Flash::error(trans('auth.account_suspended') . $delay . trans('auth.second'));
        }
        return back()->withInput();
    }

    /**
     * Account sign up form processing.
     *
     * @param UserRequest $request
     * @param $code
     * @return Redirect
     */
    public function postSignup(UserRequest $request, $code)
    {
        $inviteUser = InviteUser::where('code', $code)->whereNull('claimed_at')->first();
        if (!is_null($inviteUser)) {
	        $user_old = User::where('email', $inviteUser->email)->first();
        	 if (is_null($user_old)) {
		         $staff = Sentinel::registerAndActivate(
			         array (
				         'first_name' => $request->first_name,
				         'last_name'  => $request->last_name,
				         'email'      => $inviteUser->email,
				         'password'   => $request->password,
			         )
		         );
		         $role  = Sentinel::findRoleBySlug( 'staff' );
		         $role->users()->attach( $staff );

		         $user               = User::find( $staff->id );
		         $user->user_id      = $inviteUser->user_id;
		         $user->phone_number = $request->phone_number;
		         $user->save();

		         $inviteUser->claimed_at = Carbon::now()->format(Settings::get('date_format').' '.Settings::get('time_format'));
		         $inviteUser->save();

		         return redirect( '/' );
	         }else{
		         Flash::warning(trans("auth.user_already_registered"));
		         return back()->withInput();
	         }
        } else {
            return back()->withInput();
        }
    }
    /**
     * Account forgot password.
     *
     * @return View
     */
    public function getForgotPassword()
    {
        if (Sentinel::check()) {
            return redirect("/");
        }
        return view('forgot');
    }

    /**
     * Forgot password form processing page.
     *
     * @return Redirect
     */
    public function postForgotPassword(PasswordResetRequest $request)
    {
        if (!filter_var(Settings::get('site_email'), FILTER_VALIDATE_EMAIL) === false) {
	        $userFind = User::where('email', $request->email)->first();
	        if (isset($userFind->id)) {
		        $user = Sentinel::findById($userFind->id);
		        ($reminder = Reminder::exists($user)) || ($reminder = Reminder::create($user));

		        $data = [
			        'email' => $user->email,
			        'name' => $userFind->full_name,
			        'subject' => trans('auth.reset_your_password'),
			        'code' => $reminder->code,
			        'id' => $user->id
		        ];
		        Mail::send('emails.reminder', $data, function ($message) use ($data) {
                    $message->from(config('mail.username'), 'Accounting | Caza.vn');
			        $message->to($data['email'], $data['name'])->subject($data['subject']);
		        });

		        Flash::success(trans("auth.reset_password_link_send"));
		        return back();
	        }
	        Flash::warning(trans("auth.user_dont_exists"));
	        return back();
        } else {
            return redirect()->back();
        }
    }

	public function edit($id, $code)
	{
		$user = Sentinel::findById($id);
		if (Reminder::exists($user, $code)) {
			return view('edit', ['id' => $id, 'code' => $code]);
		} else {
			return redirect('/signin');
		}
	}

	public function update($id, $code, PasswordConfirmRequest $request)
	{
		$user = Sentinel::findById($id);
		$reminder = Reminder::exists($user, $code);
		//incorrect info was passed.
		if ($reminder == false) {
			Flash::error(trans("auth.reset_password_failed"));
			return redirect('/');
		}
		Reminder::complete($user, $code, $request->password);
		Flash::success(trans("auth.reset_password_success"));
		return redirect('/signin');
	}

    /**
     * Logout page.
     *
     * @return Redirect
     */
    public function getLogout()
    {
        Sentinel::logout(null, true);
        Flash::success(trans('auth.successfully_logout'));
        return redirect('quantri/signin');
    }

    /**
     * Profile page.
     *
     * @return Redirect
     */
    public function getProfile()
    {
        if (!Sentinel::check()) {
            return redirect("/");
        }

        $title = trans('auth.user_profile');
        $user_data = User::find(Sentinel::getUser()->id);
        return view('profile', compact('title', 'user_data'));
    }

    public function getAccount()
    {
        if (!Sentinel::check()) {
            return redirect("/");
        }
        $title = trans('auth.edit_profile');
        $user_data = User::find(Sentinel::getUser()->id);
        $lang = ['en' => 'English', 'vi' => 'Vietnamese'];

        return view('account', compact('title', 'user_data', 'lang'));
    }

    public function postAccount(StaffRequest $request)
    {
        if (!Sentinel::check()) {
            return redirect("/");
        }

        $user = User::find(Sentinel::getUser()->id);
        if ($request->password != "") {
            $user->password = bcrypt($request->password);
        }
        $user_avatar = $request->user_avatar ?: null;
        if ($request->hasFile('avatar_file')) {
            $user_avatar = $this->uploadFile($request->avatar_file, 'avatar');
        }
        $request->merge(['user_avatar' => $user_avatar]);
        $user->update($request->except('avatar_file', 'password', 'password_confirmation', 'warehouse', 'to_warehouse'));
        Flash::success(trans('auth.successfully_change_profile'));
        return redirect('profile');
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
