<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MovieController;
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

Route::get('/', [IndexController::class, 'home'])->name('home');
Route::get('/danh-muc/{slug}', [IndexController::class, 'category'])->name('category');
Route::get('/the-loai/{slug}', [IndexController::class, 'genre'])->name('genre');
Route::get('/quoc-gia/{slug}', [IndexController::class, 'country'])->name('country');
Route::get('/phim/{slug}', [IndexController::class, 'movie'])->name('movie');
Route::get('/xem-phim', [IndexController::class, 'watch'])->name('watch');
Route::get('/episode', [IndexController::class, 'episode'])->name('episode');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('categories', CategoryController::class);
Route::post('resorting_category', [CategoryController::class, 'resorting_category'])->name(('resorting_category'));

Route::resource('genres', GenreController::class);
Route::resource('countries', CountryController::class);
Route::resource('movies', MovieController::class);
Route::resource('episodes', EpisodeController::class);
