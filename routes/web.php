<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cookie;

use Illuminate\Support\Facades\Route;

Route::get('/pref/toggle-navigation', function () {
    $hasCookie = request()->hasCookie('topNavigation');
    if ($hasCookie) {
        session('topNavigation', false);
        return Redirect::back()->withCookie(Cookie::forget('topNavigation'));
    }
    session('topNavigation', true);
    return Redirect::back()->withCookie(
        cookie('topNavigation', '1', 60 * 24 * 30)
    );
})->name('filament-menu-top-switcher');
