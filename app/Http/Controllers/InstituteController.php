<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\institutes;
use App\Models\users; // Import the User model
use Illuminate\Support\Str; // For generating remember token

class InstituteController
{
    public function store(Request $request)
    {
       echo "<pre>";
        echo print_r($request->all());

        $remember_token = Str::random(10);
        
        $users = new users();

        $users->name = $request['institute_name'];
        $users->email = $request['ins_email'];
        $users->password = bcrypt($request['ins_password']);
        $users->role = "Institute";
        $users->remember_token = $remember_token;  // Generate random token
        $users->save();

        $institutes = new institutes();

        $institute_logo = null;

        if ($request->hasFile('institute_logo')) {
            // Store the image in the 'public/uploads' directory with original name
            $originalName = $request->file('institute_logo')->getClientOriginalName(); // Get the original name
            $institute_logo = $request->file('institute_logo')->storeAs('uploads', $originalName, 'public'); // Use storeAs to save with original name
        }
        $institutes->id = $users->id;
        $institutes->institute_name = $request['institute_name'];
        $institutes->ins_email = $request['ins_email'];
        $institutes->ins_password = bcrypt($request['ins_password']);
        $institutes->ins_phone = $request['ins_phone'];
        $institutes->registration_number = $request['registration_number'];
        $institutes->ins_address = $request['ins_address'];
        $institutes->website = $request['website'];
        $institutes->ins_type = $request['ins_type'];
        $institutes->principal_name = $request['principal_name'];
        $institutes->establishment_year = $request['year_of_establishment'];
        $institutes->number_of_students = $request['number_of_students'];
        $institutes->affiliations = $request['affiliations'];
        $institutes->institute_logo = $institute_logo;
        $institutes->remember_token = $remember_token;
        $institutes->save();
        // Set a flash message and redirect
        session()->flash('success', 'Signup successful! Please log in.');
        return redirect(route('login'));
    }
}
