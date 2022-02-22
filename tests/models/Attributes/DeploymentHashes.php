<?php

declare(strict_types=1);

namespace Worksome\ModelAttributes\Tests\Models\Attributes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Worksome\ModelAttributes\ModelAttribute;
use Worksome\ModelAttributes\Tests\Models\Car;
use Worksome\ModelAttributes\Tests\Models\Deployment;
use Worksome\ModelAttributes\Tests\Models\Environment;
use Worksome\ModelAttributes\Tests\Models\Owner;

class DeploymentHashes extends ModelAttribute
{
    public const KEY = 'id';

    public $table = 'deployments';

    protected $primaryKey = self::KEY;

    public static function attributeGlobalScope(Builder $query): void
    {
        $deploymentModel = new Deployment();
        $environmentModel = new Environment();

        $query->addSelect([
            DB::raw($deploymentModel->getQualifiedKeyName() . ' AS ' . self::KEY),
            DB::raw($deploymentModel->qualifyColumn($environmentModel->getForeignKey()) . ' AS ' . $environmentModel->getForeignKey()),
            'commit_hash',
        ]);
    }
}
