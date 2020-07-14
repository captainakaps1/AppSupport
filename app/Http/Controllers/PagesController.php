<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to AppSupport';
        return view('Pages.index', compact('title'));
    }

    public function about(){
        $title = 'About Us';
        return view('Pages.about',compact('title'));
    }

    public function services(){
        $data = array(
            'title' => 'Our Services',
            'services'=> ['Software Application','Graphics Design','Web Design','Networking','Programming']
        );
        return view('Pages.services')-> with($data);
    }
}
