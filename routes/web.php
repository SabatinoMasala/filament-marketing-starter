<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\ResponseCache\Middlewares\CacheResponse;

Route::get('/', function() {
    return response()->redirectTo('/en');
});

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        CacheResponse::class
    ]
], function() {
    Route::group([
        'prefix' => c('routes.blog'),
    ], function() {
        Route::get('/{slug}', [BlogController::class, 'show']);
    });
    Route::get('/{any?}', [PageController::class, 'show'])->where('any', '.*');
});
