<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('users', App\Http\Controllers\UserController::class);

Route::prefix('roles')->group(function () {
    Route::get('/', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
    Route::get('/{role}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/{role}', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
});