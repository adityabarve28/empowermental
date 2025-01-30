<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Institute;
use App\Models\Subscription;
use App\Models\Student;
use App\Models\Counselors;
use Illuminate\Support\Facades\Storage;

class CounselorDashboardController
{
    public function showDashboard()
    {
        $counselor = Auth::user();
    
        // Fetch all the pending appointments for the counselor
        $appointments = Appointment::where('counselor_id', $counselor->id)
            ->where('status', 'pending')
            ->get();
    
        // Fetch subscriptions related to the therapist (counselor)
        $subscriptions = Subscription::where('therapist_id', $counselor->id)
            ->with(['institute'])
            ->get();
    
        // Extract unique Institute associated with the therapist
        $institutes = $subscriptions->pluck('institute')->filter()->unique('id')->values();
    
        // Fetch account managers (coordinators) for each institute
        $accountManagers = Student::where('is_account_manager', 1)
            ->whereIn('institute_id', $institutes->pluck('id'))
            ->get()
            ->keyBy('institute_id');
    
        // Set each appointment's institute, coordinator, and plan details
        $appointments->each(function ($appointment) use ($accountManagers) {
            $appointment->institute = Institute::find($appointment->institute_id);
            $appointment->coordinator = $accountManagers->get($appointment->institute_id);
            $appointment->plan = Subscription::where('plan_id', 1)
                ->where('institute_id', $appointment->institute_id)
                ->first();
        });
    
        return view('layouts.dashboard.counselor.counselor-dashboard', compact(
            'counselor',
            'appointments',
            'institutes',
            'accountManagers'
        ));
    }

    // Show counselor profile
    public function showProfile()
    {
        $counselor = Auth::user();
        $details = Counselors::where('id', $counselor->id)->first();

        return view('layouts.dashboard.counselor.counselor-profile', compact('counselor', 'details'));
    }

    // Update counselor profile
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $counselor = Counselors::where('id', $user->id)->first();
    
        // Validate the request data
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:counselors,email,' . $user->id,
            'license' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'qualification' => 'required|string|max:255',
            'experience' => 'required|integer',
            'specialization' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'about_me' => 'nullable|string',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        // Update profile picture if provided
        if ($request->hasFile('profile_pic')) {
            // Delete the old profile picture if it exists
            if ($counselor->profile_pic) {
                Storage::delete('public/' . $counselor->profile_pic);
            }
            $profilePicPath = $request->file('profile_pic')->store('uploads/profile_pics', 'public');
            $counselor->profile_pic = $profilePicPath;
        }
    
        // Update counselor details
        $counselor->full_name = $validatedData['full_name'];
        $counselor->email = $validatedData['email'];
        $counselor->license = $validatedData['license'];
        $counselor->phone = $validatedData['phone'];
        $counselor->qualification = $validatedData['qualification'];
        $counselor->experience = $validatedData['experience'];
        $counselor->specialization = $validatedData['specialization'];
        $counselor->address = $validatedData['address'];
        $counselor->about_me = $validatedData['about_me'];
    
        $counselor->save();
    
        // Update user details in the users table
        $user->name = $validatedData['full_name'];
        $user->email = $validatedData['email'];
        $user->save();
    
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
