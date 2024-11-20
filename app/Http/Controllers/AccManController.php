<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Institutes;
use App\Models\Counselors;
use App\Models\Appointment;
use App\Models\Student;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;

class AccManController
{
    public function ViewDashboard()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Check if the user is an account manager
        if ($user && $user->is_account_manager === 1) {
            // Get the student's institute details
            $student = Student::where('user_id', $user->id)->first();
            $institute = null;
            $counselor = null;
            $currentPlan = null; // Initialize currentPlan
            
            if ($student) {
                // Retrieve the institute based on the student’s institute_id
                $institute = Institutes::find($student->institute_id);

                if ($institute) {
                    // Retrieve the latest subscription for the institute
                    $subscription = Subscription::where('institute_id', $institute->id)->latest()->first();

                    if ($subscription) {
                        // Retrieve the counselor's details using therapist_id
                        if ($subscription->therapist_id) {
                            $counselor = Counselors::find($subscription->therapist_id);
                        }

                        // Retrieve the current plan using plan_id
                        $currentPlan = SubscriptionPlan::find($subscription->plan_id);
                    }
                }
            }

            // Check if the institute exists
            if (!$institute) {
                return redirect()->route('login')->with('error', 'Institute not found for the user.');
            }

            // Get appointments for the student
            $appointments = Appointment::where('institute_id', $institute->id)
                ->with(['institute', 'counselor'])
                ->get();

            // Return the view with the necessary data
            return view('layouts.dashboard.acc-manager.acc-man-dashboard', [
                'institute' => $institute,
                'currentPlan' => $currentPlan,
                'counselor' => $counselor,
                'appointments' => $appointments,
            ]);
        } else {
            // Redirect to login with an error message if not authorized
            return redirect()->route('login')->with('error', 'Unauthorized access. Please log in as an account manager.');
        }
    }
}
