<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class PatientController extends Controller
{
    public function showLogin()
    {
        return view('patient.login');
    }

    public function showRegister()
    {
        return view('patient.registration');
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_number' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validPatients = [
            'PT-2023-001' => ['password' => 'patient123', 'name' => 'John Smith'],
            'PT-2023-002' => ['password' => 'patient123', 'name' => 'Maria Santos'],
            'PT-2023-003' => ['password' => 'patient123', 'name' => 'Angel Cuadernal'],
        ];

        $patientNumber = $request->patient_number;
        $password = $request->password;

        if (isset($validPatients[$patientNumber]) && $validPatients[$patientNumber]['password'] === $password) {
            session([
                'patient_logged_in' => true,
                'patient_number' => $patientNumber,
                'patient_name' => $validPatients[$patientNumber]['name']
            ]);

            return redirect()->route('appointments.tracker')
                ->with('success', 'Welcome back, ' . $validPatients[$patientNumber]['name'] . '!');
        }

        return redirect()->back()
            ->withErrors(['patient_number' => 'Invalid patient number or password.'])
            ->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'You have been logged out successfully.');
    }

    public function showLoginForm()
    {
        return view('auth.patient.login');
    }

    public function loginAdvanced(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (auth()->guard('patient')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('patient.dashboard'));
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function logoutAdvanced(Request $request)
    {
        auth()->guard('patient')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email',
            'phone' => 'required|string|max:20',
            'birthdate' => 'required|date',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $patientNumber = 'PT-' . date('Y') . '-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);

        return redirect()->route('login')
            ->with('success', 'Registration successful! Your patient number is: ' . $patientNumber . '. Please login with your credentials.');
    }

    public function storeAdvanced(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:' . now()->subYears(18)->toDateString(),
            'gender' => 'required|in:male,female,other,prefer-not-to-say',
            'email' => 'required|string|email|max:255|unique:patients,email',
            'phone' => 'required|string|max:20',
            'emergency_contact' => 'nullable|string|max:20',
            'address' => 'required|string|max:500',
            'username' => 'required|string|max:255|unique:patients,username',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'medical_history' => 'nullable|string',
            'dental_concerns' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'terms' => 'required|accepted',
        ]);

        $profileImagePath = null;
        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')->store('patient-profiles', 'public');
        }

        Patient::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'date_of_birth' => $validated['date_of_birth'],
            'gender' => $validated['gender'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'emergency_contact' => $validated['emergency_contact'] ?? null,
            'address' => $validated['address'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'medical_history' => $validated['medical_history'] ?? null,
            'dental_concerns' => $validated['dental_concerns'] ?? null,
            'profile_image' => $profileImagePath,
        ]);

        return redirect()->route('login')
            ->with('success', 'Patient registered successfully! Your username is: ' . $validated['username']);
    }

    public function dashboard()
    {
        $patient = auth()->guard('patient')->user();
        return view('patient.dashboard', compact('patient'));
    }

    public function records()
    {
        if (!session('patient_logged_in')) {
            return redirect()->route('login');
        }

        $records = [
            (object)['id' => 1, 'form_name' => 'Patient Record & Chart', 'date' => \Carbon\Carbon::create(2025, 2, 5)],
            (object)['id' => 2, 'form_name' => 'Progress Notes (Month 1)', 'date' => \Carbon\Carbon::create(2025, 3, 6)],
            (object)['id' => 3, 'form_name' => 'Post-op Extraction Surgery', 'date' => \Carbon\Carbon::create(2025, 3, 10)],
            (object)['id' => 4, 'form_name' => 'Progress Notes (Month 2)', 'date' => \Carbon\Carbon::create(2025, 4, 6)],
        ];

        $patient = [
            'name' => session('patient_name'),
            'birthdate' => '1985-05-15',
            'phone' => '+63 912 345 6789',
            'address' => '123 Main St, Manila, Philippines'
        ];

        $medicalConditions = [
            ['id' => 'surgical-procedure', 'name' => 'Surgical procedure'],
            ['id' => 'oral-infection', 'name' => 'Oral infection'],
            ['id' => 'coronary-disease', 'name' => 'Presence of coronary artery disease'],
            ['id' => 'chronic-condition', 'name' => 'Chronic medical condition'],
            ['id' => 'periodontal-disease', 'name' => 'Periodontal disease'],
            ['id' => 'other-reason', 'name' => 'Other']
        ];

        $medicalHistory = [
            ['id' => 'coronary-history', 'name' => 'Coronary artery disease'],
            ['id' => 'liver-disease', 'name' => 'Liver disease'],
            ['id' => 'hypertension', 'name' => 'Hypertension'],
            ['id' => 'respiratory-disease', 'name' => 'Respiratory disease'],
            ['id' => 'diabetes', 'name' => 'Diabetes mellitus'],
            ['id' => 'immunosuppression', 'name' => 'Immunosuppression'],
            ['id' => 'kidney-disease', 'name' => 'Kidney disease'],
            ['id' => 'other-condition', 'name' => 'Other']
        ];

        return view('patient.records', compact('records', 'patient', 'medicalConditions', 'medicalHistory'));
    }

    public function viewRecord($id)
    {
        if (!session('patient_logged_in')) {
            return redirect()->route('login');
        }
        return response()->json(['message' => 'Record viewed successfully']);
    }

    public function downloadRecord($id)
    {
        if (!session('patient_logged_in')) {
            return redirect()->route('login');
        }
        return response()->json(['message' => 'Record download initiated']);
    }

    public function storeMedicalClearance(Request $request)
    {
        if (!session('patient_logged_in')) {
            return redirect()->route('login');
        }

        $validator = Validator::make($request->all(), [
            'patient_grade' => 'required|string|max:255',
            'medical_conditions' => 'required|array|min:1',
            'medical_conditions.*' => 'string',
            'medical_conditions_desc' => 'required|string|min:10',
            'medical_history' => 'nullable|array',
            'medical_history.*' => 'string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        return redirect()->route('patient.records')
            ->with('success', 'Medical clearance form submitted successfully!');
    }

    public function index()
    {
        $patients = Patient::latest()->paginate(10);
        return view('admin.patients', compact('patients'));
    }

    public function create()
    {
        return view('patient.registration');
    }

    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'first_name'=>'required|string|max:255',
            'last_name'=>'required|string|max:255',
            'date_of_birth'=>'required|date|before:' . now()->subYears(18)->toDateString(),
            'gender'=>'required|in:male,female,other,prefer-not-to-say',
            'email'=>'required|string|email|max:255|unique:patients,email,'.$patient->id,
            'phone'=>'required|string|max:20',
            'emergency_contact'=>'nullable|string|max:20',
            'address'=>'required|string|max:500',
            'username'=>'required|string|unique:patients,username,'.$patient->id,
            'password'=>'nullable|confirmed|min:8',
            'medical_history'=>'nullable|string',
            'dental_concerns'=>'nullable|string',
            'profile_image'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $updateData = $validated;
        if ($request->filled('password')) $updateData['password'] = Hash::make($validated['password']);
        if ($request->hasFile('profile_image')) {
            if($patient->profile_image) Storage::disk('public')->delete($patient->profile_image);
            $updateData['profile_image'] = $request->file('profile_image')->store('patient-profiles','public');
        }

        $patient->update($updateData);
        return redirect()->route('patients.show',$patient)->with('success','Patient information updated successfully!');
    }

    public function destroy(Patient $patient)
    {
        if($patient->profile_image) Storage::disk('public')->delete($patient->profile_image);
        $patient->delete();
        return redirect()->route('patients.index')->with('success','Patient account deleted successfully!');
    }
}
