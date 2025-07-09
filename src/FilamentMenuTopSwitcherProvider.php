<?php

namespace Ngankt2\FilamentMenuTopSwitcher;

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
            ->hasTranslations()
            ->hasRoute('web');
    }

    public function packageBooted(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'filament-menu-top-switcher');

        $this->publishes([
            __DIR__.'/../lang' => base_path('lang/vendor/filament-menu-top-switcher'),
        ], 'filament-menu-top-switcher-translations');
    }

}
