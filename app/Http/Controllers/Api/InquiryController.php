<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    public function sendInquiry(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required|min:10',
        ]);
        Inquiry::create($request->only('email', 'message'));


        Mail::raw($request->message, function ($message) use ($request) {
            $message->to('omarabuelkhier@gmail.com')
            ->subject('New Inquiry from ' . $request->email);
        });

        return response()->json(['message' => 'Your message has been sent successfully!'], 200);
    }

}
