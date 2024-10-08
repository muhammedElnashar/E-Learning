<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Payment;
use App\Models\Enrollment;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function createPaymentIntent(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $user = Auth::user();
        $course = Course::findOrFail($request->course_id);
        $amount = $course->price * 100;

        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'usd',
                'metadata' => [
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                ],
            ]);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
            ]);

        } catch (\Exception $e) {
            \Log::error('Stripe Payment Error: ' . $e->getMessage());
//            return response()->json(['error' => 'Failed to create payment intent.'], 500);
            return response()->json([$e->getMessage()]);
        }
    }
    public function storePayment(Request $request){
        $course = Course::findOrFail($request->course_id);
        if ($request->status == 'succeeded') {
            DB::beginTransaction();
            $payment = Payment::create([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'amount' => $request->amount,
            'payment_date' => now(),
        ]);
        $enrollment = Enrollment::create([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
        ]);
        DB::commit();
        return response()->json(['message' => 'Payment successful and user enrolled.'], 200);
    }else{
        return response()->json(['error' => 'Payment failed.'], 400);
    }

    }
    public function getPayments(Request $request)
    {
        $user = Auth::user();
        $payments = Payment::where('user_id', $user->id)->get();
        return response()->json(['payments' => $payments]);
    }
    public function getAllPayments(Request $request){
        $payments = Payment::all();
        return response()->json(['payments' => $payments]);
    }
}
