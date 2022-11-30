<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaketController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/home_admin', [HomeController::class, 'index'])->name('home-admin');
    Route::get('/paket', [PaketController::class, 'index'])->name('list-paket');
});

Route::group(['middleware' => ['role:user']], function () {
    Route::get('/home_user', [HomeController::class, 'index_user'])->name('home-user');
});
