<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use Carbon\Carbon;
use Exception;

class AppointmentController
{
    public function scheduleAppointment(Request $request)
    {
        // Validate request data
        $request->validate([
            'scheduled_date' => 'required|date|after_or_equal:today',
        ]);

        $institute = Auth::user();

        // Fetch active subscription and therapist ID
        $subscription = Subscription::where('institute_id', $institute->id)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->where('status', 1) // Ensure status = 1 represents an active subscription
            ->first();

        if (!$subscription) {
            return back()->withErrors(['error' => 'No active subscription found. Please subscribe to a plan.']);
        }

        $subscriptionPlan = SubscriptionPlan::find($subscription->plan_id);
        if (!$subscriptionPlan) {
            return back()->withErrors(['error' => 'Subscription plan not found.']);
        }

        // Ensure date falls within subscription period
        $scheduledDate = Carbon::parse($request->scheduled_date);
        if ($scheduledDate < $subscription->start_date || $scheduledDate > $subscription->end_date) {
            return back()->withErrors(['error' => 'Scheduled date is out of bounds for your subscription period.']);
        }

        // Check for counselor availability on the scheduled date
        $appointmentConflict = Appointment::where('counselor_id', $subscription->therapist_id)
            ->where('appointment_date', $scheduledDate->toDateString())
            ->exists();

        if ($appointmentConflict) {
            return back()->withErrors(['error' => 'Counselor not available on the selected date. Please choose another date.']);
        }

        // Count monthly scheduled appointments for this institute
        $monthlyScheduledCount = Appointment::where('institute_id', $institute->id)
            ->whereYear('appointment_date', $scheduledDate->year)
            ->whereMonth('appointment_date', $scheduledDate->month)
            ->count();

        if ($monthlyScheduledCount >= $subscriptionPlan->sessions_approved) {
            return back()->withErrors(['error' => 'Maximum allowed appointments reached for the month.']);
        }

        try {
            // Schedule the appointment
            Appointment::create([
                'counselor_id' => $subscription->therapist_id,
                'appointment_date' => $scheduledDate->toDateString(),
                'status' => 'pending',
                'institute_id' => $institute->id,
            ]);

            return redirect()->route('institute-dashboard')
                ->with('success', 'Appointment scheduled successfully.');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Error scheduling appointment: ' . $e->getMessage()]);
        }
    }

    public function rescheduleAppointment(Request $request, $appointmentId)
{
    $request->validate([
        'scheduled_date' => 'required|date|after_or_equal:today',
    ]);

    $institute = Auth::user();

    // Fetch the appointment to be rescheduled
    $appointment = Appointment::find($appointmentId);
    if (!$appointment || $appointment->institute_id !== $institute->id) {
        return back()->withErrors(['error' => 'Appointment not found or not authorized.']);
    }

    // Check if the appointment has asked_to_reschedule set to 1, and update it to 0 if so
    if ($appointment->asked_to_reschedule === 1) {
        $appointment->asked_to_reschedule = 0;
        $appointment->save(); // Explicitly save the model
    }

    // Fetch active subscription and associated therapist ID
    $subscription = Subscription::where('institute_id', $institute->id)
        ->where('start_date', '<=', now())
        ->where('end_date', '>=', now())
        ->first();

    if (!$subscription) {
        return back()->withErrors(['error' => 'No active subscription found.']);
    }

    $subscriptionPlan = SubscriptionPlan::find($subscription->plan_id);

    // Ensure no double-booking for counselor on the new date
    $scheduledDate = Carbon::parse($request->scheduled_date);
    $appointmentConflict = Appointment::where('counselor_id', $subscription->therapist_id)
        ->where('appointment_date', $scheduledDate->toDateString())
        ->where('id', '!=', $appointmentId) // Exclude current appointment
        ->exists();

    if ($appointmentConflict) {
        return back()->withErrors(['error' => 'Counselor not available on the selected date.']);
    }

    // Convert the appointment's original date to a Carbon instance
    $originalAppointmentDate = Carbon::parse($appointment->appointment_date);

    // Monthly scheduled count check for institute
    $isSameMonth = $originalAppointmentDate->isSameMonth($scheduledDate);
    if (!$isSameMonth) {
        $monthlyScheduledCount = Appointment::where('institute_id', $institute->id)
            ->whereYear('appointment_date', $scheduledDate->year)
            ->whereMonth('appointment_date', $scheduledDate->month)
            ->count();

        if ($monthlyScheduledCount >= $subscriptionPlan->sessions_approved) {
            return back()->withErrors(['error' => 'Maximum allowed appointments reached for the month.']);
        }
    }

    try {
        $appointment->update([
            'appointment_date' => $scheduledDate->toDateString(),
            'status' => $scheduledDate->isPast() ? 'completed' : 'pending',
        ]);

        return redirect()->route('institute-dashboard')
            ->with('success', 'Appointment rescheduled successfully.');
    } catch (Exception $e) {
        return back()->withErrors(['error' => 'Error rescheduling appointment: ' . $e->getMessage()]);
    }
}

    

    public function askToReschedule($id)
    {
        try {
            // Find the appointment and set asked_to_reschedule to 1
            $appointment = Appointment::findOrFail($id);
            $appointment->asked_to_reschedule = 1;
            $appointment->save();

            // Flash success message and redirect back
            return redirect()->back()->with('success', 'Reschedule request sent successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to send reschedule request.');
        }
    }
}
