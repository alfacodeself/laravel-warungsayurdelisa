<?php

use App\Http\Controllers\Landingpage\HomeController;
use Illuminate\Support\Facades\Route;

Route::as('landingpage.')->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('{type}/products', [HomeController::class, 'show'])->name('show');
});