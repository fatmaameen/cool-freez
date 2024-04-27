<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Technicians\Auth\AuthTechnicianController;
use App\Http\Controllers\Api\Technicians\Maintenance\TechnicianMaintenanceController;
use App\Http\Controllers\Api\Technicians\Profile\TechnicianProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Technicians App -----------------------------------------------------------------------------------------------------------------------------
Route::post('/technicians/login', [AuthTechnicianController::class, 'login']);
Route::post('/technicians/check-token', [AuthTechnicianController::class, 'tokenValidation']);


Route::group([
    'prefix' => 'technicians',
    'middleware' => 'auth:sanctum'
], function () {
    Route::post('/logout/{technician}', [AuthTechnicianController::class, 'logout']);
    // Technician info route---------------------------------------------------------------------------------------------------------------------
    Route::get('/profile/{technician}', [TechnicianProfileController::class,'show']);
    // Technician update route-------------------------------------------------------------------------------------------------------------------
    Route::post('/update/{technician}', [TechnicianProfileController::class, 'update']);
    // Technician all maintenance route----------------------------------------------------------------------------------------------------------
    Route::get('/maintenance/{id}', [TechnicianMaintenanceController::class, 'index']);
    // Technician update maintenance route-------------------------------------------------------------------------------------------------------
    Route::post('/maintenance/{$maintenance}', [TechnicianMaintenanceController::class, 'update']);
});
