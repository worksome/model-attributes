<?php

namespace Worksome\ModelAttributes\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Worksome\ModelAttributes\AttributeRelation;
use Worksome\ModelAttributes\Tests\Models\Attributes\FullName;

final class User extends Model
{
    public function fullName()
    {
        return new AttributeRelation(
            $this->hasOne(FullName::class, 'user_id', 'id')
        );
    }
}
