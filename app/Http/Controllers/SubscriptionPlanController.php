<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;

class SubscriptionPlanController extends Controller
{
    // Get all plans
    public function index()
    {
        $plans = SubscriptionPlan::all();
        return response()->json($plans);
    }

    // Create a new plan
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'duration' => 'required|string|max:50',
            'features' => 'nullable|string',
        ]);

        $plan = SubscriptionPlan::create($request->all());
        return response()->json($plan, 201);
    }

    // Show single plan
    public function show($id)
    {
        $plan = SubscriptionPlan::findOrFail($id);
        return response()->json($plan);
    }

    // Update plan
    public function update(Request $request, $id)
    {
        $plan = SubscriptionPlan::findOrFail($id);
        $plan->update($request->all());
        return response()->json($plan);
    }

    // Delete plan
    public function destroy($id)
    {
        $plan = SubscriptionPlan::findOrFail($id);
        $plan->delete();
        return response()->json(['message' => 'Plan deleted']);
    }
}
