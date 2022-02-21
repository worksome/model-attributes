<?php

namespace Worksome\ModelAttributes\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Worksome\ModelAttributes\ModelAttributes
 */
class ModelAttributes extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'model-attributes';
    }
}
