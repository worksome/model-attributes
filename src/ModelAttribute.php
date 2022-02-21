<?php

declare(strict_types=1);

namespace  Worsome\ModelAttributes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Worsome\ModelAttributes\Concerns\DisallowOnModelAttributesTrait;
use Worsome\ModelAttributes\Contracts\AttributeInterface;

/**
 * @implements AttributeInterface<ModelAttribute>
 */
abstract class ModelAttribute extends Model implements AttributeInterface
{
    use DisallowOnModelAttributesTrait;

    public static function booting()
    {
        parent::booting();

        $scopeName = Str::beforeLast(class_basename(static::class), 'Attribute');

        static::addGlobalScope($scopeName, fn (Builder $query) => static::attributeGlobalScope($query));
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
