<?php

namespace Worksome\ModelAttributes\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Worksome\ModelAttributes\AttributeRelation;
use Worksome\ModelAttributes\Tests\Models\Attributes\UserName;

final class Post extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userName()
    {
        return new AttributeRelation(
            $this->belongsTo(
                UserName::class,
                $this->user()->getForeignKeyName(),
                $this->user()->getOwnerKeyName(),
            )
        );
    }
}
