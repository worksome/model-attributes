<?php

declare(strict_types=1);

namespace Worksome\ModelAttributes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Worksome\ModelAttributes\Exceptions\NotAllowedException;

abstract class ModelAttribute extends Model
{
    /**
     * Boots the model attribute behaviour.
     */
    public static function booted()
    {
        parent::booted();

        static::creating(fn() => throw new NotAllowedException('Creating on model attributes is not allowed'));
        static::saving(fn() => throw new NotAllowedException('Saving on model attributes is not allowed'));
        static::updating(fn() => throw new NotAllowedException('Updating on model attributes is not allowed'));
        static::deleting(fn() => throw new NotAllowedException('Deleting on model attributes is not allowed'));

        $scopeName = Str::beforeLast(class_basename(static::class), 'Attribute');
        static::addGlobalScope($scopeName, function (Builder $query) {
            static::attributeGlobalScope($query);
        });
    }

    /**
     * Defines the attribute global scope that must be added to the model attribute.
     *
     * @param Builder $query
     */
    abstract public static function attributeGlobalScope(Builder $query): void;

    /**
     * Get the attribute value.
     *
     * Gets called when the relationship is "stitched" back to the invoking model. If your model attribute
     * is a scalar you can return the scalar. If your model attribute is  a range of values you can return a stdClass
     * of the values.
     */
    public function getValue(): mixed
    {
        return $this;
    }
}
