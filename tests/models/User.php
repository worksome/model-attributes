<?php

namespace Worksome\ModelAttributes\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Worksome\ModelAttributes\Tests\Models\Attributes\FullName;
use Worsome\ModelAttributes\AttributeRelation;

final class User extends Model
{
    public function fullName()
    {
        return new AttributeRelation(
            $this->hasOne(FullName::class, 'user_id', 'id')
        );
    }
}
