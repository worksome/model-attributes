<?php

declare(strict_types=1);

namespace Worksome\ModelAttributes\Tests\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    public function mechanic()
    {
        return $this->belongsTo(Mechanic::class);
    }
}
