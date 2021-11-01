<?php

namespace App\Repositories;

use App\Websites;
Use Auth;
use Illuminate\Support\Str;
use Validator;
use Session;

class WebsiteRepository
{

    public function addWebsite($website)
    {
        $validator = Validator::make([
            'website' => $website
        ], [
            'website' => 'required|url|unique:websites'
        ]);


        if ($validator->fails()) {
            return ['result' => 0, 'validator' => $validator];
        }


        $client_id = Auth::user()->id;
        $short_link=$_SERVER['HTTP_HOST']."/".Str::random(6);


        if (Auth::user()->membership == "paid") {
            $websites = new Websites();
            $websites->client_id = $client_id;
            $websites->website = $website;
            $websites->short_link = $short_link;
            $websites->status = 0;
            $websites->save();
            return ['result' => 1];
        }
        if (Auth::user()->membership == "free") {
            $rows = Websites::where('client_id', $client_id)->get();
            if (count($rows) == 3) {
                return ['result' => 2];
            } else {

                $websites = new Websites();
                $websites->client_id = $client_id;
                $websites->website = $website;
                $websites->short_link = $short_link;
                $websites->status = 0;
                $websites->save();
                return ['result' => 1];
            }
        }
    }


    public function getWebsites()
    {

        $websites = Websites::where('client_id', Auth::user()->id)->paginate(5);
        return ['websites' => $websites];

    }

    public function deleteWebsite($id)

    {

        Websites::where('id', $id)->delete();
        return ['result' => 1];

    }


}