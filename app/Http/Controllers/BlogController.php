<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController
{
    public function showBlog()
    {
        return view('layouts.dashboard.counselor.write-a-blog');
    }

    public function store(Request $request)
    {
        // Validate blog fields and ensure content is within 750 words
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'content' => 'required|string|max:3000', // Limits to roughly 750 words
        ]);
        $subtitle = ($request->sub_title === "0" || $request->sub_title === "") ? null : $request->sub_title;

        // Create and store the blog
        Blogs::create([
            'therapist_id' => Auth::id(),
            'title' => $request->title,
            'sub_title' => $subtitle,
            'content' => $request->content,
        ]);

        // Redirect with a success message
        return redirect()->back()->with('success', 'Blog post created successfully!');
    }

    
}
