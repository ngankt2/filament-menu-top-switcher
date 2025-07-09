<?php

namespace JaysonTemporas\PageBookmarks;

use Filament\Support\Facades\FilamentView;
use Illuminate\Support\Facades\Blade;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentMenuTopSwitcherProvider extends PackageServiceProvider
{
    public static string $name = 'filament-menu-top-switcher';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasViews('filament-menu-top-switcher')
            ->hasRoute('web');
    }

    public function packageBooted(): void
    {

    }
}
