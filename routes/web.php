<?php

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::get('/pref/toggle-navigation', function () {
        // Evaluate current state (true if top menu is ON)
        $isTopMenu = session('topNavigation', request()->cookie('topNavigation') == '1');

        // Toggle the value
        $newState = !$isTopMenu;

        // Update both Session and Cookie
        session(['topNavigation' => $newState]);

        return Redirect::back()->withCookie(
            cookie('topNavigation', $newState ? '1' : '0', 60 * 24 * 30) // valid for 30 days
        );
    })->name('filament-menu-top-switcher');
});
