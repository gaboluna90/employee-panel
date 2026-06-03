<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'       => fake()->name(),
            'email'      => fake()->unique()->safeEmail(),
            'phone'      => fake()->phoneNumber(),
            'department' => fake()->randomElement([
                'Systems',
                'Sales',
                'Human Resources',
                'Accounting',
                'Operations',
                'Marketing',
            ]),
            'position'   => fake()->randomElement([
                'Developer',
                'Manager',
                'Analyst',
                'Designer',
                'Accountant',
                'Coordinator',
            ]),
            'status'     => fake()->randomElement(['active', 'active', 'inactive']),
            // active aparece dos veces → más probabilidad de salir activo
        ];
    }
}
