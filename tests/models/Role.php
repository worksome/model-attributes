<?php

namespace Worksome\ModelAttributes\Tests\Models;

use Illuminate\Database\Eloquent\Model;

final class Role extends Model
{
    public function user()
    {
        return $this->hasManyThrough(User::class);
    }
}
