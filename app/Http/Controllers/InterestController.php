<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interest;
use App\Models\User;
use App\Models\Shortlist;
use App\Notifications\InterestReceived;
use App\Notifications\ShortlistReceived;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

class InterestController extends Controller
{
    public function sendInterest(Request $request)
    {
        $user = auth()->user();
        $toUserId = $request->profile_id;

        $limits = [
            'Free' => 5,
            'Gold' => 15,
            'Diamond' => PHP_INT_MAX,
            'Platinum' => PHP_INT_MAX
        ];

        $membership = $user->subscription?->plan->name ?? 'Free';

        $todayCount = Interest::where('sender_id', $user->user_id)
                              ->whereDate('created_at', Carbon::today())
                              ->count();

        if ($todayCount >= ($limits[$membership] ?? 5)) {
            return response()->json([
                'status' => 'limit',
                'message' => "You have reached your daily limit of {$limits[$membership]} interests."
            ]);
        }

        // Save interest
        $interest = Interest::create([
            'sender_id' => $user->user_id,
            'receiver_id' => $toUserId
        ]);

        // Send notification to the recipient user
        $receiver = User::find($toUserId);
        if ($receiver) {
            Notification::send($receiver, new InterestReceived($user));
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Interest sent successfully!'
        ]);
    }


   public function addToShortlist(Request $request)
{
    $user = auth()->user();
    $toUserId = $request->shortlisted_user_id;

    $exists = Shortlist::where('user_id', $user->user_id)
                       ->where('shortlisted_user_id', $toUserId)
                       ->exists();

    if ($exists) {
        return response()->json([
            'status' => 'exists',
            'message' => 'User is already in your shortlist.'
        ]);
    }


    Shortlist::create([
        'user_id' => $user->user_id,
        'shortlisted_user_id' => $toUserId
    ]);

    
    $toUser = User::find($toUserId);
    if ($toUser) {
        Notification::send($toUser, new ShortlistReceived($user));
    }

    return response()->json([
        'status' => 'success',
        'message' => 'User added to your shortlist.'
    ]);
}

}
