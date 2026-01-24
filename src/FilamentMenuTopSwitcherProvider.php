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

        // Custom CSS for sidebar scrollbar
        Filament::registerRenderHook(
            'panels::head.end',
            fn () => new HtmlString("
<style>
.fi-sidebar {
    ::-webkit-scrollbar {
        height: 9px;
        width: 5px;
        border-radius: 8px;
    }

    ::-webkit-scrollbar-track {
        background: transparent;
        border-radius: 8px;
    }

    ::-webkit-scrollbar-thumb {
        background: transparent;
        border-radius: 8px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: transparent;
    }
}
</style>
    ")
        );

        // JavaScript for sidebar scroll position restore
        Filament::registerRenderHook(
            'panels::scripts.before',
            fn () => new HtmlString("
        <script>
try {
    let _sidebarScrollTop = 0;
    let _firstRender = true;
    let _isRestoring = false;

    function getSidebar() {
        return document.querySelector('.fi-sidebar-nav');
    }

    // Lưu vị trí cuộn sidebar
    function saveSidebarScrollPosition() {
        const sidebar = getSidebar();
        if (sidebar) {
            _sidebarScrollTop = sidebar.scrollTop;
        }
    }

    // Lưu khi click vào sidebar item (như cũ)
    document.addEventListener('click', (e) => {
        const item = e.target.closest('.fi-sidebar-item');
        if (item) {
            saveSidebarScrollPosition();
            return;
        }

        // Lưu khi click vào các link điều hướng trong nội dung chính
        // Bao gồm: table actions, breadcrumb, form buttons, etc.
        const navLink = e.target.closest('a[href]:not([href=\"#\"]):not([href^=\"javascript:\"]):not([target=\"_blank\"])');
        if (navLink && !navLink.hasAttribute('wire:navigate.prevent')) {
            saveSidebarScrollPosition();
        }
    });

    // Lưu vị trí khi Livewire bắt đầu điều hướng (cách tốt nhất)
    document.addEventListener('livewire:navigate', () => {
        saveSidebarScrollPosition();
    });

    // Cho phép scroll thủ công - hủy restore khi user scroll
    document.addEventListener('wheel', () => {
        _isRestoring = false;
    }, { passive: true });

    document.addEventListener('touchmove', () => {
        _isRestoring = false;
    }, { passive: true });

    document.addEventListener('livewire:navigated', () => {
        if (_firstRender) {
            _firstRender = false;
            return;
        }

        _isRestoring = true;
        let retryCount = 0;
        const maxRetries = 10; // Tối đa 10 lần thử (~160ms)

        const tryRestoreScroll = () => {
            // Dừng nếu user đã scroll hoặc quá số lần thử
            if (!_isRestoring || retryCount >= maxRetries) {
                _isRestoring = false;
                return;
            }

            const sidebar = getSidebar();
            if (sidebar) {
                // Kiểm tra đã restore thành công chưa (cho phép sai số 2px)
                if (Math.abs(sidebar.scrollTop - _sidebarScrollTop) <= 2) {
                    _isRestoring = false;
                    return;
                }
                
                sidebar.scrollTo({ top: _sidebarScrollTop, behavior: 'auto' });
                retryCount++;
                requestAnimationFrame(tryRestoreScroll);
            } else {
                retryCount++;
                requestAnimationFrame(tryRestoreScroll);
            }
        };

        requestAnimationFrame(tryRestoreScroll);
    });
} catch (e) {
    console.warn('Sidebar scroll restore error:', e);
}
</script>
    ")
        );
    }

}
