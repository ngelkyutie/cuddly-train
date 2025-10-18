<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContentController extends Controller
{
    public function index()
    {
        $services = [
            (object)[
                'id' => 1,
                'name' => 'Tooth extraction',
                'price' => 500,
                'description' => 'Professional tooth extraction with minimal discomfort and proper aftercare instructions.',
                'icon' => 'fas fa-tooth'
            ],
            (object)[
                'id' => 2,
                'name' => 'Emax dental crown',
                'price' => 12000,
                'description' => 'High-quality Emax ceramic crowns for durable and natural-looking dental restorations.',
                'icon' => 'fas fa-crown'
            ],
            (object)[
                'id' => 3,
                'name' => 'Zirconia',
                'price' => 15000,
                'description' => 'Premium zirconia crowns offering exceptional strength and aesthetic appeal.',
                'icon' => 'fas fa-gem'
            ],
            (object)[
                'id' => 4,
                'name' => 'Flexible denture',
                'price' => 12000,
                'description' => 'Comfortable and durable flexible dentures that adapt to your gum structure.',
                'icon' => 'fas fa-teeth'
            ]
        ];

        $mailTypes = [
            ['key' => 'initial-confirmation', 'name' => 'Initial Confirmation'],
            ['key' => 'reminders', 'name' => 'Reminders'],
            ['key' => 'cancellation', 'name' => 'Cancellation'],
            ['key' => 'rescheduling', 'name' => 'Rescheduling'],
            ['key' => 'follow-ups', 'name' => 'Follow Ups']
        ];

        $mailTemplates = [
            'initial-confirmation' => 'JValera Dental Clinic Good Day! %first% %last%, you have a scheduled appointment on %datetime% with Dr. Justin Valera regarding your %service% treatment.',
            'reminders' => 'Reminder: Your dental appointment is scheduled for %datetime%. Please arrive 15 minutes early.',
            'cancellation' => 'Your appointment scheduled for %datetime% has been cancelled as requested.',
            'rescheduling' => 'Your appointment has been rescheduled to %datetime%.',
            'follow-ups' => 'Follow-up: How are you feeling after your %service% treatment?'
        ];

        return view('admin.content', compact('services', 'mailTypes', 'mailTemplates'));
    }

    public function announcement()
    {
        return view('announcements'); // Ensure resources/views/announcements.blade.php exists
    }

    public function updateAnnouncement(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'announcement_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('announcement_image')) {
            $request->file('announcement_image')->store('announcements', 'public');
        }

        return redirect()->route('admin.content')->with('success', 'Announcement updated successfully!');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'icon' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        return redirect()->route('admin.content')->with('success', 'Service created successfully!');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'icon' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        return redirect()->route('admin.content')->with('success', 'Service updated successfully!');
    }

    public function destroy($id)
    {
        return redirect()->route('admin.content')->with('success', 'Service deleted successfully!');
    }

    public function updateMailTemplate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'template_type' => 'required|string',
            'template_content' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        return redirect()->route('admin.content')->with('success', 'Mail template updated successfully!');
    }
}
