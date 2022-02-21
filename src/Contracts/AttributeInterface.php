<?php

declare(strict_types=1);

namespace Worsome\ModelAttributes\Contracts;

/**
 * The contract that model attributes must implement in order to convert them to their values.
 */
interface AttributeInterface
{
    /**
     * Gets the attribute value.
     */
    public function getValue(): mixed;
}
