<?php

namespace Worksome\ModelAttributes\Tests;

use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        $migrations = [
            include __DIR__ . '/database/migrations/users.php.stub',
            include __DIR__ . '/database/migrations/posts.php.stub',
            include __DIR__ . '/database/migrations/roles.php.stub',
            include __DIR__ . '/database/migrations/role_user.php.stub',
            include __DIR__ . '/database/migrations/mechanics.php.stub',
            include __DIR__ . '/database/migrations/cars.php.stub',
            include __DIR__ . '/database/migrations/owners.php.stub',
            include __DIR__ . '/database/migrations/projects.php.stub',
            include __DIR__ . '/database/migrations/environments.php.stub',
            include __DIR__ . '/database/migrations/deployments.php.stub',
        ];

        foreach ($migrations as $migration) {
            $migration->up();
        }
    }

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [];
    }
}
