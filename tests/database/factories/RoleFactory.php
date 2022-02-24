<?php

namespace Worksome\ModelAttributes\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;
use Worksome\ModelAttributes\Tests\Models\Role;

/**
 * @extends Factory<Role>
 */
class RoleFactory extends Factory
{
    use WithFaker;

    protected $model = Role::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'role: ' . $this->faker->name,
        ];
    }
}
