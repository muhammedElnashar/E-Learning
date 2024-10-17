<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Mail\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class ContactController extends Controller
{
    public function sendContactMessage()
    {
//        $validated = $request->validate([
//            'email' => 'required|email',
//            'message' => 'required',
//        ]);
        // Send an email with the user's message
//        $details = [
//            'title' => 'New Contact Message',
//            'body' => $request->message
//        ];

        Mail::raw('Hello Everyone', function(Message $message) {
            dd($message);
            $message->to('omarabuelkhier@gmail.com')
                ->subject('Hello Everyone')
                ->from('omarabuelkhier@gmail.com');
            return 'Message sent successfully';

        });
    }
}
