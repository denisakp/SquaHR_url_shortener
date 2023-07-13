<?php

use App\Http\Controllers\ShortenerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ShortenerController::class, 'index'])->name('shortener.app');
Route::get('/{code}', [ShortenerController::class, 'show'])->name('shortener.show');
Route::post('/shortener', [ShortenerController::class, 'store'])->name('shortener.store');
