<?php

namespace App\Http\Controllers;

use App\Models\Counselors;
use Illuminate\Http\Request;
use App\Models\Blogs;

class IndexController
{
public function showBlogs()
{
    // Fetch the 7 most recent blogs from the blogs table
    $blogs = Blogs::with('therapist')->latest()->take(8)->get();

    return view('layouts.index', compact('blogs'));
}

public function showAllBlogs()
{
    // Fetch all blogs from the blogs table
    $blogs = Blogs::with('therapist')->latest()->get();

    return view('layouts.all-blogs', compact('blogs'));
}

    public function show($id)
    {
        // Fetch the blog by ID
        $blog = Blogs::findOrFail($id);

        // Fetch therapist details using therapist_id from the blog
        $therapist = Counselors::find($blog->therapist_id);

        // Return the view with blog and therapist data
        return view('layouts.show-blog', compact('blog', 'therapist'));
    }
}
