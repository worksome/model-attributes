<?php

declare(strict_types=1);

use Worksome\ModelAttributes\Tests\Database\Factories\CarFactory;
use Worksome\ModelAttributes\Tests\Database\Factories\MechanicFactory;
use Worksome\ModelAttributes\Tests\Database\Factories\OwnerFactory;
use Worksome\ModelAttributes\Tests\Database\Factories\PostFactory;
use Worksome\ModelAttributes\Tests\Database\Factories\RoleFactory;
use Worksome\ModelAttributes\Tests\Database\Factories\UserFactory;
use Worksome\ModelAttributes\Tests\Models\Attributes\FullName;
use Worksome\ModelAttributes\Tests\Models\Attributes\OwnerName;
use Worksome\ModelAttributes\Tests\Models\Attributes\PostName;
use Worksome\ModelAttributes\Tests\Models\Attributes\RoleName;
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
    PostFactory::new()->count(3)->create();
    $user = User::firstOrFail();

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
});


it('can retrieve a MorphMany relationship', function () {
    // https://laravel.com/docs/9.x/eloquent-relationships#one-to-many-polymorphic-relations
});

it('can retrieve a MorphToMany relationship', function () {
    // https://laravel.com/docs/9.x/eloquent-relationships#many-to-many-polymorphic-relations
});
