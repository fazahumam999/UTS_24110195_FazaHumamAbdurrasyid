<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TamuController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/tamu', [TamuController::class, 'tamu'])->name('tamu');

Route::get('/tamu/create', [TamuController::class, 'create'])->name('create');

Route::post('tamu', [TamuController::class, 'store'])->name('store');

Route::get('/tamu/{id}/edit', [TamuController::class, 'edit'])->name('edit');

Route::put('/tamu/{id}', [TamuController::class, 'update'])->name('update');

Route::delete('/tamu/{id}',[TamuController::class, 'destroy'])->name('destroy');


