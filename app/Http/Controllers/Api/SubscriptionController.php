<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate(['email' => 'required|email|unique:subscriptions,email']);

        Subscription::create(['email' => $request->email]);

        Mail::raw('Thank you for subscribing Ana Kafou E-Learning Services!', function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Subscription Confirmation');
        });

        return response()->json(['message' => 'Subscribed Ana Kafou successfully!'], 201);
    }

    public function unsubscribe(Request $request)
    {
        $subscription = Subscription::where('email', $request->email)->first();

        if ($subscription) {
            $subscription->delete();
            return response()->json(['message' => 'Unsubscribed successfully!']);
        }

        return response()->json(['message' => 'Email not found!'], 404);
    }


}
