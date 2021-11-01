<?php namespace App\Http\Controllers\Auth;

use App\Counts;
use App\Http\Controllers\Controller;
use App\Links;
use App\Repositories\AuthRepository;
use App\User;
use App\Videos;
use App\Websites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class AuthController extends Controller
{

    public $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {

        $response = $this->authRepository->login($request->email, $request->password, $request->remember_me);

        if ($response['result'] == 0) {
            Session::flash('message', 'Invalid Credentials');
            return redirect()->back()->withInput($request->all());
        }

            if($response['result'] == 2)
            {
                return redirect()->to('/administrator');
            }

        if($response['result'] == 1)
        {
            return redirect()->to('/dashboard');

        }

        if ($response['result'] == 3) {
            Session::flash('message', 'Email Is Not Registered');
            return redirect()->back();
        }

        if ($response['result'] == 4) {
            Session::flash('message', 'Email Is Not Verified');
            return redirect()->back();
        }

    }

    public function delete($id=Null)
    {


        if(env('WRITE_ACCESS')==false)
        {
            Session::flash('error_msg', 'Disabled In Demo');

            return redirect()->back();
        }

        if($id==Null) {
            User::whereId(Auth::user()->id)->delete();
            Websites::where('client_id',Auth::user()->id)->delete();
            Links::where('client_id',Auth::user()->id)->delete();
            Videos::where('client_id',Auth::user()->id)->delete();
            Counts::where('client_id',Auth::user()->id)->delete();
        }
        else
        {
            User::whereId($id)->delete();
            Websites::where('client_id',$id)->delete();
            Links::where('client_id',$id)->delete();
            Videos::where('client_id',$id)->delete();
            Counts::where('client_id',$id)->delete();

        }
        Session::flash('success_msg', 'Successfully deleted');
        return redirect()->back();

    }

    public function edit($id)
    {
         $user=User::whereId($id)->first();
        return view('administrator.edit', ['user' => $user]);

    }
    public function postEdit($id)
    {
        $points=Input::get('points');
        $type=Input::get('type');

        User::whereId($id)->update(['points' =>$points,'membership' =>$type]);
        Session::flash('success_msg', 'Successfully Updated');
        return redirect()->back();


    }

    public function changePassword()
    {
        if(env('WRITE_ACCESS')==false)
        {
            Session::flash('error_msg', 'Disabled In Demo');

            return redirect()->back();
        }

        if(Input::has('email')) {
            $response = $this->authRepository->changePassword(Input::get('old_password'), Input::get('new_password'), Input::get('email'));
        }
        else{
            $response = $this->authRepository->changePassword(Input::get('old_password'), Input::get('new_password'));

        }
        if ($response['result'] == 0) {
            Session::flash('error_msg', 'Invalid Credentials');
            return redirect()->back()->withInput(Input::all());
        }
        if ($response['result'] == 1) {
            Session::flash('success_msg', 'Successfully Updated');
            return redirect()->back()->withInput(Input::all());
        }
    }

    public function getRegister($ref_id = 0)
    {
        return view('auth.register', ['ref_id' => $ref_id]);
    }

    public function postRegister($ref_id = 0 , Request $request)
    {
        $response = $this->authRepository->register($request->username, $request->email, $request->password,$request->ip);

        if ($response['result'] == 0) {
            return redirect()->back()->withInput($request->all())->withErrors($response['validator']);
        }
        if ($response['result'] == 2) {
            Session::flash('error_msg', ' Account Is Already Registered On This IP.');
            return redirect()->back();
        }
        if (strlen($ref_id) > 1) {
            $ref = explode('=', $ref_id);
            User::whereId($ref[1])->increment('points', '100');
        }
        Session::flash('success_msg', 'Thanks for signing up! Please Check Your Mail');
        return redirect()->back();

    }

    public function confirm($confirmation_code)
    {
        $response = $this->authRepository->confirm($confirmation_code);

        if ($response['result'] == 1)
            Session::flash('success_msg', 'Successfully Registered');
        return redirect('/login');

    }


    public function logout()
    {
        $response = $this->authRepository->logout();
        if ($response['result'] == 1)
            return redirect()->to('/login');

    }

}
