<?php

declare(strict_types=1);

use Worksome\ModelAttributes\Tests\Database\Factories\PostFactory;
use Worksome\ModelAttributes\Tests\Models\Attributes\PostName;
use Worksome\ModelAttributes\Tests\Models\User;

it('can retrieve a hasMany relationship', function () {
    PostFactory::new()->count(3)->create();
    $user = User::firstOrFail();

    expect($user->postNames)->each->toBeInstanceOf(PostName::class);
    expect($user->postNames->count())->toEqual(3);
});
