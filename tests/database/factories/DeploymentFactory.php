<?php

namespace Worksome\ModelAttributes\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;
use Worksome\ModelAttributes\Tests\Models\Car;
use Worksome\ModelAttributes\Tests\Models\Deployment;
use Worksome\ModelAttributes\Tests\Models\Mechanic;
use Worksome\ModelAttributes\Tests\Models\Project;
use Worksome\ModelAttributes\Tests\Models\User;

/**
 * @extends Factory<User>
 */
class DeploymentFactory extends Factory
{
    use WithFaker;

    protected $model = Deployment::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'commit_hash' => $this->faker->sha1,
        ];
    }
}
