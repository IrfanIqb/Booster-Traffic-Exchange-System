<?php namespace App\Http\Controllers;


use App\Websites;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\User;
use Auth;
use App\Counts;
use Carbon\Carbon;
use Session;
use App\Links;
use Validator;

class SocialController extends Controller
{


    public function getView()
    {
        $link = null;
        $sharers = null;

        $shared_links = DB::table('share_count')->where('start_date', '<', Carbon::now())->where('end_date', '>', Carbon::now())->where('client_id', Auth::user()->id)->get(['shared_link']);

        foreach ($shared_links as $shared_link) {
            $sharers[] = $shared_link->shared_link;
        }

        if (isset($sharers)) {
            $websites = Links::where('client_id', '!=', Auth::user()->id)->where('status', 1)->whereNotIn('link', $sharers)->orderByRaw("RAND()")->take(15)->get();
        } else {

            $websites = Links::where('client_id', '!=', Auth::user()->id)->where('status', 1)->orderByRaw("RAND()")->take(15)->get();

        }

        foreach ($websites as $website) {
            $clients = User::whereId($website->client_id)->get();
            foreach ($clients as $client) {
                if ($client->points >= $website->points) {

                    $link[] = $website;
                }
            }

        }


        if ($link === null) {
            return view('social', ['websites' => []]);

        } else {
            $share_count = DB::table('share_count')->where('start_date', '<', Carbon::now())->where('end_date', '>', Carbon::now())->where('client_id', Auth::user()->id)->get(['shared_link']);
            $count = count($share_count);

            $site_settings = DB::table('systems')->first();

            if ($count >= $site_settings->share_limit) {
                Session::flash('success_msg', 'Only ' . $site_settings->share_limit . ' Link/Links Can be Shared In a Day  ');

                return view('social', ['websites' => []]);
            } else {
                return view('social', ['websites' => $link]);

            }

        }
    }

    public function getLinks()
    {
        $websites = Links::where('client_id', Auth::user()->id)->paginate(10);
        return view('links', ['websites' => $websites]);

    }

    public function deleteLink($id)
    {
        if (env('WRITE_ACCESS') == false) {
            Session::flash('error_msg', 'Disabled In Demo');

            return redirect()->back();
        }

        Links::where('id', $id)->delete();
        Session::flash('error_msg', 'Successfully Deleted ');
        return redirect()->back();

    }


    public function process()
    {
        $link = Input::get('link');
        $link = Links::where('link', $link)->first();
        $client = User::where('id', $link->client_id)->first();


        if ($client->points > 0) {


            \DB::table('share_count')->insert(['client_id' => Auth::user()->id, 'shared_link' => $link->link, 'start_date' => Carbon::today()->startOfDay(), 'end_date' => Carbon::today()->endOfDay(),'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]);

            User::whereId(Auth::user()->id)->increment('points', $link->points);

            $client_id = $client->id;

            User::whereId($client_id)->decrement('points', $link->points);

            $count = Counts::where('created_at', '>', Carbon::today()->startOfDay())->where('created_at', '<', Carbon::today()->endOfDay())->where('client_id', Auth::user()->id)->get();


            //incrementing counts and hits for graphs

            if (sizeof($count) > 0) {
                Counts::where('created_at', '>', Carbon::today()->startOfDay())->where('created_at', '<', Carbon::today()->endOfDay())->where('client_id', Auth::user()->id)->increment('points', $link->points);

            } else {
                $count = new Counts();
                $count->client_id = Auth::user()->id;
                $count->save();
                $count = new Counts();
                $count->client_id = $client_id;
                $count->save();
                Counts::where('client_id', Auth::user()->id)->where('created_at', '>', Carbon::today()->startOfDay())->where('created_at', '<', Carbon::today()->endOfDay())->increment('points', $link->points);
            }
            Session::flash('success_msg', 'Successfully Done ');
        }


    }

    public function store()
    {
        $link = Input::get('link');
        $points = Input::get('points');

        $validator = Validator::make([
            'link' => $link
        ], [
            'link' => 'required|url|unique:links'
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withInput(Input::all())->withErrors($validator);
        }

        if ($points > Auth::user()->points || $points == 0) {
            Session::flash('error_msg', "You dont have enough points ");
            return redirect()->back();
        }

        $client_id = Auth::user()->id;

        if (Auth::user()->membership == "paid") {
            $links = new Links();
            $links->client_id = $client_id;
            $links->link = $link;
            $links->points = $points;
            $links->status = 0;
            $links->save();
            Session::flash('success_msg', 'Link Added Successfully');
            return redirect()->back();
        }
        if (Auth::user()->membership == "free") {
            $rows = Links::where('client_id', $client_id)->get();
            if (count($rows) == 3) {
                Session::flash('error_msg', "Free membership allows you to add three websites get premium for unlimited websites");
                return redirect()->back();
            } else {

                $links = new Links();
                $links->client_id = $client_id;
                $links->link = $link;
                $links->points = $points;
                $links->status = 0;
                $links->save();
                Session::flash('success_msg', 'Link Added Successfully');
                return redirect()->back();
            }
        }

    }

}
