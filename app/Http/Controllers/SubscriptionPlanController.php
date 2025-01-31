<?php
namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;

class SubscriptionPlanController {
    // Show Add and Update Subscription Forms
    public function manage()
    {
        $plans = SubscriptionPlan::all(); // Fetch all plans
        return view('layouts.dashboard.admin.add-update-subscription')->with('plans', $plans);
    }

    // Add Subscription
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'duration' => 'required|in:once,monthly,yearly', // Ensure 'once' is allowed
            'features' => 'required|string',
            'sessions_approved' => 'required|integer',
            'discount' => 'nullable|numeric',
        ]);
    
        SubscriptionPlan::create($validatedData);
    
        return redirect()->route('admin.subscription-plans.manage')->with('success', 'Subscription Plan added successfully!');
    }
    
    // Update Subscription
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'subscription_id' => 'required|exists:subscription_plans,id',
            'update_name' => 'required|string|max:255',
            'update_price' => 'required|numeric',
            'update_duration' => 'required|in:once,monthly,yearly',
            'update_features' => 'required|string',
            'update_sessions_approved' => 'required|integer',
            'update_discount' => 'nullable|numeric',
        ]);
    
        $plan = SubscriptionPlan::findOrFail($request->subscription_id);
    
        $plan->update([
            'name' => $validatedData['update_name'],
            'price' => $validatedData['update_price'],
            'duration' => $validatedData['update_duration'],
            'features' => $validatedData['update_features'],
            'sessions_approved' => $validatedData['update_sessions_approved'],
            'discount' => $validatedData['update_discount'],
        ]);
    
        return redirect()->route('admin.subscription-plans.manage')->with('success', 'Subscription Plan updated successfully!');
    }
}

?>