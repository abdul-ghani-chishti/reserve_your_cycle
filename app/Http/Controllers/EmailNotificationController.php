<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailNotificationController extends Controller
{
    public function email()
    {
     return view('user.email_notification.email_notification');
    }

    public function email_send(Request $request)
    {
//        dd($request->all());
        $content = $request->email_message;
        Mail::raw($content, function ($message) use ($request) {
            $message->to($request->email_user)
                ->subject($request->email_subject);
        });
        return back()->with('success', 'Email sent successfully!');
    }
}
