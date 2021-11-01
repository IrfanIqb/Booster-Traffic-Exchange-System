<?php namespace App\Http\Controllers;


use App\Videos;
use Auth;
use Illuminate\Support\Facades\Input;
use Validator;
use Session;
use App\User;
use App\Counts;
use Carbon;

class VideoController extends Controller
{


    public function getView()
    {
        $videos = Videos::where('client_id', '!=', Auth::user()->id)->where('status',1)->orderByRaw("RAND()")->limit(1)->first();


        if(isset($videos)) {
            $user = User::whereId($videos->client_id)->first();

            if ($user->points >= $videos->points) {
                return view('video', ['videos' => $videos]);
            }
        }

            return view('video', ['videos' => null ]);

    }

    public function getVideos()
    {
        $videos = Videos::where('client_id', Auth::user()->id)->paginate(10);
        return view('video_list', ['videos' => $videos]);

    }
    public function store()
    {
        $embed_code = Input::get('embed_code');

        $rx = '~
    ^(?:https?://)?              # Optional protocol
     (?:www\.)?                  # Optional subdomain
     (?:youtube\.com|youtu\.be)  # Mandatory domain name
     /watch\?v=([^&]+)           # URI with video id as capture group 1
     ~x';


        if (preg_match($rx, $embed_code, $matches))
        {

            $video_id = $matches[1];

            $points = Input::get('points');

            $client_id = Auth::user()->id;


            if (Auth::user()->membership == "paid") {

                $videos = new Videos();
                $videos->client_id = $client_id;
                $videos->embed_code = $video_id;
                $videos->points = $points;
                $videos->status = 0;
                $videos->save();
                Session::flash('success_msg', 'Video Added Successfully');
                return redirect()->back();
            }
            if (Auth::user()->membership == "free") {
                $rows = Videos::where('client_id', $client_id)->get();
                if (count($rows) == 3) {
                    Session::flash('error_msg', "Free membership allows you to add three websites get premium for unlimited websites");
                    return redirect()->back();
                } else {


                    $videos = new Videos();
                    $videos->client_id = $client_id;
                    $videos->embed_code = $video_id;
                    $videos->points = $points;
                    $videos->status = 0;
                    $videos->save();
                    Session::flash('success_msg', 'Video Added Successfully');
                    return redirect()->back();
                }
            }

        }
        else
        {
            Session::flash('error_msg', "Invalid URL");
            return redirect()->back();
        }

    }

    public function process()
    {
        $video_id = Input::get('video_id');
        $video = Videos::where('embed_code', $video_id)->first();
        $client = User::where('id', $video->client_id)->first();
        if ($client->points > 0) {


            User::whereId(Auth::user()->id)->increment('points', $video->points);

            $client_id = $client->id;

            User::whereId($client_id)->decrement('points', $video->points);

            $count = Counts::where('created_at', '>', Carbon::today()->startOfDay())->where('created_at', '<', Carbon::today()->endOfDay())->where('client_id', Auth::user()->id)->get();


            //incrementing counts and hits for graphs

            if (sizeof($count) > 0) {
                Counts::where('created_at', '>', Carbon::today()->startOfDay())->where('created_at', '<', Carbon::today()->endOfDay())->where('client_id', Auth::user()->id)->increment('points', $video->points);

            } else {
                $count = new Counts();
                $count->client_id = Auth::user()->id;
                $count->save();
                $count = new Counts();
                $count->client_id = $client_id;
                $count->save();
                Counts::where('client_id', Auth::user()->id)->where('created_at', '>', Carbon::today()->startOfDay())->where('created_at', '<', Carbon::today()->endOfDay())->increment('points', $video->points);
            }
        }


    }


    public function deleteVideo($id)
    {
        if(env('WRITE_ACCESS')==false)
        {
            Session::flash('error_msg', 'Disabled In Demo');

            return redirect()->back();
        }

        Videos::where('id',$id)->delete();
        Session::flash('error_msg', 'Successfully Deleted ');
        return redirect()->back();

    }




}
