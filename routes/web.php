<?php

use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('main');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/choose-game', [App\Http\Controllers\HomeController::class, 'chooseGame'])->name('choose-game');
Route::get('/sectors/{gameId}', [GameController::class, 'sectors'])->name('sectors');
Route::get('/sectors/user-form/{gameId}/{sectorId}', [GameController::class, 'userForm'])->name('sectors.user-form');
Route::post('/sectors/user-form/{gameId}/{sectorId}', [GameController::class, 'userFormSubmit'])->name('sectors.user-form.submit');
Route::post('/sectors/submit/{gameId}/{sectorId}', [GameController::class, 'submit'])->name('sectors.submit.submit');
Route::get('/result/{gameId}/{sectorId}', [GameController::class, 'result'])->name('game.result');
