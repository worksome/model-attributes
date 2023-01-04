<?php

declare(strict_types=1);

namespace Worksome\ModelAttributes\Tests\Models\Attributes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Worksome\ModelAttributes\ModelAttribute;
use Worksome\ModelAttributes\Tests\Models\Post;
use Worksome\ModelAttributes\Tests\Models\User;

class PostName extends ModelAttribute
{
    public const KEY = 'id';

    public $table = 'posts';
    protected $primaryKey = self::KEY;

    public static function attributeGlobalScope(Builder $query): void
    {
        $postModel = new Post();
        $userModel = new User();

        $query
            ->addSelect(DB::raw($postModel->getQualifiedKeyName() . ' AS ' . self::KEY))
            ->addSelect(
                DB::raw($postModel->qualifyColumn($userModel->getForeignKey()) . ' AS ' . $userModel->getForeignKey())
            )
            ->addSelect(DB::raw('("post: " || name) AS post_name')); // sqlite concatenation operator
    }
}
