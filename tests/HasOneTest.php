<?php

declare(strict_types=1);

use Worksome\ModelAttributes\Tests\Database\Factories\UserFactory;
use Worksome\ModelAttributes\Tests\Models\Attributes\FullName;

it('can retrieve hasOne relationships', function () {
    $user = UserFactory::new()->create();

    expect($user->fullName)->toBeInstanceOf(FullName::class);
    expect($user->fullName->full_name)->toEqual($user->first_name . ' ' . $user->last_name);
});
