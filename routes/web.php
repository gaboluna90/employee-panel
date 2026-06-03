<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;


// Página principal — redirige a empleados
Route::get('/', function () {
    return redirect()->route('employees.index');
});

// Módulo de empleados — genera 7 rutas automáticamente
Route::resource('employees', EmployeeController::class);

// Módulo de asistencia — genera 7 rutas automáticamente
Route::resource('attendances', AttendanceController::class);
