@extends('layouts.app')

@section('title', 'Employees')

@section('content')

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Employees</h1>
            <p class="text-sm text-gray-500 mt-1">
                {{ $employees->total() }} employees registered
            </p>
        </div>
        <a href="{{ route('employees.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg 
                  text-sm font-medium hover:bg-indigo-700 transition">
            + New Employee
        </a>
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
                        Department
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium 
                               text-gray-500 uppercase tracking-wider">
                        Position
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium 
                               text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-medium 
                               text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($employees as $employee)
                    <tr class="hover:bg-gray-50 transition">

                        {{-- Nombre y email --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-indigo-100 
                                            flex items-center justify-center 
                                            text-indigo-700 font-semibold text-sm">
                                    {{ strtoupper(substr($employee->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $employee->name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $employee->email }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        {{-- Departamento --}}
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $employee->department }}
                        </td>

                        {{-- Cargo --}}
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $employee->position }}
                        </td>

                        {{-- Status badge --}}
                        <td class="px-6 py-4">
                            <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                                {{ $employee->status === 'active' 
                                    ? 'bg-green-100 text-green-700' 
                                    : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($employee->status) }}
                            </span>
                        </td>

                        {{-- Acciones --}}
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('employees.show', $employee) }}"
                                   class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                                    View
                                </a>
                                <a href="{{ route('employees.edit', $employee) }}"
                                   class="text-sm text-gray-600 hover:text-gray-800 font-medium">
                                    Edit
                                </a>
                                <form action="{{ route('employees.destroy', $employee) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this employee?')">
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
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400 text-sm">
                            No employees registered yet.
                            <a href="{{ route('employees.create') }}" 
                               class="text-indigo-600 hover:underline ml-1">
                                Create the first one
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Paginación --}}
        @if($employees->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $employees->links() }}
            </div>
        @endif

    </div>

@endsection