<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // Crea 15 empleados
        $employees = Employee::factory()
            ->count(15)
            ->create();

        // Genera los últimos 30 días como array
        $last30days = collect(range(0, 29))->map(function ($daysAgo) {
            return now()->subDays($daysAgo)->format('Y-m-d');
        });

        // Por cada empleado activo
        $employees->where('status', 'active')->each(function ($employee) use ($last30days) {

            // Baraja los 30 días y toma 20 al azar
            // shuffle garantiza que no se repite ninguna fecha
            $dates = $last30days->shuffle()->take(20);

            foreach ($dates as $date) {
                $status   = fake()->randomElement(['present', 'present', 'present', 'late', 'absent']);
                $checkIn  = null;
                $checkOut = null;

                if ($status !== 'absent') {
                    $checkIn  = fake()->time('H:i', '09:30:00');
                    $checkOut = fake()->time('H:i', '18:00:00');
                }

                Attendance::create([
                    'employee_id' => $employee->id,
                    'date'        => $date,
                    'check_in'    => $checkIn,
                    'check_out'   => $checkOut,
                    'status'      => $status,
                    'notes'       => fake()->optional(0.2)->sentence(),
                ]);
            }
        });
    }
}
