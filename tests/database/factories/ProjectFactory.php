<?php

namespace Worksome\ModelAttributes\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;
use Worksome\ModelAttributes\Tests\Models\Project;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    use WithFaker;

    protected $model = Project::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Project 1',
                'Project 2',
                'Project 3',
                'Project 4',
                'Project 5',
                'Project 6',
            ]),
        ];
    }
}
