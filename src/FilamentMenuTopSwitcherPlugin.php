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
            ->topNavigation(fn() => self::isTopBarMenu());

    }

    public static function isTopBarMenu(): bool
    {
        return self::normalizeState(session('topNavigation'));
    }

    protected static function normalizeState(mixed $value, bool $default = false): bool
    {
        if ($value === null) {
            return $default;
        }

        if (is_bool($value)) {
            return $value;
        }

        if (is_int($value)) {
            return $value === 1;
        }

        $normalized = strtolower(trim((string)$value));

        return in_array($normalized, ['1', 'true', 'on', 'yes', 'top', 'topbar'], true);
    }

    public function boot(Panel $panel): void
    {

    }

    public static function make(): static
    {
        return new static;
    }
}
