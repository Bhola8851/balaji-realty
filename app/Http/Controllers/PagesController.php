<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
     //index method
     public function index(){
        /*
            $title = 'Welcome'
            return view('pages.index',compact('title'))
            return view('pages.index')->with('title',$title);
        */
        return view('pages/index');
    }

    //contacts method
    public function contacts(){
        return view('pages.contacts');
    }

    //about_us method
    public function about_us(){
        return view('pages.about_us');
    }
}
