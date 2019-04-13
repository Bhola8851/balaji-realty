<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class UserUpdateProfileMailToAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $request,$data;



    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request,$data)
    {
        $this->request = $request;
        $this->data = $data;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('balajirealtywebsite@gmail.com')->subject('User Profile Updated')->view('mail_pages.user_update_profile',['request_data'=>$this->request ,'data'=>$this->data]);

        //return $this->view('view.name');
        //return $this->from('bholainghbunty@gmail.com')->subject('User Profile Updated')->view('mail_pages.user_update_profile')->with('data',$this->data)->with('prev_data',$this->prev_data);
    }
}
