<?php

namespace Worksome\ModelAttributes\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Worksome\ModelAttributes\AttributeRelation;
use Worksome\ModelAttributes\Tests\Models\Attributes\FullName;
use Worksome\ModelAttributes\Tests\Models\Attributes\PostName;

final class User extends Model
{
    public function fullName()
    {
        return new AttributeRelation(
            $this->hasOne(
                FullName::class,
                // in \Illuminate\Database\Eloquent\Concerns\HasRelationships::hasOne() assumed to be FullName::getTable().'.'.User::getForeignKey()
                // no problem when the model attribute is on a different table
                'id',
                FullName::KEY // can be omitted if FullName::getKeyName() === 'id' (framework convention)
            )
        );
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function postNames()
    {
        return new AttributeRelation(
            $this->hasMany(
                PostName::class,
                // in \Illuminate\Database\Eloquent\Concerns\HasRelationships::hasMany() assumed to be PostName::getTable().'.'.User::getForeignKey()
                // no problem when the model attribute is on a different table
                '',
                PostName::KEY // can be omitted if PostName::getKeyName() === 'id' (framework convention)
            )
        );
    }
}
