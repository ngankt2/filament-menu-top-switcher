<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::get('/pref/toggle-navigation', function () {
        // Session-only để mỗi lần đăng nhập mới sẽ quay về sidebar mặc định.
        $isTopMenu = \Ngankt2\FilamentMenuTopSwitcher\FilamentMenuTopSwitcherPlugin::isTopBarMenu();

        // Toggle the value
        $newState = !$isTopMenu;

        // Update session only
        session(['topNavigation' => $newState]);

        return Redirect::back();
    })->name('filament-menu-top-switcher');
});
