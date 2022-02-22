<?php

declare(strict_types=1);

namespace Worksome\ModelAttributes\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Worksome\ModelAttributes\AttributeRelation;
use Worksome\ModelAttributes\Tests\Models\Attributes\OwnerName;

class Mechanic extends Model
{
    public function carOwner()
    {
        return $this->hasOneThrough(Owner::class, Car::class);
    }

    public function ownerName()
    {
        return new AttributeRelation(
            $this->hasOneThrough(
                OwnerName::class,
                Car::class,
            )
        );
    }
}
