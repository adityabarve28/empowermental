<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController
{
    public function submit(Request $request)
    {
        // Validate the contact form inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'message' => 'required|string',
        ]);

        // Prepare email data
        $contactData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'message' => $request->input('message'),
        ];

        // Send the email (or alternatively, save data to the database)
        Mail::send('emails.contact', $contactData, function($message) use ($contactData) {
            $message->to('adityabarve28@gmail.com')
                    ->subject('New Contact Message from ' . $contactData['name']);
        });

        // Redirect back with success message
        return redirect()->back()->with('success', 'Your message has been sent successfully.');
    }
}
