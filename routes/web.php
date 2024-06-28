<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get("/", [TaskController::class, 'index'])->name('index');
Route::post("/register", [TaskController::class, 'register'])->name('register');

Route::get("/link/{link:slug}/{gambler}", [TaskController::class, 'show'])->name('show');
Route::get('/generate/{gamblerId}', [TaskController::class, 'generate'])->name('generate');
Route::get('/deactivate/{slug}', [TaskController::class, 'deactivate'])->name('deactivate');

Route::get('/get-lucky/{gamblerId}', [TaskController::class, 'game'])->name('game');
Route::get('/history/{gamblerId}', [TaskController::class, 'history'])->name('history');


