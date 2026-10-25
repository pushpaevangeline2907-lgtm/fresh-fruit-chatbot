<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BotController;
use App\Http\Controllers\FruitController;

Route::get('/', function () {
    return redirect()->route('bot.index');
});

Route::get('/bot', [BotController::class, 'index'])
    ->name('bot.index');

Route::post('/bot/chat', [BotController::class, 'chat'])
    ->name('bot.chat');

Route::get('/fruits', [FruitController::class, 'index'])
    ->name('fruits.index');

Route::get('/fruits/create', [FruitController::class, 'create'])
    ->name('fruits.create');

Route::post('/fruits', [FruitController::class, 'store'])
    ->name('fruits.store');

Route::get('/fruits/{fruit}/edit', [FruitController::class, 'edit'])
    ->name('fruits.edit');

Route::put('/fruits/{fruit}', [FruitController::class, 'update'])
    ->name('fruits.update');

Route::delete('/fruits/{fruit}', [FruitController::class, 'destroy'])
    ->name('fruits.destroy');
