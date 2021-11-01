<?php

namespace App\Repositories;

use App\Counts;
use App\User;
use Auth;
use Illuminate\Support\Str;
use Validator;
use Mail;
use Exception;
use Input;
use Session;
use Hash;
use Illuminate\Http\Request;

class AuthRepository
{


    public function login($email, $password, $remember_me = false)
    {

        $credentials = [
            'email' => $email,
            'password' => $password
        ];

        $user = User::whereEmail($email)->first();

        if($user==null)
        {
            return ['result' => 3, 'message' => 'Email Is Not Registered'];

        }

        try {

            if($user->status == 0)
            {
                return ['result' => 4, 'message' => 'Email Is Not Verified'];

            }


            if (Auth::attempt($credentials, $remember_me)) {
                $counts = Counts::where('client_id', Auth::user()->id)->get();
                if (sizeof($counts) == 0) {
                    $counts = new Counts();
                    $counts->client_id = Auth::user()->id;
                    $counts->save();
                }
                if ($user->role == 'admin') {
                    return ['result' => 2, 'message' => 'Login Successful'];
                } else {

                    return ['result' => 1, 'message' => 'Login Successful'];
                }
            } else {
                return ['result' => 0, 'message' => 'Invalid Credentials'];
            }

        } catch (\Exception $e) {
            return ['result' => 0, 'message' => $e->getMessage()];
        }
    }

    public function register($username, $email, $password, $ip )
    {
        $validator = Validator::make([
            'username' => $username,
            'email' => $email,
            'password' => $password
        ], [
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',

        ]);


        if ($validator->fails()) {
            return ['result' => 0, 'validator' => $validator];
        } else {
            $users = User::where('ip', $ip)->get();
            if (sizeof($users) > 0) {
                return ['result' => 2];
            }

            $confirmation_code = Str::random('30');
            $user = new User();
            $user->name = $username;
            $user->email = $email;
            $user->ip = $confirmation_code;
            $user->confirmation_code = $confirmation_code;
            $user->password = Hash::make($password);
            $user->save();

            \Illuminate\Support\Facades\Mail::send('auth.verify', ['confirmation_code' => $confirmation_code], function ($message) use($email) {
                $message->to($email)
                    ->subject('Verify your email address');
            });

            return ['result' => 1];
        }
    }



    public function confirm($confirmation_code)
    {
        if (!$confirmation_code) {
            return redirect()->to('/register');
        }

        $user = User::whereConfirmationCode($confirmation_code)->first();

        if (!$user) {
            return redirect()->to('/register');
        }

        $user->status = 1;
        $user->save();
        return ['result' => 1];

    }

    public function changePassword($old_password, $new_password, $email = NULL)
    {

        $hash_new_password = Hash::make($new_password);

        if (Hash::check($old_password, Auth::user()->password)) {
            if ($email == NULL) {
                User::whereId(Auth::user()->id)->update(['password' => $hash_new_password]);
            } else {
                User::whereId(Auth::user()->id)->update(['password' => $hash_new_password, 'email' => $email]);
            }
            return ['result' => 1];

        } else {
            return ['result' => 0];

        }

    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return ['result' => 1];


    }


}