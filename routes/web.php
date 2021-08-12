<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/fix-my-device', [HomeController::class, 'fixMyDevice'])->name('fix-my-device');
Route::post('/fix-my-device', [HomeController::class, 'fixDevice']);

Route::get('/track-device', [HomeController::class, 'trackDevice'])->name('track-device');
Route::post('/track-device', [HomeController::class, 'findDevice']);

Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/help', [HomeController::class, 'help'])->name('help');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
