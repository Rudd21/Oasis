<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test-data', function(){
    return response()->json([
        'message' => 'Laravel віддає Oasis!',
        'status' => 'connected',
        'items' => ['Vue 3', 'Nuxt 3', 'Laravel 12', 'Tailwind']
    ]);
});