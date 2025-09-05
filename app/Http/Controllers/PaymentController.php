<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\SubscriptionPlan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function createOrder(Request $request)
    {
        $amount = $request->amount;
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $order = $api->order->create([
            'receipt' => 'order_rcptid_'.rand(1000,9999),
            'amount' => $amount,
            'currency' => 'INR'
        ]);

        return response()->json(['order_id' => $order['id']]);
    }

    public function paymentSuccess(Request $request)
{
    $request->validate([
        'razorpay_payment_id' => 'required|string',
        'razorpay_order_id' => 'required|string',
        'razorpay_signature' => 'required|string',
        'plan_id' => 'required|integer',
    ]);

    $user = auth()->user();
    $plan = \App\Models\SubscriptionPlan::where('plan_id', $request->plan_id)->firstOrFail();


    $now = Carbon::now();
    $expiresAt = $now->copy()->addDays($plan->duration_days);

    \App\Models\Payment::create([
        'user_id' => $user->user_id,
        'plan_id' => $plan->plan_id,
        'amount_paid' => $plan->price,
        'payment_method' => 'Razorpay',
        'payment_status' => 'success',
        'transaction_id' => $request->razorpay_payment_id,
        'paid_at' => $now,
        'valid_until' => $expiresAt,
    ]);

    // Update or create subscription
    \App\Models\UserSubscription::updateOrCreate(
        ['user_id' => $user->user_id],
        [
            'plan_id' => $plan->plan_id,
            'started_at' => $now,
            'expires_at' => $expiresAt,
            'is_active' => 1,
        ]
    );

    $user->update([
        'is_premium' => $plan->plan_id
    ]);

    return response()->json(['status' => 'success']);
}

}