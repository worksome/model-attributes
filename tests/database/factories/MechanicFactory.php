<?php

namespace Worksome\ModelAttributes\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;
use Worksome\ModelAttributes\Tests\Models\Mechanic;
use Worksome\ModelAttributes\Tests\Models\User;

/**
 * @extends Factory<User>
 */
class MechanicFactory extends Factory
{
    use WithFaker;

    protected $model = Mechanic::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
