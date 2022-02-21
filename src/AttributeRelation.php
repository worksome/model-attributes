<?php

declare(strict_types=1);

namespace Worksome\ModelAttributes;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * @template TValue
 */
class AttributeRelation extends Relation
{
    protected static $constraints = false;

    public function __construct(private Relation $relation)
    {
        parent::__construct($relation->getQuery(), $relation->getRelated());
    }

    public function addConstraints(): void
    {
        if (static::$constraints) {
            $this->relation->addConstraints();
        }
    }

    public function addEagerConstraints(array $models): void
    {
        $this->relation->addEagerConstraints($models);
    }

    /**
     * @param array<int, Model> $models
     * @return array<int, Model>
     */
    public function initRelation(array $models, $relation): array
    {
        return $this->relation->initRelation($models, $relation);
    }

    /**
     * @param array<int, Model> $models
     * @return array<int, Model>
     */
    public function match(array $models, Collection $results, $relation): array
    {
        $models = $this->relation->match($models, $results, $relation);

        foreach ($models as $model) {
            $model->setRelation(
                $relation,
                $model->{$relation}?->getValue()
            );
        }

        return $models;
    }

    /**
     * @return TValue|null
     */
    public function getResults(): mixed
    {
        return $this->relation->getResults()?->getValue();
    }
}
