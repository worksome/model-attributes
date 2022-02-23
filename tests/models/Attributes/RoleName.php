<?php

declare(strict_types=1);

namespace Worksome\ModelAttributes\Tests\Models\Attributes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Worksome\ModelAttributes\ModelAttribute;
use Worksome\ModelAttributes\Tests\Models\Role;

class RoleName extends ModelAttribute
{
    public const KEY = 'id';
    public $table = 'roles';
    protected $primaryKey = self::KEY;

    public static function attributeGlobalScope(Builder $query): void
    {
        $roleModel = new Role();

        $query
            ->addSelect(DB::raw($roleModel->getQualifiedKeyName() . ' AS ' . self::KEY))
            ->addSelect(DB::raw('("role name: " || name) AS role_name')); // sqlite concatenation operator
    }
}
