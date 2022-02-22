<?php

declare(strict_types=1);

namespace Worksome\ModelAttributes\Concerns;

use Illuminate\Database\Eloquent\Model;
use Worksome\ModelAttributes\Exceptions\NotAllowedException;

/**
 * @mixin Model
 */
trait DisallowOnModelAttributesTrait
{
    public static function bootDisallowOnModelAttributesTrait(): void
    {
        static::creating(fn() => throw new NotAllowedException('Creating on model attributes is not allowed'));
        static::saving(fn() => throw new NotAllowedException('Saving on model attributes is not allowed'));
        static::updating(fn() => throw new NotAllowedException('Updating on model attributes is not allowed'));
        static::deleting(fn() => throw new NotAllowedException('Deleting on model attributes is not allowed'));
    }
}
