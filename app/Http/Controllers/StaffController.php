<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function showLogin()
    {
        return view('staff.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required|string|in:dentist,assistant,hygienist,admin,reception',
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // In a real application, you would:
        // 1. Validate credentials against database
        // 2. Check role permissions
        // 3. Create session/token
        
        // Sample authentication logic (replace with real authentication)
        $validCredentials = [
            'dentist' => ['username' => 'drvalera', 'password' => 'dentist123'],
            'assistant' => ['username' => 'assistant1', 'password' => 'assistant123'],
            'hygienist' => ['username' => 'hygienist1', 'password' => 'hygienist123'],
            'admin' => ['username' => 'admin', 'password' => 'admin123'],
            'reception' => ['username' => 'reception1', 'password' => 'reception123'],
        ];

        $role = $request->role;
        $username = $request->username;
        $password = $request->password;

        if (isset($validCredentials[$role]) && 
            $validCredentials[$role]['username'] === $username && 
            $validCredentials[$role]['password'] === $password) {
            
            // Store staff session
            session([
                'staff_logged_in' => true,
                'staff_role' => $role,
                'staff_name' => $this->getStaffName($role, $username),
                'staff_username' => $username
            ]);

            return redirect()->route('staff.dashboard')
                ->with('success', 'Welcome back! Successfully logged in.');
        }

        return redirect()->back()
            ->withErrors(['username' => 'Invalid credentials for the selected role.'])
            ->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('staff.login')
            ->with('success', 'You have been logged out successfully.');
    }

    public function dashboard()
    {
        if (!session('staff_logged_in')) {
            return redirect()->route('staff.login');
        }

        $staffData = [
            'role' => session('staff_role'),
            'name' => session('staff_name'),
            'username' => session('staff_username')
        ];

        return view('staff.dashboard', compact('staffData'));
    }

    public function schedule()
    {
        if (!session('staff_logged_in')) {
            return redirect()->route('staff.login');
        }

        // Return staff schedule view
        return view('staff.schedule');
    }

    public function patients()
    {
        if (!session('staff_logged_in')) {
            return redirect()->route('staff.login');
        }

        // Return staff patients view
        return view('staff.patients');
    }

    private function getStaffName($role, $username)
    {
        $names = [
            'dentist' => [
                'drvalera' => 'Dr. Justin Valera'
            ],
            'assistant' => [
                'assistant1' => 'Maria Santos'
            ],
            'hygienist' => [
                'hygienist1' => 'Anna Reyes'
            ],
            'admin' => [
                'admin' => 'System Administrator'
            ],
            'reception' => [
                'reception1' => 'Sarah Johnson'
            ]
        ];

        return $names[$role][$username] ?? ucfirst($username);
    }
}