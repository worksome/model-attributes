<?php

declare(strict_types=1);

namespace Worksome\ModelAttributes\Tests\Models\Attributes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Worksome\ModelAttributes\ModelAttribute;
use Worksome\ModelAttributes\Tests\Models\Image;

class ImageUrl extends ModelAttribute
{
    public const KEY = 'id';

    public $table = 'images';

    protected $primaryKey = self::KEY;

    public static function attributeGlobalScope(Builder $query): void
    {
        $imageModel = new Image();

        [$morphType, $morphId] = $imageModel->getMorphs('imageable', null, null);

        $query
            ->addSelect([
                DB::raw($imageModel->getKeyName() . ' AS ' . self::KEY),
                $morphType,
                $morphId,
                'url'
            ]);
    }
}
