<?php

declare(strict_types=1);

namespace Worksome\ModelAttributes\Tests\Models\Attributes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Worksome\ModelAttributes\ModelAttribute;
use Worksome\ModelAttributes\Tests\Models\User;

class FullName extends ModelAttribute
{
    public const KEY = 'id';

    public $table = 'users';

    protected $primaryKey = self::KEY;

    public static function attributeGlobalScope(Builder $query): void
    {
        $userModel = new User();

        $query->addSelect(
            DB::raw($userModel->getQualifiedKeyName() . ' AS ' . self::KEY),
            DB::raw($userModel->getQualifiedKeyName() . ' AS ' . $userModel->getForeignKey()),
            DB::raw('(first_name || " " || last_name) AS full_name'), // sqlite concatenation operator
        );
    }

    public function getKeyName()
    {
//        return $this->primaryKey; // framework version
//        return 'id'; // framework convention
        return self::KEY;
    }

    public function getForeignKey()
    {
//        return Str::snake(class_basename($this)).'_'.$this->getKeyName(); // framework version
        return 'full_name_id'; // framework version
    }
}
