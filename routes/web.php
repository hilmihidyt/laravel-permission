<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('users', App\Http\Controllers\UserController::class);
    
    Route::prefix('roles')->group(function () {
        Route::get('/', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index')->middleware('can:role table');
        Route::get('/{role}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit')->middleware('can:edit role');
        Route::put('/{role}', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update')->middleware('can:edit role');
    });
});