@extends('layouts.app')

@section('title', 'Record Attendance')

@section('content')

    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('attendances.index') }}"
           class="text-gray-400 hover:text-gray-600 transition">
            ← Back
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Record Attendance</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-2xl">
        <form action="{{ route('attendances.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 gap-6">

                {{-- Employee --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Employee <span class="text-red-500">*</span>
                    </label>
                    <select name="employee_id"
                            class="w-full border rounded-lg px-3 py-2 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500
                                   {{ $errors->has('employee_id') ? 'border-red-400' : 'border-gray-300' }}">
                        <option value="">Select employee...</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}"
                                {{ old('employee_id', request('employee_id')) == $employee->id ? 'selected' : '' }}>
                                {{ $employee->name }} — {{ $employee->department }}
                            </option>
                        @endforeach
                    </select>
                    @error('employee_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Date --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Date <span class="text-red-500">*</span>
                    </label>
                    <input type="date"
                           name="date"
                           value="{{ old('date', today()->toDateString()) }}"
                           class="w-full border rounded-lg px-3 py-2 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500
                                  {{ $errors->has('date') ? 'border-red-400' : 'border-gray-300' }}">
                    @error('date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Check In y Check Out --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Check In
                        </label>
                        <input type="time"
                               name="check_in"
                               value="{{ old('check_in') }}"
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
                               value="{{ old('check_out') }}"
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
                            {{ old('status', 'present') === 'present' ? 'selected' : '' }}>
                            Present
                        </option>
                        <option value="late"
                            {{ old('status') === 'late' ? 'selected' : '' }}>
                            Late
                        </option>
                        <option value="absent"
                            {{ old('status') === 'absent' ? 'selected' : '' }}>
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
                              placeholder="Optional observations..."
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                                     focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('notes') }}</textarea>
                </div>

            </div>

            <div class="flex gap-3 mt-8 pt-6 border-t border-gray-200">
                <button type="submit"
                        class="bg-indigo-600 text-white px-6 py-2 rounded-lg
                               text-sm font-medium hover:bg-indigo-700 transition">
                    Save Record
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