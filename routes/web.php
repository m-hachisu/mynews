<?php

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

use App\Http\Controllers\Admin\NewsController;
Route::controller(NewsController::class)->prefix('admin')->group(function() {
    Route::get('news/create', 'add')->middleware('auth');
});

//【PHP_Laravel】04_課題3

/*ここから
use App\Http\Controllers\Admin\AAAController;
Route::controller(AAAController::class)->group(function() {
    Route::get('XXX', 'bbb');
});
ここまで*/

//【PHP_Laravel】04_課題4 --07_課題2_追記

use App\Http\Controllers\Admin\ProfileController;
Route::controller(ProfileController::class)->group(function() {
    Route::get('admin/profile/create', 'add')->middleware('auth');
    Route::get('admin/profile/edit', 'edit')->middleware('auth');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
