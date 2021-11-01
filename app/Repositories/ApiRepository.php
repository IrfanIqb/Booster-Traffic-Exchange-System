<?php

namespace App\Repositories;

use App\Counts;
use App\User;
use App\Websites;
Use Auth;
use Carbon\Carbon;


class ApiRepository
{

    public function session()

    {
        $website=Websites::where('client_id','!=' ,Auth::user()->id)->where('status',1)->orderByRaw("RAND()")->first();

        $client=User::where('id',$website->client_id)->first();

        $client_id = $client->id;

        if( $client->points > 0)
        {
            return ['website' => $website,'client_id'=>$client_id];
        }
        else{
            return $this->session();
        }
    }


    public function increment($client_id)
    {
        $client=User::whereId($client_id)->first();

        if($client->points >0) {


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
        }
    }



}