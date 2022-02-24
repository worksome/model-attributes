<?php

namespace Worksome\ModelAttributes\Tests\Models;

use Illuminate\Database\Eloquent\Model;

final class Comment extends Model
{
    public function commentable()
    {
        return $this->morphTo();
    }
}
