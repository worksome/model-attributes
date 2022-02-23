<?php

namespace Worksome\ModelAttributes\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;
use Worksome\ModelAttributes\Tests\Models\Car;

/**
 * @extends Factory<Car>
 */
class CarFactory extends Factory
{
    use WithFaker;

    protected $model = Car::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'model' => $this->faker->randomElement([
                'Audi', 'BMW', 'Volvo', 'Saab', 'Renault',
            ]),
        ];
    }
}
