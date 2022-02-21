<?php

namespace Worksome\ModelAttributes\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Worksome\ModelAttributes\AttributeRelation;
use Worksome\ModelAttributes\Tests\Models\Attributes\FullName;

final class User extends Model
{
    public function fullName()
    {
        /**
         * Users table -> needs
         */
        return new AttributeRelation(
            $this->hasOne(
                FullName::class,
                'id', // in \Illuminate\Database\Eloquent\Concerns\HasRelationships::hasOne() assumed to be FullName::getTable().'.'.User::getForeignKey()
                FullName::KEY // can be omitted if FullName::getKeyName() === 'id'
            )
        );
    }
}
