<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class PasswordController extends Controller
{

    protected $redirectTo = "/";

    use ResetsPasswords;

    public function __construct(Guard $auth, PasswordBroker $passwords)
    {

        $this->auth = $auth;
        $this->passwords = $passwords;

        $this->middleware('guest');
    }

    public function postForgotPassword(Request $request)
    {

        $email = $request->email;

        $user = User::where('email', $email)->first();


        if ($user == null) {
            Session::flash("error_msg", "None of the account is associated with the provided email");
            return redirect()->back();
        } else {
            $reset_code = PasswordController::generateResetCode();

            DB::table('password_resets')->insert(['email' => $email, 'token' => $reset_code , 'created_at'=>Carbon::now()]);

            $email_arr = ['name' => $user->username,
                'reset_url' => URL::to('/') . "/reset_password/" . $user->email . "/" . $reset_code,
                'email' => $user->email,'confirmation_code'=>$reset_code];

            Mail::send('auth.reset_password', $email_arr, function ($message) use ($user) {
                $message->to($user->email, $user->username)->subject("Reset Password");
            });

            Session::flash('success_msg', 'Please check your mail in order to reset the password');
            return redirect()->back();
        }

    }

    public function generateResetCode()
    {

        $code = Str::random(12);

        if (DB::table('password_resets')->where("token", $code)->count() > 0) {
            self::generateResetCode();
        }

        return $code;
    }

    public function getReset($email, $code)
    {

        if (strlen($email) <= 0 || strlen($code) <= 0) {
            Session::flash("error_msg", trans('Invalid Request'));
            return redirect()->to('/reset');
        }

        //Check code and email
        $reset = DB::table('password_resets')->where('email', $email)->where('token', $code)->first();

        if ($reset == null) {
            Session::flash("error_msg", "Invalid Request");
            return redirect()->to('/login');
        } else {
            //check for 24 hrs for token

            //Show new password view
            return view('auth.reset', ['email' => $email, 'code' => $code]);

        }
    }

    public function postReset(Request $request)
    {

        $password = $request->password;
        $password_confirmation = $request->password_confirmation;

        if ($password == $password_confirmation) {

            $reset = DB::table('password_resets')->where('email', $request->email)->where('token', $request->code)->first();

            if ($reset != null) {
                $user = User::where('email', $request->email)->first();
                $user->password = Hash::make($password);
                $user->save();

                Session::flash('success_msg', "Password Changed Successfully");
                return redirect()->to('/login');
            } else {
                Session::flash('message', "Invalid Password Entered");
                return redirect()->back();
            }
        } else {
            Session::flash('message', "Password and Password Confirmation Must Match");
            return redirect()->back();
        }
    }




}
