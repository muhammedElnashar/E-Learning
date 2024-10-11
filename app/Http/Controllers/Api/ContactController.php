<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class ContactController extends Controller
{
    public function sendContactMessage(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Send the email to yourself
        Mail::raw($validated['message'], function ($message) use ($validated) {
            $message->to('omarabuelkhier@example.com')
            ->from($validated['email'])
                ->subject('New Contact Form Message');
        });

        return response()->json(['message' => 'Message sent successfully']);
    }
}
