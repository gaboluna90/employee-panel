@extends('layouts.app')

@section('title', 'Edit Employee')

@section('content')

    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('employees.index') }}"
           class="text-gray-400 hover:text-gray-600 transition">
            ← Back
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Edit Employee</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-2xl">
        <form action="{{ route('employees.update', $employee) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="name"
                           value="{{ old('name', $employee->name) }}"
                           class="w-full border rounded-lg px-3 py-2 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500 uppercase
                                  {{ $errors->has('name') ? 'border-red-400' : 'border-gray-300' }}">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email"
                           name="email"
                           value="{{ old('email', $employee->email) }}"
                           class="w-full border rounded-lg px-3 py-2 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500 uppercase
                                  {{ $errors->has('email') ? 'border-red-400' : 'border-gray-300' }}">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Phone
                    </label>
                    <input type="text"
                           name="phone"
                           value="{{ old('phone', $employee->phone) }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Department <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               name="department"
                               value="{{ old('department', $employee->department) }}"
                               class="w-full border rounded-lg px-3 py-2 text-sm
                                      focus:outline-none focus:ring-2 focus:ring-indigo-500 uppercase
                                      {{ $errors->has('department') ? 'border-red-400' : 'border-gray-300' }}">
                        @error('department')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Position <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               name="position"
                               value="{{ old('position', $employee->position) }}"
                               class="w-full border rounded-lg px-3 py-2 text-sm
                                      focus:outline-none focus:ring-2 focus:ring-indigo-500 uppercase
                                      {{ $errors->has('position') ? 'border-red-400' : 'border-gray-300' }}">
                        @error('position')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="active"
                            {{ old('status', $employee->status) === 'active' ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="inactive"
                            {{ old('status', $employee->status) === 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </select>
                </div>

            </div>

            <div class="flex gap-3 mt-8 pt-6 border-t border-gray-200">
                <button type="submit"
                        class="bg-indigo-600 text-white px-6 py-2 rounded-lg
                               text-sm font-medium hover:bg-indigo-700 transition">
                    Update Employee
                </button>
                <a href="{{ route('employees.index') }}"
                   class="px-6 py-2 rounded-lg text-sm font-medium
                          text-gray-600 hover:text-gray-800 transition">
                    Cancel
                </a>
            </div>

        </form>
    </div>

@endsection