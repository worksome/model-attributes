<?php

namespace Worksome\ModelAttributes;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Worksome\ModelAttributes\Commands\ModelAttributesCommand;

class ModelAttributesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('model-attributes')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_model-attributes_table')
            ->hasCommand(ModelAttributesCommand::class);
    }
}
