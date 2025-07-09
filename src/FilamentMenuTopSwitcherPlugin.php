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
                        (bool) request()->cookie('topNavigation')
                            ? __('filament-menu-top-switcher::menu.use_sidebar')
                            : __('filament-menu-top-switcher::menu.use_topnav')
                    )
                    ->url(fn(): string => route('filament-menu-top-switcher'))
                    ->icon(fn(): string => (bool) request()->cookie('topNavigation')
                        ? 'heroicon-s-bars-3-bottom-left'
                        : 'heroicon-c-bars-arrow-up'),
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
