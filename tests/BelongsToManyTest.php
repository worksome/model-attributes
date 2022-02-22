<?php

declare(strict_types=1);

use Worksome\ModelAttributes\Tests\Database\Factories\RoleFactory;
use Worksome\ModelAttributes\Tests\Database\Factories\UserFactory;
use Worksome\ModelAttributes\Tests\Models\Attributes\RoleName;

it('can retrieve a BelongsToMany relationship', function () {
    $user = UserFactory::new()
        ->has(RoleFactory::new()->count(5))
        ->create();

    expect($user->roleNames)->each->toBeInstanceOf(RoleName::class);
    expect($user->roleNames->count())->toEqual(5);
});
