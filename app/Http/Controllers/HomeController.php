<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['title']="";
        $data['sub_title']="Dashboard";
        // $ip = request()->ip();//'50.90.0.1'; //Request::ip();
        // $loc = \Location::get($ip);
        // // echo"<pre>";
        // // print_r($data);die;
        // $data['lat']=$loc->latitude;
        // $data['lng']=$loc->longitude;
        $view = '';
        if(auth()->user()->hasRole('Admin')){
            $view = "admin-home";
        }else{
            $view = "user-home";
        }
        // Log::info('This is some useful information.'.auth()->user());
        return view($view, $data);
    }
}
