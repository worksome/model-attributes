<?php

declare(strict_types=1);

use Worksome\ModelAttributes\Tests\Database\Factories\CarFactory;
use Worksome\ModelAttributes\Tests\Database\Factories\CommentFactory;
use Worksome\ModelAttributes\Tests\Database\Factories\DeploymentFactory;
use Worksome\ModelAttributes\Tests\Database\Factories\EnvironmentFactory;
use Worksome\ModelAttributes\Tests\Database\Factories\ImageFactory;
use Worksome\ModelAttributes\Tests\Database\Factories\MechanicFactory;
use Worksome\ModelAttributes\Tests\Database\Factories\OwnerFactory;
use Worksome\ModelAttributes\Tests\Database\Factories\PostFactory;
use Worksome\ModelAttributes\Tests\Database\Factories\ProjectFactory;
use Worksome\ModelAttributes\Tests\Database\Factories\RoleFactory;
use Worksome\ModelAttributes\Tests\Database\Factories\TagFactory;
use Worksome\ModelAttributes\Tests\Database\Factories\UserFactory;
use Worksome\ModelAttributes\Tests\Models\Attributes\CommentLength;
use Worksome\ModelAttributes\Tests\Models\Attributes\DeploymentHashes;
use Worksome\ModelAttributes\Tests\Models\Attributes\FullName;
use Worksome\ModelAttributes\Tests\Models\Attributes\ImageUrl;
use Worksome\ModelAttributes\Tests\Models\Attributes\OwnerName;
use Worksome\ModelAttributes\Tests\Models\Attributes\PostName;
use Worksome\ModelAttributes\Tests\Models\Attributes\RoleName;
use Worksome\ModelAttributes\Tests\Models\Attributes\TagName;
use Worksome\ModelAttributes\Tests\Models\Attributes\UserName;
use Worksome\ModelAttributes\Tests\Models\User;

it('can retrieve a HasOne relationship', function () {
    // https://laravel.com/docs/9.x/eloquent-relationship#one-to-one
    $user = UserFactory::new()->create();

    expect($user->fullName)->toBeInstanceOf(FullName::class);
    expect($user->fullName->full_name)->toEqual($user->first_name . ' ' . $user->last_name);
});

it('can retrieve a HasMany relationship', function () {
    // https://laravel.com/docs/9.x/eloquent-relationships#one-to-many
    $user = UserFactory::new()->create();
    PostFactory::new()->count(3)->for($user)->create();

    expect($user->postNames)->each->toBeInstanceOf(PostName::class);
    expect($user->postNames->count())->toEqual(3);
});

it('can retrieve a BelongsTo relationship', function () {
    // https://laravel.com/docs/9.x/eloquent-relationships#one-to-one-defining-the-inverse-of-the-relationship
    $post = PostFactory::new()->create();
    $user = $post->user;

    expect($post->userName)->toBeInstanceOf(UserName::class);
    expect($post->userName->full_name)->toEqual($user->first_name . ' ' . $user->last_name);
});

it('can retrieve a HasOneThrough relationship', function () {
    // https://laravel.com/docs/9.x/eloquent-relationships#has-one-through
    $mechanic = MechanicFactory::new()->create();
    $car = CarFactory::new(['mechanic_id' => $mechanic->getKey()])->create();
    $owner = OwnerFactory::new(['car_id' => $car->getKey()])->create();

    expect($mechanic->ownerName)->toBeInstanceOf(OwnerName::class);
    expect($mechanic->ownerName->owner_name)->toEqual($mechanic->carOwner->name);
});

it('can retrieve a HasManyThrough relationship', function () {
    // https://laravel.com/docs/9.x/eloquent-relationships#has-many-through
    $project = ProjectFactory::new()->create();
    $environments = EnvironmentFactory::new(['project_id' => $project->getKey()])->count(5)->create();
    $deployments = DeploymentFactory::new([
        'environment_id' => $environments->pluck('id')->random(1)->first()
    ])->create();

    expect($project->deploymentHashes)->each->toBeInstanceOf(DeploymentHashes::class);
    expect($project->deploymentHashes->count())->toEqual($project->deployments()->count());
    expect($project->deploymentHashes)->map->commit_hash->each->toBeString();
});

it('can retrieve a BelongsToMany relationship', function () {
    // https://laravel.com/docs/9.x/eloquent-relationships#many-to-many
    $user = UserFactory::new()
        ->has(RoleFactory::new()->count(5))
        ->create();

    expect($user->roleNames)->each->toBeInstanceOf(RoleName::class);
    expect($user->roleNames->count())->toEqual(5);
});

it('can retrieve a MorphOne relationship', function () {
    // https://laravel.com/docs/9.x/eloquent-relationships#one-to-one-polymorphic-relations
    $post = PostFactory::new()
        ->has(ImageFactory::new())
        ->create();

    expect($post->imageUrl)->toBeInstanceOf(ImageUrl::class);
    expect($post->imageUrl->url)->toBeString();
});


it('can retrieve a MorphMany relationship', function () {
    // https://laravel.com/docs/9.x/eloquent-relationships#one-to-many-polymorphic-relations
    $post = PostFactory::new()
        ->has(CommentFactory::new()->count(7))
        ->create();

    expect($post->commentLength)->each->toBeInstanceOf(CommentLength::class);
    expect($post->commentLength->count())->toEqual(7);
});

it('can retrieve a MorphToMany relationship', function () {
    // https://laravel.com/docs/9.x/eloquent-relationships#many-to-many-polymorphic-relations
    $post = PostFactory::new()
        ->hasAttached(TagFactory::new()->count(5))
        ->create();

    expect($post->tagNames)->each->toBeInstanceOf(TagName::class);
    expect($post->tagNames->count())->toEqual(5);
    expect($post->tagNames)->map->tag_name->each->toBeString();
});
