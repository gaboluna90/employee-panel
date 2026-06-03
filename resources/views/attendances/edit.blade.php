@extends('layouts.app')

@section('title', 'Edit Attendance')

@section('content')

    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('attendances.index') }}"
           class="text-gray-400 hover:text-gray-600 transition">
            ← Back
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Edit Attendance</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-2xl">
        <form action="{{ route('attendances.update', $attendance) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6">

                {{-- Empleado (solo lectura) --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Employee
                    </label>
                    <div class="w-full border border-gray-200 bg-gray-50 rounded-lg
                                px-3 py-2 text-sm text-gray-600">
                        {{ $attendance->employee->name }}
                        — {{ $attendance->employee->department }}
                    </div>
                </div>

                {{-- Fecha (solo lectura) --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Date
                    </label>
                    <div class="w-full border border-gray-200 bg-gray-50 rounded-lg
                                px-3 py-2 text-sm text-gray-600">
                        {{ $attendance->date->format('d M Y') }}
                    </div>
                </div>

                {{-- Check In y Check Out --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Check In
                        </label>
                        <input type="time"
                               name="check_in"
                               value="{{ old('check_in', $attendance->check_in) }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                                      focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('check_in')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Check Out
                        </label>
                        <input type="time"
                               name="check_out"
                               value="{{ old('check_out', $attendance->check_out) }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                                      focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('check_out')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="present"
                            {{ old('status', $attendance->status) === 'present' ? 'selected' : '' }}>
                            Present
                        </option>
                        <option value="late"
                            {{ old('status', $attendance->status) === 'late' ? 'selected' : '' }}>
                            Late
                        </option>
                        <option value="absent"
                            {{ old('status', $attendance->status) === 'absent' ? 'selected' : '' }}>
                            Absent
                        </option>
                    </select>
                </div>

                {{-- Notes --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Notes
                    </label>
                    <textarea name="notes"
                              rows="3"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                                     focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('notes', $attendance->notes) }}</textarea>
                </div>

            </div>

            <div class="flex gap-3 mt-8 pt-6 border-t border-gray-200">
                <button type="submit"
                        class="bg-indigo-600 text-white px-6 py-2 rounded-lg
                               text-sm font-medium hover:bg-indigo-700 transition">
                    Update Record
                </button>
                <a href="{{ route('attendances.index') }}"
                   class="px-6 py-2 rounded-lg text-sm font-medium
                          text-gray-600 hover:text-gray-800 transition">
                    Cancel
                </a>
            </div>

        </form>
    </div>

@endsection