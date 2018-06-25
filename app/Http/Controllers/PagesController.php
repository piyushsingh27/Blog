<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to Laravel!';
        return view('pages.index',compact('title'));
    }


    public function about(){
        return view('pages.about');
    }

    public function services(){
        $data = array(
            'title' => 'Services',
            'services' => ['Web Design','Programming','SEO']
        );
        return view('pages.services') -> with($data);
    }

   /* public function logout () {
        //logout user
        auth()->logout();
        // redirect to homepage
        return redirect('pages.index');
    }*/

    // public function postpage(){
    //     return view('posts.index');
    // }

   
}
