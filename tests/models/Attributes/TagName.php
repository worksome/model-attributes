<?php

declare(strict_types=1);

namespace Worksome\ModelAttributes\Tests\Models\Attributes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Worksome\ModelAttributes\ModelAttribute;
use Worksome\ModelAttributes\Tests\Models\Tag;

class TagName extends ModelAttribute
{
    public const KEY = 'id';

    public $table = 'tags';
    protected $primaryKey = self::KEY;

    public static function attributeGlobalScope(Builder $query): void
    {
        $tagModel = new Tag();

        [$morphType, $morphId] = $tagModel->getMorphs('taggable', null, null);

        $query
            ->addSelect([
                DB::raw($tagModel->getKeyName() . ' AS ' . self::KEY),
                $morphType,
                $morphId,
                DB::raw('(upper(name)) AS tag_name'), // sqlite concatenation operator
            ]);
    }
}
