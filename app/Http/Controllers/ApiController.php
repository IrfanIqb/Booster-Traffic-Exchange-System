<?php namespace App\Http\Controllers;

use App\User;
use App\Repositories\ApiRepository;
use App\Websites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use DB;
use App\Counts;
use Carbon\Carbon;
use Session;
use Stripe\Charge;
use Stripe\Stripe;

class ApiController extends Controller
{
    public $apiRepository;

    public function __construct(ApiRepository $apiRepository)
    {
        $this->apiRepository = $apiRepository;
    }

    public function trafficExchange()
    {

        return view('traffic-exchange');
    }

    public function manualExchange()
    {
        $link = null;


        $websites = Websites::where('client_id', '!=', Auth::user()->id)->where('status', 1)->orderByRaw("RAND()")->take(15)->get();


        foreach ($websites as $website) {
            $clients = User::whereId($website->client_id)->get();
            foreach ($clients as $client) {
                if ($client->points > 0) {
                    $link[] = $website;
                }
            }

        }
        if ($link === null) {
            return view('manual-exchange', ['websites' => []]);

        } else {
            return view('manual-exchange', ['websites' => $link]);

        }
    }

    public function PostManualExchange($client_id )
    {
        $session = Session::get('success');


        if ($session == 'successfully_visited') {


            User::whereId(Auth::user()->id)->increment('points', 1);

            User::whereId($client_id)->decrement('points', 1);


            $count = Counts::where('created_at', '>', Carbon::today()->startOfDay())->where('created_at', '<', Carbon::today()->endOfDay())->where('client_id', Auth::user()->id)->get();


            //incrementing counts and hits for graphs

            if (sizeof($count) > 0) {


                Counts::where('created_at', '>', Carbon::today()->startOfDay())->where('created_at', '<', Carbon::today()->endOfDay())->where('client_id', Auth::user()->id)->increment('points', 1);
                Counts::where('created_at', '>', Carbon::today()->startOfDay())->where('created_at', '<', Carbon::today()->endOfDay())->where('client_id', $client_id)->increment('hits', 1);

            } else {
                $count = new Counts();
                $count->client_id = Auth::user()->id;
                $count->save();
                $count = new Counts();
                $count->client_id = $client_id;
                $count->save();
                Counts::where('client_id', Auth::user()->id)->where('created_at', '>', Carbon::today()->startOfDay())->where('created_at', '<', Carbon::today()->endOfDay())->increment('points', 1);
                Counts::where('client_id', $client_id)->where('created_at', '>', Carbon::today()->startOfDay())->where('created_at', '<', Carbon::today()->endOfDay())->increment('hits', 1);
            }

            \Session::flash('message', 'Successfully Visited  ');

            return redirect()->back();
        }


        return redirect()->back();


    }

    public function session()
    {

        $response = $this->apiRepository->session();

        foreach ($response as $value) {
            return $value;
        }

    }




    public function increment(Request $request)
    {
        $client_id = $request->client_id;
        $this->apiRepository->increment($client_id);

    }

    public function stripe()
    {
        $token = Input::get('stripeToken');
        $memberships = DB::table('memberships')->first();
        $amount = ($memberships->amount) * 100;

        Stripe::setApiKey(env('STRIPE_API_SECRET'));

        Charge::create ([
            "amount" => $amount,
            "currency" => "usd",
            "source" => $token,
        ]);

        User::whereId(Auth::user()->id)->update(['membership' => "paid"]);


        Session::flash('success', 'Payment successful!');

        return back();
    }


    public function purchasePoints()
    {
        $token = Input::get('stripeToken');

        $amount = Input::get('amount');
        $points = Input::get('points');


        Stripe::setApiKey(env('STRIPE_API_SECRET'));

        Charge::create ([
            "amount" => $amount,
            "currency" => "usd",
            "source" => $token,
        ]);

        User::whereId(Auth::user()->id)->increment('points', $points);
    }


    public function check()
    {
        Session::flash('success', 'successfully_visited');

        return Session::get('success');
    }

    public function shortLinks()
    {
        $client_id=Input::get('client_id');

        $count = Counts::where('created_at', '>', Carbon::today()->startOfDay())->where('created_at', '<', Carbon::today()->endOfDay())->where('client_id', $client_id)->get();


        //incrementing counts and hits for graphs

        if (sizeof($count) > 0) {
            Counts::where('created_at', '>', Carbon::today()->startOfDay())->where('created_at', '<', Carbon::today()->endOfDay())->where('client_id',$client_id)->increment('points', 1);

        } else {
            $count = new Counts();
            $count->client_id = Auth::user()->id;
            $count->save();
            $count = new Counts();
            $count->client_id = $client_id;
            $count->save();
            Counts::where('client_id', $client_id)->where('created_at', '>', Carbon::today()->startOfDay())->where('created_at', '<', Carbon::today()->endOfDay())->increment('points', 1);
        }

        User::whereId($client_id)->increment('points', 1);

    }


}
