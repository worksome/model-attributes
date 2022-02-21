<?php

declare(strict_types=1);

namespace Worksome\ModelAttributes\Contracts;

/**
 * The contract that model attributes must implement in order to convert them to their values.
 *
 * @template TValue
 */
interface AttributeInterface
{
    /**
     * Gets the attribute value.
     *
     * @return TValue
     */
    public function getValue(): mixed;
}
