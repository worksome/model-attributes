<?php

declare(strict_types=1);

namespace Worksome\ModelAttributes;

use BadMethodCallException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Enumerable;
use InvalidArgumentException;

/**
 * @template TRelatedModel of \Illuminate\Database\Eloquent\Model
 *
 * @extends Relation<TRelatedModel>
 */
class AttributeRelation extends Relation
{
    protected static $constraints = false;

    /**
     * @param Relation<TRelatedModel> $relation
     */
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
     *
     * @return array<int, Model>
     */
    public function initRelation(array $models, $relation): array
    {
        return $this->relation->initRelation($models, $relation);
    }

    /**
     * @param array|Model[]                  $models
     * @param Collection<int, TRelatedModel> $results
     *
     * @return array|Model[] $results
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
     * @return TRelatedModel|Enumerable<int, TRelatedModel>|null
     */
    public function getResults(): mixed
    {
        $results = $this->relation->getResults();

        if ($results === null) {
            return null;
        }

        if ($results instanceof ModelAttribute) {
            return $results->getValue();
        }

        if ($results instanceof Enumerable) {
            return $results->map(fn($result) => $result->getValue());
        }

        throw new InvalidArgumentException("The provided relationship result is invalid.");
    }

    public function __call($name, $arguments)
    {
        if (! method_exists($this->relation, $name)) {
            throw new BadMethodCallException("There is no {$name}() method on " . get_class($this->relation));
        }

        return $this->relation->{$name}(...$arguments);
    }

    /**
     * @param string $key
     */
    public function __get($key): mixed
    {
        if (property_exists($this->relation, $key) === false) {
            throw new InvalidArgumentException("There is no '{$key}' property on " . $this->relation::class);
        }

        return $this->relation->{$key};
    }
}
