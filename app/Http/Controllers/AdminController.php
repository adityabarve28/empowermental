<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institute;
use App\Models\Counselors;
use App\Models\Subscription;
use App\Models\Student;
use App\Models\FileReturns;
use App\Models\FollowUp;
use App\Models\Appointment;

class AdminController
{
    public function index()
    {
        // $institutes = institutes::all()->count();
        return view('layouts.dashboard.admin.admin');
    }


    public function ViewInstitutes()
    {
        // Fetch all institutes
        $institutes = Institute::all();

        // Return the admin dashboard view and pass the institutes data
        return view('layouts.dashboard.admin.view-institutes', compact('institutes'));
    }

    public function ViewAccountManager()
    {
        // Fetch all institutes
        $accmans = student::where('is_account_manager', 1)->get();

        // Return the admin dashboard view and pass the institutes data
        return view('layouts.dashboard.admin.view-account-managers', compact('accmans'));
    }

    public function ViewCounselors()
    {
        // Fetch all institutes
        $counselors = counselors::all();

        // Return the admin dashboard view and pass the institutes data
        return view('layouts.dashboard.admin.view-counselors', compact('counselors'));
    }
    public function ViewSubscriptions()
    {
        // Fetch subscriptions with related data
        $subscriptions = Subscription::with(['institute', 'counselor', 'plan'])
            ->get();

        // Return the view with the subscriptions data
        return view('layouts.dashboard.admin.view-subscriptions', compact('subscriptions'));
    }
    public function setSubscriptionStatus(Request $request, $id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->status = $subscription->status === 1 ? 0 : 1; // Toggle the status
        $subscription->save();

        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription status updated successfully.');
    }

    public function assignCounselor($subscriptionId)
    {
        $counselors = Counselors::all(); // Fetch all counselors
        return view('layouts.dashboard.admin.assign-counselor', compact('counselors', 'subscriptionId'));
    }

    public function storeAssignedCounselor(Request $request, $subscriptionId)
    {
        $request->validate([
            'therapist_id' => 'required|exists:counselors,id', // Ensure the therapist exists
        ]);

        $subscription = Subscription::findOrFail($subscriptionId);
        $subscription->therapist_id = $request->therapist_id; // Assign the therapist
        $subscription->save();

        return redirect()->route('admin.subscriptions.index')->with('success', 'Counselor assigned successfully.');
    }
    public function ViewBillings()
    {
        $bills = FileReturns::with('counselorr')->get();
        return view('layouts.dashboard.admin.view-billings', compact('bills'));
    }

    public function updateReturnStatus(Request $request, $id)
    {
        // Validate the status input
        $request->validate([
            'status' => 'required|in:Approved,Completed,Declined',
        ]);

        // Find the record in the FileReturns model and update its status
        $returnRequest = FileReturns::findOrFail($id);
        $returnRequest->status = $request->status;
        $returnRequest->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    public function viewFollowUps()
    {
        // Fetch all follow-ups
        $followUps = FollowUp::all();

        // Return the view with follow-ups data
        return view('layouts.dashboard.admin.follow-ups.index', compact('followUps'));
    }

    public function createFollowUp()
    {
        // Return the view for adding a new follow-up
        return view('layouts.dashboard.admin.follow-ups.create');
    }

    public function storeFollowUp(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'date_of_appointment' => 'required|date',
            'role' => 'required|in:counselor,institute',
            'appointment_type' => 'required|in:Call,Meet',
        ]);

        // Create a new follow-up entry
        FollowUp::create($request->all());

        // Redirect to follow-ups index with success message
        return redirect()->route('admin.follow-ups.index')->with('success', 'Follow-up added successfully.');
    }
    public function ViewAppointments()
    {
        // Fetch appointments with related data
        $appointments = Appointment::with(['institute', 'counselorx'])->get();
    
        // Return the view with the appointments data
        return view('layouts.dashboard.admin.view-appointments', compact('appointments'));
    }
    public function ViewAddSubscriptionPlan()
{
    $plans = Subscription::all(); // Fetch all subscription plans
    return view('layouts.dashboard.admin.add-subscription-plan', compact('plans'));
}

    
}


