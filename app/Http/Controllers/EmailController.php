<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class EmailController extends Controller
{
    public function testEmail()
    {
        $name = 'test name for email';
        Mail::send('emails.test', compact('name'), function($email){
            $email->to('Blinkiy.is334@gmail.com', 'Shop Blinkiy');
        });
    }
}