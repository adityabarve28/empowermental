<?php

namespace App\Http\Controllers;

use App\Models\Feedbacks;
use App\Models\users;
use Illuminate\Http\Request;

class TestimonalController
{
    public function index()
    {
        // Fetch feedbacks where to_name is 'platform' or to_id is 0
        $feedbacks = Feedbacks::where('to_name', 'platform')
            ->orWhere('to_id', 0)
            ->with(['users' => function($query) {
                // Retrieve user name and role based on user_id
                $query->select('id', 'name', 'role');
            }])
            ->get();

        return view('layouts.feedbacks', compact('feedbacks'));
    }
}
