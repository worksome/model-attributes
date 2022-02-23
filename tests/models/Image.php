<?php

namespace Worksome\ModelAttributes\Tests\Models;

use Illuminate\Database\Eloquent\Model;

final class Image extends Model
{
    public function imageable()
    {
        return $this->morphTo();
    }
}
