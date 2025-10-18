<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostProcedureFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // Sample data - in a real application, this would come from a database
        $procedures = [
            (object)[
                'id' => 1,
                'patient_name' => 'Angel Cuadernal',
                'procedure_type' => 'Emax dental crown',
                'date' => '2025-02-05',
                'status' => 'completed'
            ],
            (object)[
                'id' => 2,
                'patient_name' => 'Aleci Joy Carpio',
                'procedure_type' => 'Flexible denture',
                'date' => '2025-02-10',
                'status' => 'pending'
            ],
            (object)[
                'id' => 3,
                'patient_name' => 'Josh Andrei Castillo',
                'procedure_type' => 'Zirconia',
                'date' => '2025-02-15',
                'status' => 'in-progress'
            ]
        ];

        return view('admin.procedures', compact('procedures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        return view('admin.post-procedure.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // Validate and store the post-procedure form
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'procedure_type' => 'required|string|max:255',
            'procedure_date' => 'required|date',
            'notes' => 'nullable|string',
            'follow_up_date' => 'nullable|date',
            'status' => 'required|in:completed,in-progress,pending',
        ]);

        // In a real application, you would store this in the database
        // PostProcedureForm::create($validated);

        return redirect()->route('admin.procedures.list')
            ->with('success', 'Post-procedure form created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // In a real application, fetch the procedure from database
        return response()->json(['message' => 'Show post-procedure form: ' . $id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // In a real application, fetch the procedure from database
        return view('admin.post-procedure.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // Validate and update the post-procedure form
        $validated = $request->validate([
            'procedure_type' => 'required|string|max:255',
            'procedure_date' => 'required|date',
            'notes' => 'nullable|string',
            'follow_up_date' => 'nullable|date',
            'status' => 'required|in:completed,in-progress,pending',
        ]);

        // In a real application, update the record in database
        // $procedure = PostProcedureForm::findOrFail($id);
        // $procedure->update($validated);

        return redirect()->route('admin.procedures.list')
            ->with('success', 'Post-procedure form updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // In a real application, delete the record from database
        // PostProcedureForm::destroy($id);

        return redirect()->route('admin.procedures.list')
            ->with('success', 'Post-procedure form deleted successfully!');
    }
}