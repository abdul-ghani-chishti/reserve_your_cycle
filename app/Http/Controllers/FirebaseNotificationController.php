<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Auth;

class FirebaseNotificationController extends Controller
{
    protected $messaging;

    public function __construct(Messaging $messaging)
    {
        $this->messaging = $messaging;
    }

    // Save FCM token
    public function saveToken(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        $user = Auth::user();
        $user->fcm_token = $request->token;
        $user->save();
        Log::info('FCM token saved:', ['token' => $request->token]);
        return response()->json(['success' => true]);
    }

    // Send test push notification
    public function sendTest(Request $request)
    {
        // Initialize Firebase Messaging
        $messaging = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/' . 'reserve-cycle-firebase-adminsdk-fbsvc-ea8c94f613.json'))
            ->createMessaging();

        // Example: Send a test notification to a specific FCM token
        $fcmToken = $request->token; // make sure you send token from Postman or frontend
        $fcm_title = $request->title;
        $fcm_body = $request->body;

        $message = CloudMessage::withTarget('token', $fcmToken)
            ->withNotification([
                'title' => $fcm_title,
                'body' => $fcm_body,
            ]);

        $messaging->send($message);

        try {
            $messaging->send($message);
            return response()->json(['success' => true]);
        } catch (\Kreait\Firebase\Exception\Messaging\NotFound $e) {
            return response()->json(['error' => 'Token/project not found: ' . $e->getMessage()]);
        }
    }

    public function live_chat()
    {
        $users = User::select('id', 'name')->get();
        return view('admin.chat', compact('users'));
    }
}
