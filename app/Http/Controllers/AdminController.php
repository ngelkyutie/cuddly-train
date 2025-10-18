<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller; // Add this import

class AdminController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Simple authentication (you can replace this with proper user authentication)
        if ($credentials['username'] === 'admin' && $credentials['password'] === 'admin123') {
            // Store admin session
            session(['admin_logged_in' => true]);
            session(['admin_name' => 'Administrator']);
            
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'username' => 'Invalid credentials.',
        ])->withInput()->with('error', 'Invalid username or password.');
    }

    public function dashboard()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        return view('admin.dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'You have been logged out successfully.');
    }

    public function patients()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // Sample data - in a real application, this would come from a database
        $patients = [
            (object)[
                'id' => 1,
                'patient_number' => '25-000',
                'name' => 'Angel Cuadernal',
                'treatment' => 'Emax dental crown'
            ],
            (object)[
                'id' => 2,
                'patient_number' => '25-001',
                'name' => 'Aleci Joy Carpio',
                'treatment' => 'Flexible denture'
            ],
            (object)[
                'id' => 3,
                'patient_number' => '25-002',
                'name' => 'Josh Andrei Castillo',
                'treatment' => 'Zirconia'
            ],
            (object)[
                'id' => 4,
                'patient_number' => '25-004',
                'name' => 'John Roy Lalamacon',
                'treatment' => 'US Plastic Denture'
            ]
        ];

        return view('admin.patients', compact('patients'));
    }

    public function schedule()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // Return schedule view (to be created)
        return view('admin.schedule');
    }

    public function procedures()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // Return procedures view (to be created)
        return view('admin.procedures');
    }

    public function content()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // Return content management view (to be created)
        return view('admin.content');
    }

    public function viewPatientInfo($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // In a real application, you would:
        // 1. Fetch patient info from database
        // 2. Return the view with patient data

        return response()->json(['message' => 'View patient info for ID: ' . $id]);
    }

    public function editPatientInfo($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // In a real application, you would:
        // 1. Fetch patient info from database
        // 2. Return the edit form with patient data

        return response()->json(['message' => 'Edit patient info for ID: ' . $id]);
    }

    public function viewPatientHistory($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // In a real application, you would:
        // 1. Fetch patient history from database
        // 2. Return the view with history data

        return response()->json(['message' => 'View patient history for ID: ' . $id]);
    }

    public function editPatientHistory($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // In a real application, you would:
        // 1. Fetch patient history from database
        // 2. Return the edit form with history data

        return response()->json(['message' => 'Edit patient history for ID: ' . $id]);
    }

    public function updateProgressNotes($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // In a real application, you would:
        // 1. Fetch patient data
        // 2. Return the progress notes update form

        return response()->json(['message' => 'Update progress notes for ID: ' . $id]);
    }

    public function clearPatientFiles($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // In a real application, you would:
        // 1. Delete all files associated with the patient
        // 2. Log the action

        return redirect()->route('admin.patients')
            ->with('success', 'Patient files cleared successfully!');
    }

    public function destroyPatient($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // In a real application, you would:
        // 1. Soft delete or archive the patient record
        // 2. Remove associated files
        // 3. Log the action

        return redirect()->route('admin.patients')
            ->with('success', 'Patient removed from system successfully!');
    }
}