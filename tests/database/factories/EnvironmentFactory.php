<?php

namespace Worksome\ModelAttributes\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;
use Worksome\ModelAttributes\Tests\Models\Car;
use Worksome\ModelAttributes\Tests\Models\Environment;
use Worksome\ModelAttributes\Tests\Models\Mechanic;
use Worksome\ModelAttributes\Tests\Models\Project;
use Worksome\ModelAttributes\Tests\Models\User;

/**
 * @extends Factory<User>
 */
class EnvironmentFactory extends Factory
{
    use WithFaker;

    protected $model = Environment::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Environment 1',
                'Environment 2',
                'Environment 3',
                'Environment 4',
                'Environment 5',
                'Environment 6',
            ]),
        ];
    }
}
