<?php

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Clients\Auth\clientController;
use App\Http\Controllers\Api\Clients\types\TypesController;
use App\Http\Controllers\Api\Clients\brands\BrandsController;
use App\Http\Controllers\Api\Clients\floors\floorsController;
use App\Http\Controllers\Api\Clients\offers\OffersController;
use App\Http\Controllers\Api\Clients\usings\usingsController;
use App\Http\Controllers\Api\Clients\Reviews\ReviewController;
use App\Http\Controllers\Api\Clients\pricing\PricingController;
use App\Http\Controllers\Api\Clients\Profile\profileController;
use App\Http\Controllers\Api\Clients\services\ServicesController;
use App\Http\Controllers\Api\Clients\Consultants\ConsultantsController;
use App\Http\Controllers\Api\Clients\Maintenance\maintenanceController;
use App\Http\Controllers\Api\Clients\BuildingTypes\BuildingTypeController;
use App\Http\Controllers\Api\Clients\CustomerService\CustomerServiceController;
use App\Http\Controllers\Api\Technicians\Auth\AuthTechnicianController;
use App\Http\Controllers\Api\Technicians\Maintenance\TechnicianMaintenanceController;

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

// services ---------------------------------------------------------------------
Route::get('/clients/services', [ServicesController::class, 'index'])
    // ->middleware('auth:sanctum')
;

// brands ----------------------------------------------------------------------
Route::get('/clients/brands', [BrandsController::class, 'index'])
    // ->middleware('auth:sanctum')
;

// types ----------------------------------------------------------------------
Route::get('/clients/types', [TypesController::class, 'index'])
    // ->middleware('auth:sanctum')
;

// offers -----------------------------------------------------------------------
Route::get('/clients/offers', [OffersController::class, 'index'])
    // ->middleware('auth:sanctum')
;

// consultants -------------------------------------------------------------------
Route::get('/clients/consultants', [ConsultantsController::class, 'index'])
    // ->middleware('auth:sanctum')
;

// reviews -----------------------------------------------------------------------
Route::post('/clients/review', [ReviewController::class, 'store'])
    // ->middleware('auth:sanctum')
;

// BuildingTypes -----------------------------------------------------------------------
Route::get('/clients/BuildingTypes', [BuildingTypeController::class, 'index'])
    // ->middleware('auth:sanctum')
;

// floors -----------------------------------------------------------------------
Route::get('/clients/floors', [floorsController::class, 'index'])
    // ->middleware('auth:sanctum')
;

// usings -----------------------------------------------------------------------
Route::get('/clients/usings', [usingsController::class, 'index'])
    // ->middleware('auth:sanctum')
;

// pricing -----------------------------------------------------------------------
Route::post('/clients/pricing/{client}/{service}', [PricingController::class, 'store'])
    // ->middleware('auth:sanctum')
;

// Customer Service ---------------------------------------------------------------
Route::post('/clients/customer-service', [CustomerServiceController::class, 'store'])
    // ->middleware('auth:sanctum')
;

// Technicians App -----------------------------------------------------------------

Route::post('/technicians/login', [AuthTechnicianController::class, 'login']);

Route::post('/technicians/check-token', [AuthTechnicianController::class, 'tokenValidation']);

Route::post('/technicians/logout/{technician}', [AuthTechnicianController::class, 'logout'])
    // ->middleware('auth:sanctum')
;

// Technician all maintenance --------------------------------------------------------------
Route::get('/technicians/maintenance/{id}', [TechnicianMaintenanceController::class, 'index'])
    // ->middleware('auth:sanctum')
;

// Technician update maintenance --------------------------------------------------------------
Route::post('/technicians/maintenance/{$maintenance}', [TechnicianMaintenanceController::class, 'update'])
    // ->middleware('auth:sanctum')
;
