<?php

namespace Ngankt2\FilamentMenuTopSwitcher;

use Filament\Facades\Filament;
use Illuminate\Support\HtmlString;
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

        Filament::registerRenderHook(
            'panels::scripts.before',
            fn () => new HtmlString("
        <script>

            try{
                let _sidebarScrollTop = 0;

                let _firstRender = true;

                function getSidebar() {
                    return document.querySelector('.fi-sidebar-nav');
                }

                document.addEventListener('click', (e) => {
                    const item = e.target.closest('.fi-sidebar-item');
                    const sidebar = getSidebar();

                    if (item && sidebar) {
                        _sidebarScrollTop = sidebar.scrollTop;
                    }
                });

                document.addEventListener('livewire:navigated', () => {
                    if(_firstRender){
                        _firstRender = false;
                        return;
                    }
                    const tryRestoreScroll = () => {
                        const sidebar = getSidebar();
                        if (sidebar && sidebar.scrollTop !== _sidebarScrollTop) {
                            sidebar.scrollTo({ top: _sidebarScrollTop, behavior: 'auto' });
                            requestAnimationFrame(tryRestoreScroll);
                        }
                    };

                    requestAnimationFrame(tryRestoreScroll);
                });
            }catch (e) {

            }

        </script>
    ")
        );
    }

}
