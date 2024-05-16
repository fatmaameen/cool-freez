<?php

use Illuminate\Http\Request;
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
use App\Http\Controllers\Api\Clients\LoadCalculation\SelectedLoadController;
use App\Http\Controllers\Api\Clients\ordersHistory\HistoryController;
use App\Http\Controllers\Shared\LoadCalculations\LoadCalculationController;

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

Route::group(['prefix' => 'clients'], function () {
    Route::post('/register', [clientController::class, 'register']);
    Route::post('/login', [clientController::class, 'login']);
    Route::post('/check-token', [clientController::class, 'tokenValidation']);
    Route::post('/find', [clientController::class, 'searchByMail']);
    Route::post('/check', [clientController::class, 'checkCode']);
    Route::post('/reset', [clientController::class, 'resetPassword']);
    Route::post('/otp', [clientController::class, 'sendOTP']);
});

Route::group(
    [
        'prefix' => 'clients',
        'middleware' => 'auth:sanctum',
    ],
    function () {
        Route::post('/logout/{id}', [clientController::class, 'logout']);
        // profile routes ---------------------------------------------------------------------------------------------------------------
        Route::get('/profile/{id}', [profileController::class, 'show']);
        Route::post('/update/{client}', [profileController::class, 'update']);
        Route::delete('/{client}', [profileController::class, 'destroy']);
        // services route ---------------------------------------------------------------------------------------------------------------
        Route::get('/services', [ServicesController::class, 'index']);
        // brands route -----------------------------------------------------------------------------------------------------------------
        Route::get('/brands/{appLocale}', [BrandsController::class, 'index']);
        // types route ------------------------------------------------------------------------------------------------------------------
        Route::get('/types/{appLocale}', [TypesController::class, 'index']);
        // offers route -----------------------------------------------------------------------------------------------------------------
        Route::get('/offers', [OffersController::class, 'index']);
        // consultant route -------------------------------------------------------------------------------------------------------------
        Route::get('/consultants', [ConsultantsController::class, 'index']);
        // BuildingTypes rout -----------------------------------------------------------------------------------------------------------
        Route::get('/BuildingTypes', [BuildingTypeController::class, 'index']);
        // floors rout ------------------------------------------------------------------------------------------------------------------
        Route::get('/floors/{appLocale}', [floorsController::class, 'index']);
        // usings rout ------------------------------------------------------------------------------------------------------------------
        Route::get('/usings/{appLocale}', [usingsController::class, 'index']);
        // maintenance routs ------------------------------------------------------------------------------------------------------------
        Route::post('/maintenance', [maintenanceController::class, 'store']);
        Route::get('/maintenance/{id}', [maintenanceController::class, 'show']);
        // pricing route ----------------------------------------------------------------------------------------------------------------
        Route::post('/pricing/{client}/{service}', [PricingController::class, 'store']);
        // reviews route ----------------------------------------------------------------------------------------------------------------
        Route::post('/review', [ReviewController::class, 'store']);
        // Customer Service route -------------------------------------------------------------------------------------------------------
        Route::post('/customer-service', [CustomerServiceController::class, 'store']);
        // load calculation route -------------------------------------------------------------------------------------------------------
        Route::post('/load-calculation', [LoadCalculationController::class, 'loadCalculation']);
        // Selected Load route ----------------------------------------------------------------------------------------------------------
        Route::post('/selected-load', [SelectedLoadController::class, 'store']);
        // Order history route ----------------------------------------------------------------------------------------------------------
        Route::get('/history/{id}', [HistoryController::class, 'index']);
    }
);
