<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clients\Auth\clientController;
use App\Http\Controllers\Clients\brands\BrandsController;
use App\Http\Controllers\Clients\Reviews\ReviewController;
use App\Http\Controllers\Clients\Profile\profileController;
use App\Http\Controllers\Clients\services\ServicesController;
use App\Http\Controllers\Clients\Consultants\ConsultantsController;
use App\Http\Controllers\Clients\Maintenance\maintenanceController;
use App\Http\Controllers\Clients\offers\OffersController;
use App\Http\Controllers\Clients\types\TypesController;
use App\Http\Controllers\MainDashboard\offers\AdminOffersController;
use App\Http\Controllers\Technicians\Maintenance\TechnicianMaintenanceController;
use App\Models\Client;

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

Route::post('/clients/register', [clientController::class, 'register']);

Route::post('/clients/login', [clientController::class, 'login']);

Route::post('/clients/check-token', [clientController::class, 'tokenValidation']);

Route::post('/clients/logout/{id}', [clientController::class, 'logout'])
    // ->middleware('auth:sanctum')
;

Route::post('/clients/find', [clientController::class, 'searchByMail']);
Route::post('/clients/check', [clientController::class, 'checkCode']);
Route::post('/clients/reset', [clientController::class, 'resetPassword']);
Route::post('/clients/otp', [clientController::class, 'sendOTP']);

Route::group(['prefix' => 'clients',
// 'middleware' => 'auth:sanctum'
],
 function () {
    Route::get('/profile/{id}', [profileController::class, 'show']);
    Route::post('/update/{client}', [profileController::class, 'update']);
    Route::delete('/{client}', [profileController::class, 'destroy']);
});


Route::post('/clients/maintenance', [maintenanceController::class, 'store'])
    ->middleware('auth:sanctum')
;

Route::get('/clients/maintenance/{id}', [maintenanceController::class, 'show'])
    ->middleware('auth:sanctum')
;


// Technician Api --------------------------------------------------------------
Route::get('/technician/maintenance/{id}', [TechnicianMaintenanceController::class, 'index'])
    // ->middleware('auth:sanctum')
;

Route::post('/technician/maintenance/{$maintenance}', [TechnicianMaintenanceController::class, 'update'])
    // ->middleware('auth:sanctum')
;


// services ---------------------------------------------------------------------
Route::get('/services', [ServicesController::class, 'index'])
    // ->middleware('auth:sanctum')
;

// brands ----------------------------------------------------------------------
Route::get('/brands', [BrandsController::class, 'index'])
    // ->middleware('auth:sanctum')
;

// types ----------------------------------------------------------------------
Route::get('/types', [TypesController::class, 'index'])
    // ->middleware('auth:sanctum')
;

// offers -----------------------------------------------------------------------
Route::get('/offers', [OffersController::class, 'index'])
    // ->middleware('auth:sanctum')
;

// consultants -------------------------------------------------------------------
Route::get('/consultants', [ConsultantsController::class, 'index'])
    // ->middleware('auth:sanctum')
;

// reviews -----------------------------------------------------------------------
Route::post('/clients/review', [ReviewController::class, 'store'])
    // ->middleware('auth:sanctum')
;


