<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'department',
        'position',
        'status',
    ];

    // Un empleado tiene muchas asistencias
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    // Solo empleados activos
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
