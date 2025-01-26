<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\AccountManager;
use App\Models\Institutes;
use App\Models\Counselors; // Import the Counselors model
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\users;
use App\Models\Appointment;
use Illuminate\Support\Str; // Import the Str facade
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class InstituteDashboardController
{

    private function updatePastSubscriptionsStatus()
    {
        // Get the authenticated institute
        $institute = Auth::user();

        Log::info('Updating past subscriptions for institute ID: ' . $institute->id);

        // Fetch all subscriptions for the institute that are past their end date and still active
        $pastSubscriptions = Subscription::where('institute_id', $institute->id)
            ->where('end_date', '<', Carbon::now())
            ->where('status', 1) // Only active subscriptions
            ->get();

        // Update the status of each past subscription to "inactive" (0)
        foreach ($pastSubscriptions as $subscription) {
            try {
                $subscription->status = 0; // Set the status
                $subscription->save(); // Save the changes
                Log::info('Subscription ID ' . $subscription->id . ' marked as inactive.');
                $subscription->save();
            } catch (\Exception $e) {
                Log::error('Failed to update subscription ID ' . $subscription->id . ': ' . $e->getMessage());
            }
        }

        Log::info('Past subscriptions status updated for institute ID: ' . $institute->id);
    }
    public function getMonthlyAppointments($instituteId)
    {
        return Appointment::selectRaw('YEAR(appointment_date) as year, MONTH(appointment_date) as month, COUNT(*) as count')
            ->where('institute_id', $instituteId)
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get()
            ->map(function ($item) {
                // Create a date for easier access to month names
                $date = Carbon::createFromDate($item->year, $item->month);
                return [
                    'month' => $date->format('F Y'),
                    'count' => $item->count,
                ];
            })
            ->toArray(); // Convert the result to an array
    }
    public function showDashboard()
    {
        $this->updatePastAppointmentsStatus();
        $this->updatePastSubscriptionsStatus();
        $institute = Auth::user();
        $monthlyAppointments = $this->getMonthlyAppointments($institute->id);

        Log::info('Updating past subscriptions for institute ID: ' . $institute->id);

        // Fetch all subscriptions for the institute that are past their end date and still active
        $pastSubscriptions = Subscription::where('institute_id', $institute->id)
            ->where('end_date', '<', Carbon::now())
            ->where('status', 1) // Assuming 'status' 1 means active, 0 means inactive
            ->get();

        // Fetch appointments with asked_to_reschedule = 1
        $rescheduleRequests = Appointment::where('institute_id', $institute->id)
            ->where('asked_to_reschedule', 1)
            ->get();


        // Update the status of each past subscription to "inactive" (0)
        foreach ($pastSubscriptions as $subscription) {
            try {
                $subscription->update(['status' => 0]);
                Log::info('Subscription ID ' . $subscription->id . ' marked as inactive.');
            } catch (\Exception $e) {
                Log::error('Failed to update subscription ID ' . $subscription->id . ': ' . $e->getMessage());
            }
        }

        Log::info('Past subscriptions status updated for institute ID: ' . $institute->id);
        // Get the current user's ID
        $userId = Auth::user()->id;

        // Fetch the subscription data for the current user's institute
        $subscription = Subscription::where('institute_id', $userId)
            ->where('status', 1)
            ->first();

        // Initialize variables
        $currentPlan = null;
        $accountManager = null;
        $showAccountManager = true;
        $sessionApproved = 0;
        $therapist = null;
        $discountedPrice = 0;
        $discountPercent = 0;
        $totalDays = 0;
        $startDate = null;
        $endDate = null;
        $therapistsAvailable = collect(); // Initialize as an empty collection to avoid undefined variable error
        $totalMonths = 0;
        $remainingDays = 0;
        $currentMonthKey = now()->format('F Y');
        $sessionsBooked = 0;
        // Find the current month's appointment count
        foreach ($monthlyAppointments as $monthData) {
            if ($monthData['month'] === $currentMonthKey) {
                $sessionsBooked = $monthData['count'];
            }
        }

        // Check if the subscription exists
        if ($subscription) {
            // Fetch the current plan details
            $currentPlan = SubscriptionPlan::find($subscription->plan_id);
            $startDate = $subscription->start_date;
            $endDate = $subscription->end_date;

            if ($currentPlan) {
                $sessionApproved = $currentPlan->sessions_approved;

                // Monthly price of the plan
                $monthlyPrice = $currentPlan->price;

                // For Premium Plan, fetch available therapists
                if ($currentPlan->name === 'Premium Plan') {
                    $therapistsAvailable = Counselors::all(); // Modify as needed to fetch relevant therapists
                }

                // If a therapist is assigned, fetch their details
                if ($subscription->therapist_id) {
                    $therapist = Counselors::find($subscription->therapist_id);
                }

                // Calculate total duration and apply discounts based on plan type
                if ($startDate && $endDate) {
                    $startDate = \Carbon\Carbon::parse($startDate);
                    $endDate = \Carbon\Carbon::parse($endDate);
                    $totalDays = $startDate->diffInDays($endDate);
                    $totalMonths = $startDate->diffInMonths($endDate); // Total full months
                    $remainingDays = $startDate->addMonths($totalMonths)->diffInDays($endDate); // Remaining days after full months
                    $sessionApproved =  $sessionApproved * $totalMonths;
                    // Set discount percent based on plan and duration
                    $discountPercent = 0; // Default to 0 if no discounts apply
                    // $totalMonths = $startDate->diffInMonths($endDate); // Total full months

                    // Apply discounts based on plan and duration
                    if ($currentPlan->name === 'Basic Plan' && number_format($totalMonths) >= 2) {
                        $discountPercent = 5; // 5% discount for Basic Plan
                    } elseif ($currentPlan->name === 'Standard Plan' && number_format($totalMonths) >= 3) {
                        $discountPercent = 10; // 10% discount for Standard Plan
                    } elseif ($currentPlan->name === 'Premium Plan' && number_format($totalMonths) >= 4) {
                        $discountPercent = 15; // 15% discount for Premium Plan
                    }

                    // Calculate the discounted price for the total duration
                    $totalPriceWithoutDiscount = $monthlyPrice * number_format($totalMonths);
                    $discountAmount = $totalPriceWithoutDiscount * ($discountPercent / 100);
                    $discountedPrice = $totalPriceWithoutDiscount - $discountAmount;
                }
            }
        }

        // Count the booked sessions for the logged-in institute
        $sessionsBooked = Appointment::where('institute_id', $userId)->count();

        // Fetch scheduled appointments
        $scheduledAppointments = Appointment::where('institute_id', $userId)->get();

        // Fetch the institute details
        $institute = Institutes::where('id', $userId)->first();

        // Fetch the account manager details if one exists for this institute
        $accountManager = Student::where('institute_id', $userId)->where('is_account_manager', 1)->first();

        // Example metrics
        $attendance = 90; // Example value

        // Pass data to the view
        return view('layouts.dashboard.institute.institute-dashboard', compact(
            'currentPlan',
            'accountManager',
            'showAccountManager',
            'sessionsBooked',
            'therapistsAvailable',
            'attendance',
            'subscription',
            'institute',
            'sessionApproved',
            'therapist',
            'discountedPrice',
            'discountPercent',
            'totalDays',
            'scheduledAppointments',
            'totalMonths',
            'remainingDays',
            'startDate',
            'endDate',
            'monthlyAppointments',
            'rescheduleRequests',
        ));
    }



    public function viewaccman($id)
    {
        // Get the authenticated institute
        $institute = Auth::user()->id;
    
        // Fetch the account manager by ID, ensuring it belongs to the correct institute
        $accountManager = Student::where('is_account_manager', 1)
                                  ->where('institute_id', $institute)
                                  ->where('id', $id) // Ensures we're fetching by the given ID as well
                                  ->first();
    
        // Check if the account manager exists
        if (!$accountManager) {
            return redirect()->back()->withErrors(['error' => 'Account Manager not found.']);
        }
    
        // Return the view with the account manager details
        return view('layouts.dashboard.institute.account-manager', compact('accountManager'));
    }
    
    public function showProfile()
    {
        // Get the current institute's details using the authenticated user
        $instituteId = Auth::user()->id;
        $institute = Institutes::find($instituteId);

        // Pass the institute data to the profile view
        return view('layouts.dashboard.institute.inst-profile')->with(compact('institute'));
    }

    // Function to update the profile
    public function updateProfile(Request $request)
    {
        $instituteId = Auth::user()->id; // Use the authenticated user's ID
        $institute = Institutes::find($instituteId);

        // Update the institute's details only if a new value is provided
        if ($request->filled('instituteName')) {
            $institute->institute_name = $request->input('instituteName');
        }

        if ($request->filled('instituteEmail')) {
            $institute->ins_email  = $request->input('instituteEmail');
        }

        if ($request->filled('institutePhone')) {
            $institute->ins_phone = $request->input('institutePhone');
        }

        if ($request->filled('instituteStudents')) {
            $institute->number_of_students = $request->input('instituteStudents');
        }

        if ($request->filled('instituteAddress')) {
            $institute->ins_address = $request->input('instituteAddress');
        }

        if ($request->filled('instituteWebsite')) {
            $institute->website = $request->input('instituteWebsite');
        }

        if ($request->filled('instituteHead')) {
            $institute->principal_name = $request->input('instituteHead');
        }

        if ($request->filled('instituteAffiliations')) {
            $institute->affiliations = $request->input('instituteAffiliations');
        }

        // Handle logo update if a new file is uploaded
        if ($request->hasFile('instituteLogo')) {
            $request->validate([
                'instituteLogo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust as necessary
            ]);

            // Store the uploaded logo file
            $path = $request->file('instituteLogo')->store('logos', 'public');
            $institute->institute_logo = $path;
        }

        // Save the updated data
        $institute->save();

        // Redirect back to the profile page with a success message
        return redirect()->route('view-profile')->with('success', 'Profile updated successfully.');
    }

    public function showAddStudentForm()
    {
        // Get the current user's institute ID
        $instituteId = Auth::user()->id;

        // Fetch institute details
        $institute = Institutes::find($instituteId);

        // Pass data to the 'add-student' view
        return view('layouts.dashboard.institute.add-student', compact('institute'));
    }

    public function storeStudent(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:15',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'address' => 'required|string|max:255',
            'year_of_study' => 'required|string|max:50',
        ]);

        // Get the current user's institute ID
        $instituteId = Auth::user()->id;

        // Extract the first name and the day from the date of birth
        $fullName = $request->input('name');
        $firstName = explode(' ', trim($fullName))[0]; // Get the first name
        $dobDay = \Carbon\Carbon::parse($request->input('dob'))->format('d'); // Extract the day (DD) from the date of birth

        // Generate the password in the required format: FirstName@DD
        $formattedPassword = "{$firstName}@{$dobDay}";

        DB::beginTransaction(); // Start the transaction

        try {
            // Create a new User instance
            $user = new \App\Models\User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($formattedPassword); // Hash the password before saving
            $user->role = 'student'; // Assign the 'student' role
            $user->remember_token = Str::random(10); // Generate a remember token

            // Save the user data
            $user->save();

            // Create a new Student instance and associate it with the created user
            $student = new Student();
            $student->user_id = $user->id; // Use the ID of the newly created user
            $student->name = $request->input('name');
            $student->email = $request->input('email');
            $student->password = $formattedPassword; // Store the plain-text password for the student
            $student->institute_id = $instituteId; // Assign institute ID from the logged-in user
            $student->dob = $request->input('dob');
            $student->gender = $request->input('gender');
            $student->phone = $request->input('phone');
            $student->address = $request->input('address');
            $student->year_of_study = $request->input('year_of_study');

            // Save the student data
            $student->save();

            DB::commit(); // Commit the transaction if both inserts are successful

            // Optionally: Display or send the password to the user (e.g., via email or UI)
            return redirect()->route('add-student')->with('success', 'Student added successfully. Password: ' . $formattedPassword);
        } catch (\Exception $e) {
            DB::rollBack(); // Roll back the transaction if an error occurs

            // Handle the error and display the message
            return redirect()->back()->withErrors(['error' => $e->getMessage() . ' at line: ' . $e->getLine()]);
        }
    }



    // Method to fetch students associated with the institute
    public function viewStudents()
    {
        // Assuming that the logged-in user is an institute
        $institute = Auth::user(); // Get the logged-in institute
        $students = Student::where('institute_id', $institute->id)->get(); // Fetch students related to the institute

        // Pass the students data to the view
        return view('layouts.dashboard.institute.view-student', compact('students'));
    }

    public function viewStudent($id)
    {
        // Fetch the student details by ID
        $student = Student::findOrFail($id);

        // Pass the student data to the 'view-student-details' view
        return view('layouts.dashboard.institute.view-student-details', compact('student'));
    }

    public function editStudent($id)
    {
        // Fetch the student details by ID
        $student = Student::findOrFail($id);

        // Pass the student data to the 'edit-student' view
        return view('layouts.dashboard.institute.edit-student', compact('student'));
    }

    public function updateStudent(Request $request, $id)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:15',
            'dob' => 'required|date',
            'year_of_study' => 'required|string|max:50',
        ]);

        // Find the student in the `Student` table
        $student = Student::findOrFail($id);

        // Update the student's data in the `Student` table
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->phone = $request->input('phone');
        $student->dob = $request->input('dob');
        $student->year_of_study = $request->input('year_of_study');

        // Get the institute ID associated with the student
        $instituteId = $student->institute_id;

        // Check if "Add as Account Manager" is selected
        if ($request->has('is_account_manager') && $request->input('is_account_manager') == 1) {
            $student->is_account_manager = 1;

            // Update the `is_account_manager` field in the users table
            $user = \App\Models\User::find($student->user_id);
            if ($user) {
                $user->is_account_manager = 1;
                $user->save();
            }

            // Set `is_account_manager` = 0 for all other students in the same institute
            Student::where('institute_id', $instituteId)
                ->where('id', '!=', $student->id)
                ->update(['is_account_manager' => 0]);

            // Update the users table for these students
            $otherStudents = Student::where('institute_id', $instituteId)
                ->where('id', '!=', $student->id)
                ->pluck('user_id');

            \App\Models\User::whereIn('id', $otherStudents)->update(['is_account_manager' => 0]);
        } else {
            $student->is_account_manager = 0;

            // Update the `is_account_manager` field in the users table
            $user = \App\Models\User::find($student->user_id);
            if ($user) {
                $user->is_account_manager = 0;
                $user->save();
            }
        }

        // Save the updated student data
        $student->save();

        // Redirect with a success message
        return redirect()->route('view-student')->with('success', 'Student updated successfully.');
    }



    public function deleteStudent($id)
    {
        // Find the student by ID
        $student = Student::findOrFail($id);

        // Find the corresponding user in the `users` table
        $user = \App\Models\users::find($student->user_id);

        try {
            // Delete the student record from the `Student` table
            $student->delete();

            // Delete the user record from the `users` table if it exists
            if ($user) {
                $user->delete();
            }

            // Redirect back with a success message
            return redirect()->route('view-student')->with('success', 'Student deleted successfully.');
        } catch (\Exception $e) {
            // Handle the error if any exception occurs
            return redirect()->back()->withErrors(['error' => 'Failed to delete student: ' . $e->getMessage()]);
        }
    }

    private function updatePastAppointmentsStatus()
    {
        // Get the authenticated institute
        $institute = Auth::user();

        Log::info('Updating past appointments for institute ID: ' . $institute->id);

        // Get all appointments for the institute that are past the current date and still pending
        $pastAppointments = Appointment::where('institute_id', $institute->id)
            ->where('appointment_date', '<', Carbon::now())
            ->get();

        // Update the status of each past appointment to "completed"
        foreach ($pastAppointments as $appointment) {
            $appointment->update(['status' => 'completed']);
            Log::info('Appointment ID ' . $appointment->id . ' marked as completed.');
        }

        Log::info('Past appointments status updated for institute ID: ' . $institute->id);
    }

    public function assignTherapist(Request $request)
    {
        $therapistId = $request->input('therapist_id');
        $userId = Auth::user()->id;

        // Find the subscription for the institute
        $subscription = Subscription::where('institute_id', $userId)->first();

        if ($subscription && $therapistId) {
            $subscription->therapist_id = $therapistId;
            $subscription->save();

            return redirect()->back()->with('success', 'Therapist assigned successfully.');
        }

        return redirect()->back()->with('error', 'Unable to assign therapist. Please try again.');
    }
}
