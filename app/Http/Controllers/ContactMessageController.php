<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactMessage;

class ContactMessageController extends Controller 
{
    public function getContactIndex()
    {   
        return view('frontend.other.contact');
    }

    public function postSendMessage(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'email' => 'required|email',
            'subject' => 'required|max:140',
            'message' => 'required|min:10'
        ]);

        $message = new ContactMessage();
        
        $message->sender = $request['name'];
        $message->email = $request['email'];
        $message->subject = $request['subject'];
        $message->body = $request['message'];
        $message->save();

        return redirect()->route('contact')->with(['success' => 'Message was sent successfully.']);
    }
}