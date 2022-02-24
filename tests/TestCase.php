<?php

namespace Worksome\ModelAttributes\Tests;

use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        foreach (File::allFiles(__DIR__. '/database/migrations') as $file) {
            (include $file->getRealPath())->up();
        }
    }
}
