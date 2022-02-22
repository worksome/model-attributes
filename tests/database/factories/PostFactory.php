<?php

namespace Worksome\ModelAttributes\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;
use Worksome\ModelAttributes\Tests\Models\Post;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    use WithFaker;

    protected $model = Post::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
        ];
    }

    public function configure()
    {
        $user = UserFactory::new()->create();

        return parent::configure()
            ->afterMaking(fn(Post $post) => $post->user()->associate($user));
    }
}
