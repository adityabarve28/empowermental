<?php

namespace App\Http\Controllers;

use App\Models\FileReturns;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileReturnsController
{
    public function viewReturnForm()
    {
        return view('layouts.dashboard.counselor.returnform');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'travel_date' => 'required|date',
            'travel_location' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'screenshots.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Multiple images allowed
        ]);

        $screenshotPaths = [];
        if ($request->hasFile('screenshots')) {
            foreach ($request->file('screenshots') as $screenshot) {
                $path = $screenshot->store('uploads/returns', 'public');
                $screenshotPaths[] = $path;
            }
        }

        FileReturns::create([
            'counselor_id' => Auth::id(),
            'travel_date' => $validatedData['travel_date'],
            'travel_location' => $validatedData['travel_location'],
            'description' => $validatedData['description'],
            'screenshots' => $screenshotPaths,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Return request submitted successfully.');
    }

     // Method to fetch and display return requests
     public function viewReturnRequests()
     {
         // Fetch return requests associated with the logged-in counselor
         $returnRequests = FileReturns::where('counselor_id', Auth::id())->get();
 
         return view('layouts.dashboard.counselor.viewreturnrequests', compact('returnRequests'));
     }
}
