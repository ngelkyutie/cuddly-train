<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    public function tracker()
    {
        if (!session('patient_logged_in')) {
            return redirect()->route('login');
        }

        // In a real application, you would fetch appointment data from the database
        $appointment = [
            'date' => 'April 8, 2025',
            'time' => '10:30 AM',
            'duration' => '45 minutes',
            'dentist' => 'Dr. Maria Santos',
            'room' => 'Treatment Room 3',
            'status' => 'Confirmed',
            'treatment_plan' => [
                'Flexible dentures follow-up',
                'Oral examination',
                'Adjustment if needed'
            ],
            'preparation_notes' => 'Please arrive 15 minutes early. Bring your current dentures and any concerns you\'d like to discuss with the dentist.'
        ];

        return view('appointments.tracker', compact('appointment'));
    }

    public function reschedule(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reason' => 'required|string|min:10|max:500',
            'preferred_date' => 'required|date',
            'preferred_time' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // In a real application, you would:
        // 1. Save the reschedule request to the database
        // 2. Send notification to admin/staff
        // 3. Possibly send confirmation email to patient

        // For now, we'll just return a success message
        return redirect()->route('appointments.tracker')
            ->with('success', 'Reschedule request submitted successfully! Our team will contact you to confirm the new appointment.');
    }
}