<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Routes API pour les véhicules
Route::prefix('vehicules')->group(function () {
    Route::get('/', [VehiculeController::class, 'index']);
    Route::post('/', [VehiculeController::class, 'store']);
    Route::get('/{id}', [VehiculeController::class, 'show']);
    Route::put('/{id}', [VehiculeController::class, 'update']);
    Route::delete('/{id}', [VehiculeController::class, 'destroy']);
});