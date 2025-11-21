<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailNotificationController extends Controller
{
    public function email()
    {
     return view('user.email_notification.email_notification');
    }

    public function email_send(Request $request)
    {
        dd($request->all());
    }
}
