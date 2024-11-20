<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Feedbacks;
use App\Models\Student;

class FeedbackController
{
    public function createcons()
    {
        $user = Auth::user();

        // Fetch active subscriptions where the logged-in counselor is assigned
        $institutes = DB::table('subscriptions')
            ->join('institutes', 'subscriptions.institute_id', '=', 'institutes.id')
            ->where('subscriptions.therapist_id', $user->id)
            ->where('subscriptions.status', 1) // Active subscription
            ->select('institutes.id', 'institutes.institute_name')
            ->get();

        return view('layouts.dashboard.counselor.add-feedback', compact('institutes'));
    }


    public function createins()
    {
        $user = Auth::user();

        // Fetch the active subscription for the counselor assigned to the logged-in institute
        $subscription = DB::table('subscriptions')
            ->where('institute_id', $user->id)
            ->where('status', 1) // Active subscription
            ->first();

        // Check if an active subscription and assigned counselor are found
        $counselor = null;
        if ($subscription && $subscription->therapist_id) {
            $counselor = DB::table('counselors')
                ->where('id', $subscription->therapist_id)
                ->select('id', 'full_name')
                ->first();
        }

        return view('layouts.dashboard.institute.add-feedback', compact('counselor'));
    }
    public function createstu()
    {
        // Get the logged-in user
        $user = Auth::user();

        // Check if user is authenticated and has the role of 'student'
        if (!$user || $user->role !== 'student') {
            return redirect()->route('login')->withErrors('Please login to continue.');
        }

        // Fetch the logged-in student's details
        $student = Student::where('user_id', $user->id)->first();

        // Check if student record exists
        if (!$student) {
            return redirect()->route('home')->with('error', 'Student record not found.');
        }

        $counselor = null;

        // Check if the student has an associated institute and fetch the active subscription for the institute
        if ($student && $student->institute_id) {
            $subscription = DB::table('subscriptions')
                ->where('institute_id', $student->institute_id)
                ->where('status', 1) // Active subscription
                ->select('therapist_id')
                ->first();

            // If there's an active subscription, fetch counselor details using the therapist_id
            if ($subscription && $subscription->therapist_id) {
                $counselor = DB::table('counselors')
                    ->where('id', $subscription->therapist_id)
                    ->select('id', 'full_name')
                    ->first();
            }
        }

        // Return the feedback creation view with the student and counselor data
        return view('layouts.dashboard.student.add-feedback', compact('student', 'counselor'));
    }


    public function store(Request $request)
    {
        // Validate the feedback input
        $validatedData = $request->validate([
            'feedback' => 'required|string|max:1000',
            'to_id' => 'nullable|integer', // Optional field
            'to_name' => 'nullable|string|max:255', // Validate to_name as well
        ]);
    
        // Get the logged-in user's ID and role
        $user = Auth::user();
    
        // Insert feedback into the feedback table
        Feedbacks::create([
            'user_id' => $user->id,
            'role' => $user->role,
            'feedback' => $validatedData['feedback'],
            'to_id' => $validatedData['to_id'],
            'to_name' => $validatedData['to_name'], // Directly use the validated to_name
        ]);
    
        return redirect()->back()->with('success', 'Feedback submitted successfully.');
    }
    
    public function viewFeedbackCons()
    {
        $userId = Auth::id();

        // Fetch feedback where the logged-in user (counselor) is the recipient
        $feedbacks = DB::table('feedbacks')
            ->where('to_id', $userId)
            ->leftJoin('users', 'feedbacks.user_id', '=', 'users.id')
            ->leftJoin('institutes', function ($join) {
                $join->on('feedbacks.user_id', '=', 'institutes.id')
                    ->where('feedbacks.role', '=', 'institute');
            })
            ->leftJoin('students', function ($join) {
                $join->on('feedbacks.user_id', '=', 'students.id')
                    ->where('feedbacks.role', '=', 'student');
            })
            ->select(
                'feedbacks.feedback',
                DB::raw("CASE
                    WHEN feedbacks.role = 'institute' THEN institutes.institute_name
                    WHEN feedbacks.role = 'student' THEN students.name
                    ELSE 'Unknown'
                END as from_name")
            )
            ->get();

        return view('layouts.dashboard.counselor.view-feedback', compact('feedbacks'));
    }


    public function viewFeedbackIns()
    {
        $userId = Auth::id();

        // Fetch feedback where the logged-in user is the recipient and the feedback is from a counselor
        $feedbacks = DB::table('feedbacks')
            ->where('to_id', $userId)
            ->where('users.role', 'counselor') // Only feedback from counselors
            ->leftJoin('users', 'feedbacks.user_id', '=', 'users.id')
            ->leftJoin('counselors', function ($join) {
                $join->on('feedbacks.user_id', '=', 'counselors.id')
                    ->where('feedbacks.role', '=', 'counselor');
            })
            ->select(
                'feedbacks.feedback',
                DB::raw("CASE
                    WHEN feedbacks.role = 'counselor' THEN counselors.full_name
                    ELSE 'Unknown'
                 END as from_name")
            )
            ->get();

        return view('layouts.dashboard.institute.view-feedback', compact('feedbacks'));
    }
}
