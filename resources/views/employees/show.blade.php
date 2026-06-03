@extends('layouts.app')

@section('title', $employee->name)

@section('content')

    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('employees.index') }}"
           class="text-gray-400 hover:text-gray-600 transition">
            ← Back
        </a>
        <h1 class="text-2xl font-bold text-gray-900">{{ $employee->name }}</h1>
        <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full
            {{ $employee->status === 'active'
                ? 'bg-green-100 text-green-700'
                : 'bg-red-100 text-red-700' }}">
            {{ ucfirst($employee->status) }}
        </span>
    </div>

    <div class="grid grid-cols-3 gap-6">

        {{-- Info del empleado --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-sm font-semibold text-gray-500 uppercase mb-4">
                Employee Info
            </h2>
            <dl class="space-y-3">
                <div>
                    <dt class="text-xs text-gray-400">Email</dt>
                    <dd class="text-sm text-gray-900">{{ $employee->email }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-400">Phone</dt>
                    <dd class="text-sm text-gray-900">
                        {{ $employee->phone ?? '—' }}
                    </dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-400">Department</dt>
                    <dd class="text-sm text-gray-900">{{ $employee->department }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-400">Position</dt>
                    <dd class="text-sm text-gray-900">{{ $employee->position }}</dd>
                </div>
            </dl>

            <div class="mt-6 pt-4 border-t border-gray-100">
                <a href="{{ route('employees.edit', $employee) }}"
                   class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                    Edit Employee →
                </a>
            </div>
        </div>

        {{-- Historial de asistencia --}}
        <div class="col-span-2 bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-sm font-semibold text-gray-900">Attendance History</h2>
                <a href="{{ route('attendances.create') }}?employee_id={{ $employee->id }}"
                   class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                    + Record Attendance
                </a>
            </div>

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Date
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Check In
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Check Out
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($attendances as $attendance)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-3 text-sm text-gray-900">
                                {{ $attendance->date->format('d M Y') }}
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-600">
                                {{ $attendance->check_in ?? '—' }}
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-600">
                                {{ $attendance->check_out ?? '—' }}
                            </td>
                            <td class="px-6 py-3">
                                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                                    {{ $attendance->status === 'present' ? 'bg-green-100 text-green-700' :
                                       ($attendance->status === 'late' ? 'bg-yellow-100 text-yellow-700' :
                                       'bg-red-100 text-red-700') }}">
                                    {{ ucfirst($attendance->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4"
                                class="px-6 py-8 text-center text-sm text-gray-400">
                                No attendance records yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if($attendances->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $attendances->links() }}
                </div>
            @endif

        </div>
    </div>

@endsection