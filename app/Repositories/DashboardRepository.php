<?php

namespace App\Repositories;


use App\Counts;
use App\Support;
use Auth;

class DashboardRepository
{

    public function index()
    {
        $counts = Counts::where('client_id', Auth::user()->id)->orderBy('id', 'desc')->limit(12)->get();

        return ['counts' => $counts];
    }

    public function support($subject, $message, $email)
    {
        $support = new Support();
        $support->subject = $subject;
        $support->message = $message;
        $support->email = $email;
        $support->save();
        return ['result' => 1];


    }
}