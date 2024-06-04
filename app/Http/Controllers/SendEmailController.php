<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\CustomerEmail;

class SendEmailController extends Controller
{
    public function sendEmailToCustomer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'stt' => 'required|integer',
            'customer_email' => 'required|email',
            'email_subject' => 'required',
            'email_body' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $stt = $request->input('stt');
        $customerEmail = $request->input('customer_email');
        $emailSubject = $request->input('email_subject');
        $emailBody = $request->input('email_body');

        Mail::to($customerEmail)->send(new CustomerEmail($emailSubject, $emailBody));

        $contact = Contact::find($stt);
        if ($contact) {
            $contact->reply_status = 1;
            $contact->reply_title = $emailSubject;
            $contact->reply_content = $emailBody;
            $contact->save();
        }

        return redirect()->back()->with('success', 'Email đã được gửi thành công!');
    }
}