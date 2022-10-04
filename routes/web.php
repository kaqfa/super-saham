<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Posts;
use App\Http\Controllers\SahamController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/saham', [SahamController::class, 'show_price']);
Route::get('/saham/{symbol}', [SahamController::class, 'index']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/post', function () {
        return view('dash-post');
    })->name('dash-post');
});
