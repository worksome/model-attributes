<?php

namespace Worksome\ModelAttributes\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;
use Worksome\ModelAttributes\Tests\Models\Tag;

/**
 * @extends Factory<Tag>
 */
class TagFactory extends Factory
{
    use WithFaker;

    protected $model = Tag::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'clean', 'clear', 'clever', 'cloudy', 'clumsy',
                'delightful', 'depressed', 'determined'
            ]),
        ];
    }
}
