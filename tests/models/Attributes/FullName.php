<?php

declare(strict_types=1);

namespace Worksome\ModelAttributes\Tests\Models\Attributes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Worksome\ModelAttributes\Tests\Models\User;
use Worsome\ModelAttributes\ModelAttribute;

class FullName extends ModelAttribute
{
    public $table = 'users';

    public static function attributeGlobalScope(Builder $query): void
    {
        $userModel = new User();
        $query->addSelect(
            $userModel->getQualifiedKeyName(), ' AS user_id',
            DB::raw('COALESCE(first_name, " ", last_name) AS full_name'),
        );
    }
}
