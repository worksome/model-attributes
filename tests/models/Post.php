<?php

namespace Worksome\ModelAttributes\Tests\Models;

use Illuminate\Database\Eloquent\Model;

final class Post extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
