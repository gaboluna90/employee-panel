<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
    
        $status   = fake()->randomElement(['present', 'present', 'present', 'late', 'absent']);
        $checkIn  = null;
        $checkOut = null;

        // Si no está ausente → tiene hora de entrada
        if ($status !== 'absent') {
            $checkIn  = fake()->time('H:i', '09:30:00');
            $checkOut = fake()->time('H:i', '18:30:00');
        }

        return [
            'employee_id' => Employee::factory(),
            'date'        => fake()->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
            'check_in'    => $checkIn,
            'check_out'   => $checkOut,
            'status'      => $status,
            'notes'       => fake()->optional(0.2)->sentence(),
            // optional(0.2) → solo 20% de registros tienen notas
        ];
    }
}
