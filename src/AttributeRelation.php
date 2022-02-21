<?php

declare(strict_types=1);

namespace  Worsome\ModelAttributes;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * @template TValue
 */
class AttributeRelation extends Relation
{
    public function __construct(private Relation $relation)
    {
        parent::__construct($relation->getQuery(), $relation->getRelated());
    }

    public function addConstraints(): void
    {
        $this->relation->{__FUNCTION__}(...func_get_args());
    }

    public function addEagerConstraints(array $models): void
    {
        $this->relation->{__FUNCTION__}(...func_get_args());
    }

    /**
     * @param array<int, Model> $models
     * @return array<int, Model>
     */
    public function initRelation(array $models, $relation): array
    {
        return $this->relation->{__FUNCTION__}(...func_get_args());
    }

    /**
     * @param array<int, Model> $models
     * @return array<int, Model>
     */
    public function match(array $models, Collection $results, $relation): array
    {
        $this->relation->{__FUNCTION__}(...func_get_args());

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
        $results = $this->relation->{__FUNCTION__}(...func_get_args());

        return $results?->getValue();
    }
}
