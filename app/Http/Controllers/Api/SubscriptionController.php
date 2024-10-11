<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NotificationMail;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        // Save the email to the subscribers table
        Subscriber::create([
            'email' => $validated['email'],
        ]);

        // Send notification mail
        $details = [
            'email' => $validated['email'],
            'message' => 'Thank you for subscribing to our newsletter!'
        ];

        Mail::to($validated['email'])->send(new NotificationMail($details));

        return response()->json(['message' => 'Subscription successful']);
    }
}
