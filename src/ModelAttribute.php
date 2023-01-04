<?php

declare(strict_types=1);

namespace Worksome\ModelAttributes;

use BadMethodCallException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class ModelAttribute extends Model
{
    /**
     * Boots the model attribute behaviour.
     */
    public static function booted()
    {
        parent::booted();

        static::creating(fn() => throw new BadMethodCallException('Creating on model attributes is not allowed'));
        static::saving(fn() => throw new BadMethodCallException('Saving on model attributes is not allowed'));
        static::updating(fn() => throw new BadMethodCallException('Updating on model attributes is not allowed'));
        static::deleting(fn() => throw new BadMethodCallException('Deleting on model attributes is not allowed'));

        static::addGlobalScope(static::class, function (Builder $query) {
            static::attributeGlobalScope($query);
        });
    }

    /**
     * Defines the attribute global scope that must be added to the model attribute.
     *
     * @param Builder<static> $query
     */
    abstract public static function attributeGlobalScope(Builder $query): void;

    /**
     * Get the attribute value.
     *
     * Gets called when the relationship is "stitched" back to the invoking model. When
     * your model attribute is a scalar you can return the scalar. When your model
     * attribute is a range of values you can return a stdClass of the values.
     */
    public function getValue(): mixed
    {
        return $this;
    }
}
