<?php

declare(strict_types=1);

namespace Worksome\ModelAttributes\Tests\Models\Attributes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Worksome\ModelAttributes\ModelAttribute;
use Worksome\ModelAttributes\Tests\Models\Car;
use Worksome\ModelAttributes\Tests\Models\Owner;

class OwnerName extends ModelAttribute
{
    public const KEY = 'id';

    public $table = 'owners';

    protected $primaryKey = self::KEY;

    public static function attributeGlobalScope(Builder $query): void
    {
        $ownerModel = new Owner();
        $carModel = new Car();

        $query->addSelect([
            DB::raw($ownerModel->getQualifiedKeyName() . ' AS ' . self::KEY),
            DB::raw($ownerModel->qualifyColumn($carModel->getForeignKey()) . ' AS ' . $carModel->getForeignKey()),
            DB::raw('(name) AS owner_name'), // sqlite concatenation operator
        ]);
    }
}
