<?php

declare(strict_types=1);

namespace  Worsome\ModelAttributes;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class AttributeRelation extends Relation
{
    public function __construct(private Relation $relation)
    {
        parent::__construct($relation->getQuery(), $relation->getRelated());
    }

    public function addConstraints()
    {
        $this->relation->{__FUNCTION__}(...func_get_args());
    }

    public function addEagerConstraints(array $models)
    {
        $this->relation->{__FUNCTION__}(...func_get_args());
    }

    public function initRelation(array $models, $relation)
    {
        return $this->relation->{__FUNCTION__}(...func_get_args());
    }

    public function match(array $models, Collection $results, $relation)
    {
        $this->relation->{__FUNCTION__}(...func_get_args());

        /** @var Model $model */
        foreach ($models as $model) {
            $model->setRelation(
                $relation,
                $model->$relation?->getValue()
            );
        }
        return $models;
    }

    public function getResults()
    {
        $results = $this->relation->{__FUNCTION__}(...func_get_args());

        return $results?->getValue();
    }
}
