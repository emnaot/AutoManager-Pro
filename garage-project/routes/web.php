<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculeController;

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

// Routes web pour les véhicules
Route::prefix('vehicules')->group(function () {
    Route::get('/liste', [VehiculeController::class, 'liste'])->name('vehicules.liste');
    Route::get('/create', [VehiculeController::class, 'create'])->name('vehicules.create');
    Route::get('/{id}/details', [VehiculeController::class, 'showDetails'])->name('vehicules.show');
    Route::get('/{id}/edit', [VehiculeController::class, 'edit'])->name('vehicules.edit');
});