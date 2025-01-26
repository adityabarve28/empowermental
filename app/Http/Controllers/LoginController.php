<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\users; // Import the User model
use App\Models\Student; // Import the User model
use App\Models\institutes;
use App\Models\Counselors;

class LoginController
{
    public function showLoginForm()
    {
        // Show the login form
        return view('layouts.login'); // Assuming you have a login view
    }

    public function login(Request $request)
    {
        // Validate the login form input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $role = $user->role;

            // Redirect based on the user's role
            if ($role === 'institute') {
                return redirect()->route('institute-dashboard');
            } elseif ($role === 'student') {
                return redirect()->route('stu-dashboard'); // Ensure this points to StudentController
            } elseif ($role === 'counselor') {
                return redirect()->route('counselor-dashboard');
            } else {
                Auth::logout();
                return redirect()->route('login')->withErrors('Invalid role. Please contact support.');
            }
        }

        return redirect()->route('login')->withErrors('Error logging in. Please check your credentials.');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }

    // Show the password reset form
    public function showResetForm()
    {
        return view('layouts.reset-password'); // Assuming you have a reset password view
    }

    // Handle the password reset form submission
    // Handle the password reset form submission
    public function resetPassword(Request $request)
    {
        // Validate the form input
        $request->validate([
            'email' => 'required|email',
            'new_password' => 'required|min:8|confirmed', // 'confirmed' requires a matching 'new_password_confirmation' field
        ]);

        $email = $request->input('email');
        $newPassword = Hash::make($request->input('new_password'));

        try {
            // Find the user by email in the users table and update password
            $user = users::where('email', $email)->first();

            if ($user) {
                $user->password = $newPassword;
                $user->save();

                // Check the role and update password in the corresponding table
                switch ($user->role) {
                    case 'student':
                        $student = Student::where('email', $email)->first();
                        if ($student) {
                            $student->password = $newPassword;
                            $student->save();
                        }
                        break;

                    case 'institute':
                        $institute = Institutes::where('ins_email', $email)->first();
                        if ($institute) {
                            $institute->ins_password = $newPassword;
                            $institute->save();
                        }
                        break;

                    case 'counselor':
                        $counselor = Counselors::where('email', $email)->first();
                        if ($counselor) {
                            $counselor->password = $newPassword;
                            $counselor->save();
                        }
                        break;

                    default:
                        // Optional: handle cases where the role is unrecognized
                        break;
                }
            }

            // Redirect to the login page with a success message
            return redirect()->route('login')->with('success', 'Password updated successfully. You can now log in with your new password.');
        } catch (\Exception $e) {
            // Redirect back with an error message if something goes wrong
            return redirect()->back()->withErrors(['An error occurred: ' . $e->getMessage()]);
        }
    }

    public function showLogin()
    {
        // Show the login form
        return view('layouts.dashboard.admin.login'); // Assuming you have a login view
    }
}
