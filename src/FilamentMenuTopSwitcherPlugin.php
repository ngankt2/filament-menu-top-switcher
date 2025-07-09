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
                    ->label(fn()=>__('filament-menu-top-switcher::menu.change_menu'))
                    ->url(fn(): string => route('filament-menu-top-switcher'))
                    ->icon('heroicon-c-bars-arrow-up'),
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
