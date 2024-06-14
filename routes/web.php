<?php

use App\Http\Controllers\OrderController;

Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');

