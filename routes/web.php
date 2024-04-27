<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Auth\LoginController;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\MainDashboard\clients\AdminClientsController;
use App\Http\Controllers\Dashboard\MainDashboard\Maintenance\AdminMaintenanceController;
use App\Http\Controllers\Dashboard\CompanyDashboard\Maintenance\CompanyMaintenanceController;
use App\Http\Controllers\Dashboard\CompanyDashboard\Technicians\AdminTechnicianController;
use App\Http\Controllers\Dashboard\MainDashboard\Admins\AdminsController;
use App\Http\Controllers\Dashboard\MainDashboard\brands\AdminBrandsController;
use App\Http\Controllers\Dashboard\MainDashboard\BuildingTypes\AdminBuildingTypeController;
use App\Http\Controllers\Dashboard\MainDashboard\consultants\AdminConsultantsController;
use App\Http\Controllers\Dashboard\MainDashboard\CustomerService\AdminCustomerServiceController;
use App\Http\Controllers\Dashboard\MainDashboard\floors\AdminFloorsController;
use App\Http\Controllers\Dashboard\MainDashboard\offers\AdminOffersController;
use App\Http\Controllers\Dashboard\MainDashboard\pricing\AdminPricingController;
use App\Http\Controllers\Dashboard\MainDashboard\Reviews\AdminReviewsController;
use App\Http\Controllers\Dashboard\MainDashboard\types\AdminTypesController;
use App\Http\Controllers\Dashboard\MainDashboard\usings\AdminUsingsController;
use Illuminate\Support\Facades\File as FacadesFile;

require __DIR__.'/Dashboard/MainDashboard/web.php';
require __DIR__.'/Dashboard/CompanyDashboard/web.php';
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

// Route::group(
//     [
//         'prefix' => LaravelLocalization::setLocale(),
//         'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
//     ],
//     function () {
//         Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
//         Route::post('/login', [LoginController::class, 'login']);
//         Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
//         Route::get('/', function () {
//             return redirect()->route('login');
//         });
//         // Route::get('/register', function () {
//         //     return redirect()->route('login');
//         // });

//         // Auth::routes();
//         // Auth::routes(['register' => false]);

//         Route::get('/dashboard', [App\Http\Controllers\Dashboard\Auth\HomeController::class, 'index'])->name('dashboard');



//         Route::group(['prefix' => 'admins', 'middleware' => 'auth'], function () {
//             Route::get('/', [AdminsController::class, 'index'])->middleware('SuperAdmin');
//             // Route::get('/{id}', [userController::class, 'show'])->middleware('Admin');
//             Route::post('/store', [AdminsController::class, 'store'])->middleware('SuperAdmin')->name('users.store');
//             Route::post('/update/{id}', [AdminsController::class, 'update'])->middleware('Admin')->name('users.update');
//             Route::post('/updateRole/{admin}', [AdminsController::class, 'updateRole'])->middleware('SuperAdmin');
//             Route::delete('/{admin}', [AdminsController::class, 'destroy'])->middleware('SuperAdmin')->name('users.delete');
//         });




//         Route::group(['prefix' => 'clients', 'middleware' => ['auth', 'Admin']], function () {
//             Route::get('/', [AdminClientsController::class, 'index'])->name('clients');
//             Route::post('/{id}', [AdminClientsController::class, 'update'])->name('clients.update');
//             Route::delete('/{client}', [AdminClientsController::class, 'destroy']);
//             Route::post('/search', [AdminClientsController::class, 'search']);
//         });


//         Route::post('/client/assign/{client}', [AdminClientsController::class, 'assign'])->name('clients.assign')
//             // ->middleware('Admin')
//         ;
//         Route::get('/maintenance', [AdminMaintenanceController::class, 'index'])->name('maintenance')
//             //->middleware('Admin')
//         ;

//         Route::post('/maintenance/{maintenance}', [AdminMaintenanceController::class, 'update'])->name('maintenance.update')
//             // ->middleware('Admin')
//         ;

//         Route::post('/maintenance/assign/{maintenance}', [AdminMaintenanceController::class, 'assign'])->name('maintenance.assign')
//             // ->middleware('Admin')
//         ;

        Route::delete('/maintenance/{maintenance}', [AdminMaintenanceController::class, 'destroy'])->name('maintenance.delete');

            // ->middleware('Admin')
        ;
//         Route::delete('/maintenance/{maintenance}', [AdminMaintenanceController::class, 'destroy'])->name('maintenance.delete');

//             // ->middleware('Admin')
//         ;


//         // Company routes -------------------------------------------------------------------------
//         Route::get('/company/maintenance', [CompanyMaintenanceController::class, 'index'])->name('incomplete_maintenance')
//             // ->middleware('CompanyAdmin')
//         ;

//         Route::get('/company/maintenance/completed', [CompanyMaintenanceController::class, 'completed'])->name('complete_maintenance')
//             // ->middleware('CompanyAdmin')
//         ;

//         Route::post('/company/maintenance/{maintenance}', [CompanyMaintenanceController::class, 'update'])->name('company_maintenance.update');
//             // ->middleware('CompanyAdmin')
//         ;

//         // Auth::routes();

//         // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//         // brands routes -------------------------------------------------------------------------
//         Route::group([
//             'prefix' => 'brands'
//             // ,'middleware' => ['auth', 'Admin']
//         ], function () {
//             Route::get('/', [AdminBrandsController::class, 'index'])->name('brands.brands');
//             Route::post('/', [AdminBrandsController::class, 'store'])->name('brands.store');
//             Route::post('/{brand}', [AdminBrandsController::class, 'update'])->name('brands.update');
//             Route::delete('/{brand}', [AdminBrandsController::class, 'destroy'])->name('brands.delete');
//         });
//         // brands routes -------------------------------------------------------------------------
//         Route::group([
//             'prefix' => 'types'
//             // ,'middleware' => ['auth', 'Admin']
//         ], function () {
//             Route::get('/', [AdminTypesController::class, 'index'])->name('types.types');
//             Route::post('/', [AdminTypesController::class, 'store'])->name('types.store');
//             Route::post('/{type}', [AdminTypesController::class, 'update'])->name('types.update');
//             Route::delete('/{type}', [AdminTypesController::class, 'destroy'])->name('types.delete');
//         });
// // floors routes -------------------------------------------------------------------------
// Route::group([
//     'prefix' => 'floors'
//     // ,'middleware' => ['auth', 'Admin']
// ], function () {
//     Route::get('/', [AdminFloorsController::class, 'index'])->name('floors.floors');
//     Route::post('/', [AdminFloorsController::class, 'store'])->name('floors.store');
//     Route::post('/{floor}', [AdminFloorsController::class, 'update'])->name('floors.update');
//     Route::delete('/{floor}', [AdminFloorsController::class, 'destroy'])->name('floors.delete');
// });

// // usings routes -------------------------------------------------------------------------
// Route::group([
//     'prefix' => 'usings'
//     // ,'middleware' => ['auth', 'Admin']
// ], function () {
//     Route::get('/', [AdminUsingsController::class, 'index'])->name('usings.usings');
//     Route::post('/', [AdminUsingsController::class, 'store'])->name('usings.store');
//     Route::post('/{using}', [AdminUsingsController::class, 'update'])->name('usings.update');
//     Route::delete('/{using}', [AdminUsingsController::class, 'destroy'])->name('usings.delete');
// });

// // buildingTypes routes -------------------------------------------------------------------------
// Route::group([
//     'prefix' => 'buildingTypes'
//     // ,'middleware' => ['auth', 'Admin']
// ], function () {
//     Route::get('/', [AdminBuildingTypeController::class, 'index'])->name('buildingTypes.buildingTypes');
//     Route::post('/', [AdminBuildingTypeController::class, 'store'])->name('buildingTypes.store');
//     Route::post('/{BuildingType}', [AdminBuildingTypeController::class, 'update'])->name('buildingTypes.update');
//     Route::delete('/{BuildingType}', [AdminBuildingTypeController::class, 'destroy'])->name('buildingTypes.delete');
// });
//         // offers routes -------------------------------------------------------------------------
//         Route::group([
//             'prefix' => 'offer'
//             // ,'middleware' => ['auth', 'Admin']
//         ], function () {
//             Route::get('/', [AdminOffersController::class, 'index'])->name('offer.offer');
//             Route::post('/', [AdminOffersController::class, 'store'])->name('offer.store');
//             Route::post('/{offer}', [AdminOffersController::class, 'update'])->name('offer.update');
//             Route::delete('/{offer}', [AdminOffersController::class, 'destroy'])->name('offer.delete');
//         });

//         // consultants routes -------------------------------------------------------------------------
//         Route::group([
//             'prefix' => 'consultant'
//             // ,'middleware' => ['auth', 'Admin']
//         ], function () {
//             Route::get('/', [AdminConsultantsController::class, 'index'])->name('consultant.consultant');
//             Route::post('/', [AdminConsultantsController::class, 'store'])->name('consultant.store');
//             Route::post('/{consultant}', [AdminConsultantsController::class, 'update'])->name('consultant.update');
//             Route::delete('/{consultant}', [AdminConsultantsController::class, 'destroy'])->name('consultant.delete');
//         });


//         // reviews routes -------------------------------------------------------------------------
//         Route::group([
//             'prefix' => 'reviews'
//             // ,'middleware' => ['auth', 'Admin']
//         ], function () {
//             Route::get('/', [AdminReviewsController::class, 'index'])->name('reviews.reviews');
//             Route::post('/{review}', [AdminReviewsController::class, 'update'])->name('reviews.update');
//             Route::delete('/{review}', [AdminReviewsController::class, 'destroy'])->name('reviews.destroy');
//             Route::get('/{id}', [AdminReviewsController::class, 'show_details'])->name('details');
//         });




// // pricing routes -------------------------------------------------------------------------
// Route::group([
//     'prefix' => 'pricing'
//     // ,'middleware' => ['auth', 'Admin']
// ], function () {
//     Route::get('/', [AdminPricingController::class, 'index'])->name('pricing.pricing');
//     Route::post('/{pricing}', [AdminPricingController::class, 'update'])->name('pricing.update');
//     Route::delete('/{pricing}', [AdminPricingController::class, 'destroy'])->name('pricing.destroy');
//     Route::get('/{id}', [AdminPricingController::class, 'show'])->name('pricing.show');
// });


//         // reviews routes -------------------------------------------------------------------------
//         Route::group([
//             'prefix' => 'customer-service'
//             // ,'middleware' => ['auth', 'Admin']
//         ], function () {
//             Route::get('/', [AdminCustomerServiceController::class, 'index'])                    ->name('customer_service.customer_service');
//             Route::post('/{message}', [AdminCustomerServiceController::class, 'update'])         ->name('customer_service.update');
//             Route::delete('/{message}', [AdminCustomerServiceController::class, 'destroy'])      ->name('customer_sevices.delete');
//             Route::post('/reply/{message}', [AdminCustomerServiceController::class, 'sendEmail'])->name('customer_sevices.sendemail');
//         });



//         // reviews routes -------------------------------------------------------------------------
//         Route::group([
//             'prefix' => 'technician'
//             // ,'middleware' => ['auth', 'Admin']
//         ], function () {
//             Route::get('/', [AdminTechnicianController::class, 'index']);
//             Route::post('/', [AdminTechnicianController::class, 'store']);
//             Route::post('/{technician}', [AdminTechnicianController::class, 'update']);
//             Route::delete('/{technician}', [AdminTechnicianController::class, 'destroy']);
//             Route::post('/search', [AdminTechnicianController::class,'search']);
//         });



























//         // //route to show clients images -------------------------------------------------------------
//         // Route::get('/{filename}', function ($filename) {
//         //     $path = storage_path('../public/' . $filename);
//         //     if (!FacadesFile::exists($path)) {
//         //         abort(404);
//         //     }
//         //     return response()->file($path);
//         // });
//         // //route to show consultant images -------------------------------------------------------------
//         // Route::get('/{filename}', function ($filename) {
//         //     $path = storage_path('../public/' . $filename);
//         //     if (!FacadesFile::exists($path)) {
//         //         abort(404);
//         //     }
//         //     return response()->file($path);
//         // });

//         // //route to show offers images----------------------------------------------------------------
//         // Route::get('/{filename}', function ($filename) {
//         //     $path = storage_path('../public/' . $filename);
//         //     if (!FacadesFile::exists($path)) {
//         //         abort(404);
//         //     }
//         //     return response()->file($path);
//         // });

//         // route to show admins images----------------------------------------------------------------



// //  Route::get('/{filename}', function ($filename) {
// //             $path = storage_path('../public/' . $filename);
// //             if (!FacadesFile::exists($path)) {
// //                 abort(404);
// //             }
// //             return response()->file($path);
// //         });


//     }
// );

