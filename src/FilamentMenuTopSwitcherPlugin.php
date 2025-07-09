<?php

namespace Ngankt2\FilamentMenuTopSwitcher;

use Filament\Contracts\Plugin;
use Filament\Navigation\MenuItem;
use Filament\Panel;

class FilamentMenuTopSwitcherPlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-menu-top-switcher';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->userMenuItems([
                MenuItem::make()
                    ->label(
                        (bool)request()->cookie('topNavigation')
                            ? 'Sử dụng menu dọc'
                            : 'Sử dụng menu ngang'
                    )
                    ->url(route('filament-menu-top-switcher'))
                    ->icon('heroicon-o-arrow-path'),


            ])
            ->topNavigation((bool)request()->cookie('topNavigation'));

    }

    public function boot(Panel $panel): void
    {

    }

    public static function make(): static
    {
        return new static;
    }
}
