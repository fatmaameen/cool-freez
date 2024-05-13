<?php

use App\Http\Controllers\Dashboard\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\Auth\ResetPasswordController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\MainDashboard\Admins\AdminsController;
use App\Http\Controllers\Dashboard\MainDashboard\types\AdminTypesController;
use App\Http\Controllers\Dashboard\MainDashboard\brands\AdminBrandsController;
use App\Http\Controllers\Dashboard\MainDashboard\offers\AdminOffersController;
use App\Http\Controllers\Dashboard\MainDashboard\clients\AdminClientsController;
use App\Http\Controllers\Dashboard\MainDashboard\pricing\AdminPricingController;
use App\Http\Controllers\Dashboard\MainDashboard\Reviews\AdminReviewsController;
use App\Http\Controllers\Dashboard\MainDashboard\cfmRates\AdminCfmRatesController;
use App\Http\Controllers\Dashboard\MainDashboard\DataSheet\AdminDataSheetController;
use App\Http\Controllers\Dashboard\MainDashboard\consultants\AdminConsultantsController;
use App\Http\Controllers\Dashboard\MainDashboard\Maintenance\AdminMaintenanceController;
use App\Http\Controllers\Dashboard\MainDashboard\BuildingTypes\AdminBuildingTypeController;
use App\Http\Controllers\Dashboard\MainDashboard\UsingFloors\AdminUsingFloorDataController;
use App\Http\Controllers\Dashboard\MainDashboard\CustomerService\AdminCustomerServiceController;
use App\Http\Controllers\Dashboard\MainDashboard\LoadCalculation\AdminLoadCalculationsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        // dashboard login ------------------------------------------------------------------------------------------------------------------------------------------------------------------
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login']);
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('/', function () {
            return redirect()->route('login');
        });
        Route::group(['prefix' => 'password'], function () {
            Route::get('/reset', [ForgotPasswordController::class,'showLinkRequestForm'])->name('forgotPassword');
            Route::post('/email', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
            Route::get('/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
            Route::post('/reset', [ResetPasswordController::class,'reset'])->name('password.update');
        });

 Route::get('/profile', [AdminsController::class, 'profile'])->name('profile');



        // SuperAdmin Admins routs ----------------------------------------------------------------------------------------------------------------------------------------------------------
        Route::group(['prefix' => 'dash/admins', 'middleware' => ['auth', 'SuperAdmin']], function () {
            Route::get('/', [AdminsController::class, 'index'])->name('users.user_list');
            // Route::get('/{id}', [userController::class, 'show'])->middleware('Admin');
            Route::post('/store', [AdminsController::class, 'store'])->name('users.store');
            Route::post('/update/{id}', [AdminsController::class, 'update'])->name('users.update');
            Route::post('/updateRole/{admin}', [AdminsController::class, 'updateRole']);
            Route::delete('/{admin}', [AdminsController::class, 'destroy'])->name('users.delete');
        });

        Route::group(
            [
                'prefix' => 'main-dashboard',
                // 'middleware' => ['auth', 'Admin']
            ],
            function () {
                // dashboard home page -------------------------------------------------------------------------------------------------------------------------------------------------------
                Route::get('/', function (){
                    return view('MainDashboard.dashboard');
                })->name('dashboard');
                // Admin clients routes ------------------------------------------------------------------------------------------------------------------------------------------------------
                Route::group(['prefix' => 'clients'], function () {
                    Route::get('/', [AdminClientsController::class, 'index'])->name('clients');
                    Route::post('/{id}', [AdminClientsController::class, 'update'])->name('clients.update');
                    Route::post('/banned/{client}', [AdminClientsController::class, 'banned'])->name('clients.assign');
                    Route::delete('/{client}', [AdminClientsController::class, 'destroy'])->name('clients.delete');
                    Route::post('/search', [AdminClientsController::class, 'search']);
                });
                Route::get('history/{id}', [AdminClientsController::class, 'history'])->name('clients.history');

                // Admin maintenance routes --------------------------------------------------------------------------------------------------------------------------------------------------
                Route::group(['prefix' => 'maintenance'], function () {
                    Route::get('/', [AdminMaintenanceController::class, 'index'])->name('maintenance');
                    Route::post('/{maintenance}', [AdminMaintenanceController::class, 'update'])->name('maintenance.update');
                    Route::post('/assign/{maintenance}', [AdminMaintenanceController::class, 'assign'])->name('maintenance.assign');
                    Route::delete('/{maintenance}', [AdminMaintenanceController::class, 'destroy'])->name('maintenance.delete');
                });
                // Admin pricing routes ------------------------------------------------------------------------------------------------------------------------------------------------------
                Route::group([
                    'prefix' => 'pricing'
                ], function () {
                    Route::get('/', [AdminPricingController::class, 'index'])->name('pricing.pricing');
                    Route::post('/{pricing}', [AdminPricingController::class, 'update'])->name('pricing.update');
                    Route::delete('/{pricing}', [AdminPricingController::class, 'destroy'])->name('pricing.destroy');
                    Route::get('/{id}', [AdminPricingController::class, 'show'])->name('pricing.show');
                });
                // Admin reviews routes -------------------------------------------------------------------------------------------------------------------------------------------------------
                Route::group([
                    'prefix' => 'reviews'
                ], function () {
                    Route::get('/', [AdminReviewsController::class, 'index'])->name('reviews.reviews');
                    Route::post('/{review}', [AdminReviewsController::class, 'update'])->name('reviews.update');
                    Route::delete('/{review}', [AdminReviewsController::class, 'destroy'])->name('reviews.destroy');
                    Route::get('/{id}', [AdminReviewsController::class, 'show_details'])->name('details');
                });
                // Admin consultants routes ---------------------------------------------------------------------------------------------------------------------------------------------------
                Route::group([
                    'prefix' => 'consultant'
                ], function () {
                    Route::get('/', [AdminConsultantsController::class, 'index'])->name('consultant.consultant');
                    Route::post('/', [AdminConsultantsController::class, 'store'])->name('consultant.store');
                    Route::post('/{consultant}', [AdminConsultantsController::class, 'update'])->name('consultant.update');
                    Route::delete('/{consultant}', [AdminConsultantsController::class, 'destroy'])->name('consultant.delete');
                });
                // Admin customer-service routes ----------------------------------------------------------------------------------------------------------------------------------------------
                Route::group([
                    'prefix' => 'customer-service'
                ], function () {
                    Route::get('/', [AdminCustomerServiceController::class, 'index'])->name('customer_service.customer_service');
                    Route::post('/{message}', [AdminCustomerServiceController::class, 'update'])->name('customer_service.update');
                    Route::delete('/{message}', [AdminCustomerServiceController::class, 'destroy'])->name('customer_sevices.delete');
                    Route::post('/reply/{message}', [AdminCustomerServiceController::class, 'sendEmail'])->name('customer_sevices.sendemail');
                });
                // Admin offers routes -------------------------------------------------------------------------------------------------------------------------------------------------------------
                Route::group([
                    'prefix' => 'offer'
                ], function () {
                    Route::get('/', [AdminOffersController::class, 'index'])->name('offer.offer');
                    Route::post('/', [AdminOffersController::class, 'store'])->name('offer.store');
                    Route::post('/{offer}', [AdminOffersController::class, 'update'])->name('offer.update');
                    Route::delete('/{offer}', [AdminOffersController::class, 'destroy'])->name('offer.delete');
                });
                // Admin brands routes --------------------------------------------------------------------------------------------------------------------------------------------------------------
                Route::group([
                    'prefix' => 'brands'
                ], function () {
                    Route::get('/', [AdminBrandsController::class, 'index'])->name('brands.brands');
                    Route::post('/', [AdminBrandsController::class, 'store'])->name('brands.store');
                    Route::post('/{brand}', [AdminBrandsController::class, 'update'])->name('brands.update');
                    Route::delete('/{brand}', [AdminBrandsController::class, 'destroy'])->name('brands.delete');
                });
                // Admin types routes --------------------------------------------------------------------------------------------------------------------------------------------------------------
                Route::group([
                    'prefix' => 'types'
                ], function () {
                    Route::get('/', [AdminTypesController::class, 'index'])->name('types.types');
                    Route::post('/', [AdminTypesController::class, 'store'])->name('types.store');
                    Route::post('/{type}', [AdminTypesController::class, 'update'])->name('types.update');
                    Route::delete('/{type}', [AdminTypesController::class, 'destroy'])->name('types.delete');
                });
                // Admin building types routes --------------------------------------------------------------------------------------------------------------------------------------------------------
                Route::group([
                    'prefix' => 'buildingTypes'
                ], function () {
                    Route::get('/', [AdminBuildingTypeController::class, 'index'])->name('buildingTypes.buildingTypes');
                    Route::post('/', [AdminBuildingTypeController::class, 'store'])->name('buildingTypes.store');
                    Route::post('/{BuildingType}', [AdminBuildingTypeController::class, 'update'])->name('buildingTypes.update');
                    Route::delete('/{BuildingType}', [AdminBuildingTypeController::class, 'destroy'])->name('buildingTypes.delete');
                });
                // Admin cfmRates routes --------------------------------------------------------------------------------------------------------------------------------------------------------------
                Route::group([
                    'prefix' => 'cfmRates'
                ], function () {
                    Route::get('/', [AdminCfmRatesController::class, 'index'])->name('cfmRates');
                    Route::post('/{rate}', [AdminCfmRatesController::class, 'update'])->name('cfmRates.update');
                });
                // Admin UsingFloors routes -----------------------------------------------------------------------------------------------------------------------------------------------------------
                Route::group([
                    'prefix' => 'usingFloors'
                ], function () {
                    Route::get('/', [AdminUsingFloorDataController::class, 'index'])->name('usingFloors');
                    Route::post('/', [AdminUsingFloorDataController::class, 'store'])->name('usingFloors.store');
                    Route::get('/download', [AdminUsingFloorDataController::class, 'downloadFile'])->name('usingFloors.download');
                });
                // Admin data sheet routes -------------------------------------------------------------------------------------------------------------------------------------------------------------
                Route::group([
                    'prefix' => 'dataSheet'
                ], function () {
                    Route::get('/', [AdminDataSheetController::class, 'index'])->name('dataSheet');
                    Route::post('/', [AdminDataSheetController::class, 'store'])->name('dataSheet.store');
                    Route::get('/download', [AdminDataSheetController::class, 'downloadFile'])->name('dataSheet.download');
                    Route::post('/search', [AdminDataSheetController::class, 'search'])->name('dataSheet.search');
                });
                // Admin load calculation routes -------------------------------------------------------------------------------------------------------------------------------------------------------------
                Route::group([
                    'prefix' => 'loadCalculation'
                ], function () {
                    Route::get('/', [AdminLoadCalculationsController::class, 'index'])->name('loadCalculation');
                    Route::get('/{id}', [AdminLoadCalculationsController::class, 'show'])->name('loadCalculation.show');
                    Route::post('/{load}', [AdminLoadCalculationsController::class, 'update'])->name('loadCalculation.update');
                    Route::delete('/{load}', [AdminLoadCalculationsController::class, 'destroy'])->name('loadCalculation.destroy');
                    Route::post('/search', [AdminLoadCalculationsController::class, 'search']);
                });


            }
        );
    }
);
