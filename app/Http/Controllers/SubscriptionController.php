<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SubscriptionPlan;
use App\Models\Subscription;

class SubscriptionController
{
    public function showPlans()
    {
        $plans = SubscriptionPlan::all();
        return view('layouts.subscriptionplans')->with(compact('plans'));
    }
    /**
     * Process the subscription payment.
     */
    public function processPayment(Request $request)
    {
        // Validate input data
        $validated = $request->validate([
            'plan_id' => 'required|exists:subscription_plans,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'total_price' => 'required|numeric', // Add numeric validation for total_price
        ]);

        // Retrieve the plan and calculate the total price
        $plan = SubscriptionPlan::find($validated['plan_id']);
        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);
        $totalPrice = $validated['total_price']; // This will throw an error if not set
        // Calculate the number of months in the subscription period
        // $months = $endDate->diffInMonths($startDate) + 1;

        // Here you would add code for payment integration
        // For demonstration, we assume the payment is successful

        try {
            Subscription::create([
                'plan_id' => $plan->id,
                'institute_id' => Auth::id(),
                'start_date' => $startDate,
                'end_date' => $endDate,
                'amount' => $totalPrice,
                'status' => 1, // Assuming 1 is 'active'
            ]);
            return redirect()->route('institute-dashboard')->with('success', 'Subscription purchased successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to create subscription: ' . $e->getMessage()]);
        }
    }
    public function buySubscription($planId)
    {
        // Retrieve the subscription plan based on the provided ID
        $plan = SubscriptionPlan::findOrFail($planId);  // Assuming you have a Plan model

        // Pass the plan details to the 'buy-subscription' view
        return view('layouts.buy-subscription', compact('plan'));
    }
}
