@extends('layouts.app')

@section('title', 'Attendance')

@section('content')

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Attendance</h1>
            <p class="text-sm text-gray-500 mt-1">{{ $date }}</p>
        </div>
        <a href="{{ route('attendances.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg
                  text-sm font-medium hover:bg-indigo-700 transition">
            + Record Attendance
        </a>
    </div>

    {{-- Filtro por fecha --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6">
        <form method="GET" action="{{ route('attendances.index') }}"
              class="flex items-center gap-4">
            <label class="text-sm font-medium text-gray-700">Filter by date:</label>
            <input type="date"
                   name="date"
                   value="{{ $date }}"
                   class="border border-gray-300 rounded-lg px-3 py-2 text-sm
                          focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <button type="submit"
                    class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg
                           text-sm font-medium hover:bg-gray-200 transition">
                Filter
            </button>
            <a href="{{ route('attendances.index') }}"
               class="text-sm text-gray-400 hover:text-gray-600">
                Today
            </a>
        </form>
    </div>

    {{-- Tabla --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium
                               text-gray-500 uppercase tracking-wider">
                        Employee
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium
                               text-gray-500 uppercase tracking-wider">
                        Check In
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium
                               text-gray-500 uppercase tracking-wider">
                        Check Out
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium
                               text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium
                               text-gray-500 uppercase tracking-wider">
                        Notes
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-medium
                               text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($attendances as $attendance)
                    <tr class="hover:bg-gray-50 transition">

                        {{-- Empleado --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-indigo-100
                                            flex items-center justify-center
                                            text-indigo-700 font-semibold text-xs">
                                    {{ strtoupper(substr($attendance->employee->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $attendance->employee->name }}
                                    </div>
                                    <div class="text-xs text-gray-400">
                                        {{ $attendance->employee->department }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        {{-- Check In --}}
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $attendance->check_in ?? '—' }}
                        </td>

                        {{-- Check Out --}}
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $attendance->check_out ?? '—' }}
                        </td>

                        {{-- Status --}}
                        <td class="px-6 py-4">
                            <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                                {{ $attendance->status === 'present' ? 'bg-green-100 text-green-700' :
                                   ($attendance->status === 'late'    ? 'bg-yellow-100 text-yellow-700' :
                                   'bg-red-100 text-red-700') }}">
                                {{ ucfirst($attendance->status) }}
                            </span>
                        </td>

                        {{-- Notes --}}
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $attendance->notes ?? '—' }}
                        </td>

                        {{-- Acciones --}}
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('attendances.edit', $attendance) }}"
                                   class="text-sm text-gray-600 hover:text-gray-800 font-medium">
                                    Edit
                                </a>
                                <form action="{{ route('attendances.destroy', $attendance) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this record?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-sm text-red-500 hover:text-red-700 font-medium">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6"
                            class="px-6 py-12 text-center text-gray-400 text-sm">
                            No attendance records for this date.
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

@endsection