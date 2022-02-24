<?php

declare(strict_types=1);

namespace Worksome\ModelAttributes\Tests\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }
}
