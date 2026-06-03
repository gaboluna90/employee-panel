<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $date = $request->date ?? today()->toDateString();

        $attendances = Attendance::with('employee')
            ->whereDate('date', $date)
            ->latest()
            ->paginate(15);

        return view('attendances.index', compact('attendances', 'date'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $employees = Employee::active()->orderBy('name')->get();

        return view('attendances.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date'        => 'required|date',
            'check_in'    => 'nullable|date_format:H:i',
            'check_out'   => 'nullable|date_format:H:i|after:check_in',
            'status'      => 'required|in:present,absent,late',
            'notes'       => 'nullable|string|max:500',
        ]);

        // Verifica que no exista asistencia para ese empleado ese día
        $exists = Attendance::where('employee_id', $validated['employee_id'])
            ->whereDate('date', $validated['date'])
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'employee_id' => 'This employee already has an attendance record for this date.'
                ]);
        }

        Attendance::create($validated);

        return redirect()
            ->route('attendances.index')
            ->with('success', 'Attendance recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance): View
    {
        return view('attendances.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance): View
    {
        $employees = Employee::active()->orderBy('name')->get();

        return view('attendances.edit', compact('attendance', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance): RedirectResponse
    {
        $validated = $request->validate([
            'check_in'  => 'nullable|date_format:H:i,H:i:s',
            'check_out' => 'nullable|date_format:H:i,H:i:s|after:check_in',
            'status'    => 'required|in:present,absent,late',
            'notes'     => 'nullable|string|max:500',
        ]);

        $attendance->update($validated);

        return redirect()
            ->route('attendances.index')
            ->with('success', 'Attendance updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance): RedirectResponse
    {
        $attendance->delete();

        return redirect()
            ->route('attendances.index')
            ->with('success', 'Attendance deleted successfully.');
    }
}
