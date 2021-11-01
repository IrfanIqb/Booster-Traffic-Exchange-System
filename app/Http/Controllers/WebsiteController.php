<?php namespace App\Http\Controllers;

use App\Repositories\WebsiteRepository;
use App\Websites;
use Illuminate\Http\Request;
use Input;
use Session;


class WebsiteController extends Controller
{
    public $websiteRepository;

    public function __construct(WebsiteRepository $websiteRepository)
    {
        $this->websiteRepository = $websiteRepository;
    }

    public function getWebsites()
    {
        $response = $this->websiteRepository->getWebsites();
        $websites=$response['websites'];
        return view('websites', ['websites' => $websites]);
    }

    public function addWebsite(Request $request)
    {
        $response = $this->websiteRepository->addWebsite($request->website);

        if ($response['result'] == 0) {
            return redirect()->back()->withInput($request->all())->withErrors($response['validator']);

        }

        if ($response['result'] == 1) {

            Session::flash('success_msg', 'Website Added Successfully');

            return redirect()->back();
    }

        if ($response['result'] == 2) {
            Session::flash('error_msg', "Free membership allows you to add three websites get premium for unlimited websites");
            return redirect()->back();
        }




    }

    public function deleteWebsite($id)
    {
        if(env('WRITE_ACCESS')==false)
        {
            Session::flash('error_msg', 'Disabled In Demo');

            return redirect()->back();
        }

        $response = $this->websiteRepository->deleteWebsite($id);
        if ($response['result'] == 1) {

            Session::flash('error_msg', 'Website Deleted Successfully');

            return redirect()->back();
        }
    }

    public function websiteStatus($id)
    {
        $website=Websites::where('id',$id)->first();
        if($website->status == 0)
        {
            Websites::where('id',$id)->update(['status' => 1]);
            return redirect()->back();

        }
        else
        {
            Websites::where('id',$id)->update(['status' => 0]);
            return redirect()->back();
        }


    }

    public function getShortLinks()
    {

        $websites=Websites::where('client_id',\Auth::user()->id)->where('status',1)->get();


        return view('short_links')->with(['websites'=>$websites]);


    }



}
