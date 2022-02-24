<?php

declare(strict_types=1);

namespace Worksome\ModelAttributes\Tests\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    public function car()
    {
        return $this->hasOne(Car::class);
    }
}
