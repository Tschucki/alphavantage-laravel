<?php

namespace Tschucki\Alphavantage;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AlphavantageServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('alphavantage-laravel')
            ->hasConfigFile('alphavantage');
    }
}
