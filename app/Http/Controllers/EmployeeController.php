<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $employees = Employee::latest()->paginate(10);
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     * Guarda el nuevo empleado
     * POST /employees
     */ 
    public function store(Request $request) : RedirectResponse
    {
        //
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:employees,email',
            'phone'      => 'nullable|string|max:20',
            'department' => 'required|string|max:255',
            'position'   => 'required|string|max:255',
            'status'     => 'required|in:active,inactive',
        ]);

        Employee::create($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee): View
    {
        $attendances = $employee->attendances()
            ->latest('date')
            ->paginate(10);

        return view('employees.show', compact('employee', 'attendances'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee): View
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee): RedirectResponse
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:employees,email,' . $employee->id,
            'phone'      => 'nullable|string|max:20',
            'department' => 'required|string|max:255',
            'position'   => 'required|string|max:255',
            'status'     => 'required|in:active,inactive',
        ]);

        $employee->update($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }
}
