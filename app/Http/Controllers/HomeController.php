<?php namespace App\Http\Controllers;

use App\Links;
use App\Memberships;
use App\Points;
use App\Support;
use App\System;
use App\User;
use App\Videos;
use App\Websites;
use App\Withdrawals;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use DB;
use Session;
use Auth;

class HomeController extends Controller
{

    //Returning Views

    public function referrals()
    {
        return view('referrals');
    }

    public function index()
    {

        return view('landing');
    }

    public function subscriptions()
    {
        $memberships = DB::table('memberships')->first();
        return view('subscriptions', ['memberships' => $memberships]);
    }


    public function points()
    {
        $basic = Points::where('type', 'basic')->first();
        $professional = Points::where('type', 'professional')->first();
        $premium = Points::where('type', 'premium')->first();
        $gold = Points::where('type', 'gold')->first();

        return view('points', ['basic' => $basic, 'professional' => $professional, 'premium' => $premium, 'gold' => $gold]);
    }


    public function transfers()
    {

        return view('transfers');
    }

    public function withdraw()
    {

        return view('withdraw');
    }

    public function gettransfers()
    {

        $transfers=DB::table('transfers')->where('from',Auth::user()->email)->orWhere('to',Auth::user()->email)->get();

        return view('transfers_list',['transfers'=>$transfers]);
    }

    public function getwithdrawals()
    {

        $withdrawals=DB::table('withdrawals')->where('email',Auth::user()->email)->get();

        return view('withdrawal_list',['withdrawals'=>$withdrawals]);
    }



    public function downloads()
    {
        return view('downloads');
    }

    public function support()
    {
        return view('support');
    }

    public function settings()
    {
        return view('settings');
    }

    //post Routes

    public function storeSubscriptionAmount()
    {
        if(env('WRITE_ACCESS')==false)
        {
            Session::flash('message', 'Disabled In Demo');

            return redirect()->back();
        }
        $membership = Memberships::all();
        $amount = Input::get('amount');
        if (sizeof($membership) > 0) {
            DB::table('memberships')->update(['amount' => $amount]);
            Session::flash('message', 'Successfully Updated ');
            return redirect()->back();
        } else {
            $membership_settings = new Memberships();
            $membership_settings->amount = $amount;
            $membership_settings->save();
            Session::flash('message', 'Successfully Saved ');
            return redirect()->back();
        }
    }

    public function setPointsSettings()
    {
        if(env('WRITE_ACCESS')==false)
        {
            Session::flash('message', 'Disabled In Demo');

            return redirect()->back();
        }
        $amount = Input::get('amount');
        $points = Input::get('points');
        $type = Input::get('type');

        $package = Points::where('type', $type)->first();
        if (isset($package) ) {
            DB::table('points')->where('type', $type)->update(['amount' => $amount, 'points' => $points]);
            Session::flash('message', 'Successfully Updated ');
            return redirect()->back();
        } else {
            $points_settings = new Points();
            $points_settings->amount = $amount;
            $points_settings->points = $points;
            $points_settings->type = $type;
            $points_settings->save();
            Session::flash('message', 'Successfully Saved ');
            return redirect()->back();
        }
    }

    public function processTransfers()
    {

        $email=Input::get('email');
        $points=Input::get('points');
        $verify_email=User::where('email',$email)->get();
        if(sizeof($verify_email)==0)
        {
            Session::flash('message', 'Invalid Email User Not Found ');
            return redirect()->back();
        }
        if($points>Auth::user()->points)
        {

            Session::flash('message', 'Insufficient Points ');
            return redirect()->back();

        }

        User::where('email',Auth::user()->email)->decrement('points',$points );
        User::where('email',$email)->increment('points',$points );

        DB::table('transfers')->insert(['from'=>Auth::user()->email,'to'=>$email,'amount'=>$points,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]);
        Session::flash('message', 'Successfully Transferred ');
        return redirect()->back();



    }

    public function processWithdraw()
    {

        $email=Input::get('email');
        $points=Input::get('points');

        if($points>Auth::user()->points)
        {

            Session::flash('success_message', 'Insufficient Points ');
            return redirect()->back();

        }

        User::where('email',Auth::user()->email)->decrement('points',$points );
        $withdraw = New Withdrawals();
        $withdraw->email=Auth::user()->email;
        $withdraw->paypal_email=$email;
        $withdraw->points=$points;
        $withdraw->save();

        Session::flash('success_message', 'Successfully Withdrawn ');
        return redirect()->back();



    }



    //Administrator Routes

    public function messages()
    {
        $messages = Support::all();

        return view('administrator.support', ['messages' => $messages]);
    }

    public function withdrawals()
    {
        $withdrawals = Withdrawals::all();

        return view('administrator.withdrawals', ['withdrawals' => $withdrawals]);
    }

    public function social()
    {
        $links = Links::all();

        return view('administrator.links', ['links' => $links]);
    }

    public function deleteLink($id)

    {
        if(env('WRITE_ACCESS')==false)
        {
            Session::flash('error_msg', 'Disabled In Demo');

            return redirect()->back();
        }
        Links::where('id', $id)->delete();
        return redirect()->back();

    }

    public function translate($id,$lang_name)
    {

        Session::put('lang', $id);

        Session::put('lang_name', $lang_name);

        return redirect()->back();
    }

    public function deleteVideo($id)

    {
        if(env('WRITE_ACCESS')==false)
        {
            Session::flash('error_msg', 'Disabled In Demo');

            return redirect()->back();
        }
        Videos::where('id', $id)->delete();
        return redirect()->back();

    }

    public function media()
    {
        $videos = Videos::all();

        return view('administrator.media', ['videos' => $videos]);
    }

    public function changeStatus($id)
    {
        Withdrawals::where('id',$id)->update(['status' => 'Paid']);

        return redirect()->back();

    }

    public function linkStatus($id)
    {

        $link=Links::where('id',$id)->first();

        if($link->status == 0)
        {
            Links::where('id',$id)->update(['status' => 1]);
            return redirect()->back();

        }
        else
        {
            Links::where('id',$id)->update(['status' => 0]);
            return redirect()->back();
        }



    }

    public function videoStatus($id)
    {

        $video = Videos::where('id', $id)->first();
        if ($video->status == 0) {
            Videos::where('id', $id)->update(['status' => 1]);
            return redirect()->back();

        } else {
            Videos::where('id', $id)->update(['status' => 0]);
            return redirect()->back();
        }
    }

    public function changePassword()
    {

        return view('administrator.settings');
    }

    public function users()
    {
        $users = User::whereRole('client')->get();

        return view('administrator.users', ['users' => $users]);
    }

    public function websites()
    {
        $websites = Websites::all();

        return view('administrator.websites', ['websites' => $websites]);
    }

    public function pointsSettings()
    {
        return view('administrator.points');
    }

    public function subscriptionSettings()
    {
        return view('administrator.subscriptions');
    }
    public function system()
    {
        return view('administrator.system');
    }
    public function postSystem()
    {
        if(env('WRITE_ACCESS')==false)
        {
            Session::flash('message', 'Disabled In Demo');

            return redirect()->back();
        }

        $website_name=Input::get('name');
        $website_logo=Input::file('logo');
        $meta=Input::get('meta');
        $point_value=Input::get('point_value');
        $share_limit=Input::get('share_limit');
        $destinationPath = public_path('/');


        $size=System::all();

        if(sizeof($size)>0)
        {
            $name = 'logo.png';
            $website_logo->move($destinationPath, $name);
            $filename = $name;

            DB::table('systems')->update(['name' =>$website_name,'logo' =>$filename,'meta' =>$meta,'point_value' =>$point_value,'share_limit' =>$share_limit]);

            Session::flash('message', 'Successfully Updated ');

            return redirect()->back();


        }
        else
        {
            $name = 'logo.png';
            $website_logo->move($destinationPath, $name);
            $filename = $name;

            $system=new System();

            $system->name=$website_name;
            $system->logo=$filename;
            $system->meta=$meta;
            $system->point_value=$point_value;
            $system->share_limit=$share_limit;
            $system->save();

            Session::flash('message', 'Successfully Added ');
            return redirect()->back();


        }

    }


    public function emailing()
    {
        return view('administrator.emailing');
    }

    public function PostEmailing()
    {
        if(env('WRITE_ACCESS')==false)
        {
            Session::flash('message', 'Disabled In Demo');

            return redirect()->back();
        }

        $subject=Input::get('subject');
        $description=Input::get('message');

        $users=User::all();


        foreach ($users as $user) {

            \Mail::send('auth.emailing', ['description' => $description ,'subject'=>$subject], function ($message) use($user,$subject) {
                $message->to($user->email)
                    ->subject($subject);
            });



        }

        Session::flash('message', 'Successfully Sended ');
        return redirect()->back();

    }


    public function panelShow()
    {


        return view('administrator.panel');


    }

    public function panelStore()
    {
        if(env('WRITE_ACCESS')==false)
        {
            Session::flash('message', 'Disabled In Demo');

            return redirect()->back();
        }

        $traffic_exchange=Input::get('traffic_exchange');
        $manual_exchange=Input::get('manual_exchange');
        $social_exchange=Input::get('social_exchange');
        $media_exchange=Input::get('media_exchange');
        $referral=Input::get('referral');
        $paypal=Input::get('paypal');
        $stripe=Input::get('stripe');
        $points=Input::get('points');



        $size=DB::table('control_panel')->get();

        if(sizeof($size)>0)
        {

            DB::table('control_panel')->update(['traffic_exchange' =>$traffic_exchange,'manual_exchange' =>$manual_exchange,'social_exchange' =>$social_exchange,'media_exchange' =>$media_exchange,'referral' =>$referral,'paypal' =>$paypal,'stripe' =>$stripe,'points' =>$points]);

            Session::flash('message', 'Successfully Updated ');

            return redirect()->back();


        }
        else
        {

            DB::table('control_panel')->insert(['traffic_exchange' =>$traffic_exchange,'manual_exchange' =>$manual_exchange,'social_exchange' =>$social_exchange,'media_exchange' =>$media_exchange,'referral' =>$referral,'paypal' =>$paypal,'stripe' =>$stripe,'points' =>$points]);


            Session::flash('message', 'Successfully Added ');
            return redirect()->back();


        }

    }

    public function adminTransfers()
    {
        $transfers=DB::table('transfers')->get();
        return view('administrator.transfers',['transfers'=>$transfers]);

    }

    public function activities()
    {
        $activities=DB::table('activities')->paginate(10);
        return view('administrator.activities',['activities'=>$activities]);

    }

    public function postActivities()
    {
        $search=Input::get("search");
        $activities=DB::table('activities')->where('client_id',$search)->paginate(10000);
        return view('administrator.activities',['activities'=>$activities]);
    }

    public function redirect($id)
    {
        $short_link=$_SERVER['HTTP_HOST']."/".$id;

        $website=Websites::where('short_link',$short_link)->first();


        return view('ads',['website'=>$website]);
    }

}
