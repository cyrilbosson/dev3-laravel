<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\MovieController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('artist', ArtistController::class);

Route::resource('country', CountryController::class);

Route::prefix('movie')->middleware('auth')->group(function () {

    Route::get('actors/{movie}',[MovieController::class, 'actors'])->name('movie.actors');
    Route::post('attach/{movie}',[MovieController::class, 'attach'])->name('movie.attach');
    Route::delete('detach/{movie}/{artist}',[MovieController::class, 'detach'])->name('movie.detach');

});

Route::resource('movie', MovieController::class);

require __DIR__.'/auth.php';
