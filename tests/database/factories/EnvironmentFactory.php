<?php

namespace Worksome\ModelAttributes\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;
use Worksome\ModelAttributes\Tests\Models\Environment;

/**
 * @extends Factory<Environment>
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
