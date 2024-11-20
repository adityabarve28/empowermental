<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Counselors;
use App\Models\Institutes;
use App\Models\Student;

class StudentController
{
    public function viewStuDash()
    {
        // Get the logged-in user
        $user = Auth::user();

        // Check if user is authenticated and has the role of 'student'
        if (!$user || $user->role !== 'student') {
            return redirect()->route('login')->withErrors('Please login to continue.');
        }

        // Fetch student details
        $student = Student::where('user_id', $user->id)->first();

        // Initialize variables for the view
        $institute = null;
        $therapists = [];

        // If student record is found, proceed to fetch related data
        if ($student) {
            // Fetch the institute of the student using institute_id
            $institute = Institutes::find($student->institute_id);

            // Check if the institute exists
            if (!$institute) {
                return view('layouts.dashboard.student.stu-dashboard', [
                    'student' => $student,
                    'institute' => null,
                    'therapists' => [],
                    'error' => 'Institute not found.'
                ]);
            }

            // Fetch therapists assigned to the institute via subscriptions
            $therapists = Counselors::whereHas('subscriptions', function ($query) use ($institute) {
                $query->where('institute_id', $institute->id);
            })->get();

            // Log the retrieved data for debugging
            Log::info('Student Data:', [
                'student' => $student,
                'institute' => $institute,
                'therapists' => $therapists
            ]);
        } else {
            // If no student record is found, you can either set error message
            return view('layouts.dashboard.student.stu-dashboard', [
                'student' => null,
                'institute' => null,
                'therapists' => [],
                'error' => 'Student record not found.'
            ]);
        }

        // Return the view with the retrieved data
        return view('layouts.dashboard.student.stu-dashboard', compact('student', 'institute', 'therapists'));
    }
}
