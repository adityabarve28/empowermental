<?php

namespace App\Http\Controllers;

use App\Models\Counselors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\users; // Import the User model
use Illuminate\Support\Facades\Storage;

class CounselorController
{
    public function store(Request $request)
    {
        $remember_token = Str::random(10);

        // Validate the request data
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:counselors,email',
            'license' => 'required|string|max:255',
            'password' => 'required|string|min:3|confirmed', // This line ensures password confirmation is checked
            'password_confirmation' => 'required', // Make sure the confirmation field is present in the request
            'phone' => 'required|string|max:15',
            'qualification' => 'required|string|max:255',
            'experience' => 'required|integer',
            'specialization' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'about_me' => 'nullable|string',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Store profile picture if provided
        $profilePicPath = null;
        if ($request->hasFile('profile_pic')) {
            $originalName = $request->file('profile_pic')->getClientOriginalName();
            $profilePicPath = $request->file('profile_pic')->storeAs('uploads/profile_pics', $originalName, 'public');
        }
        $password = bcrypt($validatedData['password']);
        // Create and save User instance
        $user = new users();
        $user->name = $validatedData['full_name'];
        $user->email = $validatedData['email'];
        $user->password = $password;
        $user->role = "counselor";
        $user->remember_token = $remember_token;
        $user->save();

        // Create and save Counselor instance
        $counselor = new Counselors();
        $counselor->id = $user->id;
        $counselor->full_name = $validatedData['full_name'];
        $counselor->email = $validatedData['email'];
        $counselor->license = $validatedData['license'];
        $counselor->password = $password; // Reuse hashed password
        $counselor->phone = $validatedData['phone'];
        $counselor->qualification = $validatedData['qualification'];
        $counselor->experience = $validatedData['experience'];
        $counselor->specialization = $validatedData['specialization'];
        $counselor->address = $validatedData['address'];
        $counselor->about_me = $validatedData['about_me'];
        $counselor->profile_pic = $profilePicPath;
        $counselor->remember_token = $remember_token;
        $counselor->save();

         // Set a flash message and redirect
         session()->flash('success', 'Signup successful! Please log in.');
         return redirect(route('login'));
    }
}
