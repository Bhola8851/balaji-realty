<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Mail\ReplyMail;

class SendMailController extends Controller
{
    function index(){
        return view('pages.contacts');
    }
    function send(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'queryi' => 'required'
        ]);
        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'queryi' => $request->queryi,
        );

        Mail::to('balajirealtywebsite@gmail.com')->send(new SendMail($data));
        Mail::to($data['email'])->send(new ReplyMail($data));
       /* Mail::send('pages.email_page',$data,function($message){
            $message->to('balajirealtywebsite@gmail.com','Bhola Singh')->subject('bholas mail testing');
            $message->from('bholsinghbunty@gmail.com','Bhola Singh0');
        }); */
        return back()->with('success','Thanks for contacting us!');

    }
}
