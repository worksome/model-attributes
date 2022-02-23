<?php

declare(strict_types=1);

namespace Worksome\ModelAttributes\Tests\Models\Attributes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Worksome\ModelAttributes\ModelAttribute;
use Worksome\ModelAttributes\Tests\Models\Comment;

class CommentLength extends ModelAttribute
{
    public const KEY = 'id';

    public $table = 'comments';

    protected $primaryKey = self::KEY;

    public static function attributeGlobalScope(Builder $query): void
    {
        $commentModel = new Comment();

        [$morphType, $morphId] = $commentModel->getMorphs('commentable', null, null);

        $query
            ->addSelect([
                DB::raw($commentModel->getKeyName() . ' AS ' . self::KEY),
                $morphType,
                $morphId,
                DB::raw('length(body) as length'),
            ]);
    }
}
