<?php


use Worksome\ModelAttributes\AttributeRelation;
use Worksome\ModelAttributes\Tests\Database\Factories\UserFactory;
use Worksome\ModelAttributes\Tests\Models\Attributes\FullName;

it('can retrieve model attributes', function (string $firstName, string $lastName, string $fullName) {
    $user = UserFactory::new()->create([
        'first_name' => $firstName,
        'last_name' => $lastName,
    ]);

    expect($user->fullName())->toBeInstanceOf(AttributeRelation::class);
    expect($user->fullName)->toBeInstanceOf(FullName::class);
    expect($user->fullName->full_name)->toEqual($fullName);
})
    ->with([
        [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'full_name' => 'John Doe',
        ],
        [
            'first_name' => 'Marry',
            'last_name' => 'Jane',
            'full_name' => 'Marry Jane',
        ],
    ]);
