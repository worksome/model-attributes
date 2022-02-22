<?php

namespace Worksome\ModelAttributes\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Worksome\ModelAttributes\AttributeRelation;
use Worksome\ModelAttributes\Tests\Models\Attributes\DeploymentHashes;

final class Project extends Model
{
    public function environments()
    {
        $this->hasMany(Environment::class);
    }

    public function deployments()
    {
        return $this->hasManyThrough(Deployment::class, Environment::class);
    }

    public function deploymentHashes()
    {
        return new AttributeRelation(
            $this->hasManyThrough(
                DeploymentHashes::class,
                Environment::class
            )
        );
    }
}
