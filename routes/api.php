<?php

use App\Http\Controllers\AuthorisationController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\EquipmentTrainingController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\CoachTrainingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/coaches', [CoachController::class, 'index']);
Route::get('/coaches/{id}', [CoachController::class, 'show']);

Route::get('/equipments', [EquipmentController::class, 'index']);
Route::get('/equipments/{id}', [EquipmentController::class, 'show']);

Route::get('/trainings', [TrainingController::class, 'index']);
Route::get('/trainings/{id}', [TrainingController::class, 'show']);

Route::resource('coaches.trainings', CoachTrainingController::class)
    ->only(['index']);

Route::resource('equipments.trainings', EquipmentTrainingController::class)
    ->only(['index']);

Route::post('/register', [AuthorisationController::class, 'register']);
Route::post('/login', [AuthorisationController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });

Route::resource('/coaches', CoachController::class)
    ->only(['store', 'update', 'destroy']);

Route::resource('/equipments', EquipmentController::class)
    ->only(['store', 'update', 'destroy']);

Route::resource('/trainings', TrainingController::class)
    ->only(['store', 'update', 'destroy']);

Route::post('/logout', [AuthorisationController::class, 'logout']);

});
