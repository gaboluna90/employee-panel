<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Employee Panel')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                {{-- Logo --}}
                <a href="{{ route('employees.index') }}"
                   class="text-xl font-bold text-indigo-600">
                    Employee Panel
                </a>

                {{-- Links --}}
                <div class="flex gap-6">
                    <a href="{{ route('employees.index') }}"
                       class="text-sm font-medium 
                       {{ request()->routeIs('employees.*') 
                           ? 'text-indigo-600 border-b-2 border-indigo-600' 
                           : 'text-gray-500 hover:text-gray-700' }}">
                        Employees
                    </a>
                    <a href="{{ route('attendances.index') }}"
                       class="text-sm font-medium
                       {{ request()->routeIs('attendances.*') 
                           ? 'text-indigo-600 border-b-2 border-indigo-600' 
                           : 'text-gray-500 hover:text-gray-700' }}">
                        Attendance
                    </a>
                </div>

            </div>
        </div>
    </nav>

    {{-- Mensajes de éxito --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-50 border border-green-200 text-green-800 
                        px-4 py-3 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        </div>
    @endif

    {{-- Contenido de cada vista --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

</body>
</html>