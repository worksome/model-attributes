<?php

declare(strict_types=1);

namespace Worksome\ModelAttributes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Worksome\ModelAttributes\Concerns\DisallowOnModelAttributesTrait;
use Worksome\ModelAttributes\Contracts\AttributeInterface;

/**
 * @implements AttributeInterface<ModelAttribute>
 */
abstract class ModelAttribute extends Model implements AttributeInterface
{
    use DisallowOnModelAttributesTrait;

    public static function booted()
    {
        parent::booted();

        $scopeName = Str::beforeLast(class_basename(static::class), 'Attribute');

        static::addGlobalScope($scopeName, function (Builder $query) {
            static::attributeGlobalScope($query);
        });
    }

    /**
     * Defines the attribute global scope that must be added to the model attribute.
     */
    abstract public static function attributeGlobalScope(Builder $query): void;

    public function getValue(): mixed
    {
        return $this;
    }
}
