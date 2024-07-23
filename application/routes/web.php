<?php

use App\Services\TestConnectionService;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-connections', static function (TestConnectionService $service): never {
    dd($service->testPredefinedConnections());
});
