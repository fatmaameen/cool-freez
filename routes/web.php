<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MainDashboard\users\userController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\MainDashboard\clients\AdminClientsController;
use App\Http\Controllers\MainDashboard\Maintenance\AdminMaintenanceController;
use App\Http\Controllers\CompanyDashboard\Maintenance\CompanyMaintenanceController;
use App\Http\Controllers\MainDashboard\brands\AdminBrandsController;
use App\Http\Controllers\MainDashboard\consultants\AdminConsultantsController;
use App\Http\Controllers\MainDashboard\offers\AdminOffersController;
use App\Http\Controllers\MainDashboard\types\AdminTypesController;
use Illuminate\Support\Facades\File as FacadesFile;

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

        Route::get('/', function () {
            return redirect()->route('login');
        });

        Route::get('/register', function () {
            return redirect()->route('login');
        });


        Auth::routes(['register' => false]);

        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');



        Route::group(['prefix' => 'users', 'middleware' => 'auth'], function () {
            Route::get('/', [userController::class, 'index'])->middleware('SuperAdmin');
            // Route::get('/{id}', [userController::class, 'show'])->middleware('Admin');
            Route::post('/store', [userController::class, 'store'])->middleware('SuperAdmin')->name('users.store');
            Route::post('/update/{id}', [userController::class, 'update'])->middleware('Admin')->name('users.update');
            Route::post('/updateRole/{user}', [userController::class, 'updateRole'])->middleware('SuperAdmin');
            Route::delete('/{id}', [userController::class, 'destroy'])->middleware('SuperAdmin')->name('users.delete');
        });




        Route::group(['prefix' => 'clients', 'middleware' => ['auth', 'Admin']], function () {
            Route::get('/', [AdminClientsController::class, 'index'])->name('clients');
            Route::post('/{id}', [AdminClientsController::class, 'update'])->name('clients.update');
            Route::delete('/{client}', [AdminClientsController::class, 'destroy']);
            Route::post('/search', [AdminClientsController::class, 'search']);
        });


Route::get('/maintenance', [AdminMaintenanceController::class, 'index'])->name('maintenance')
//->middleware('Admin')
;

Route::post('/maintenance/{maintenance}', [AdminMaintenanceController::class, 'update'])->name('maintenance.update')
// ->middleware('Admin')
;

Route::post('/maintenance/assign/{maintenance}', [AdminMaintenanceController::class, 'assign'])->name('maintenance.assign')
// ->middleware('Admin')
;

Route::delete('/maintenance/{maintenance}', [AdminMaintenanceController::class, 'destroy'])->name('maintenance.delete');
Route::delete('/maintenance/{maintenance}', [AdminMaintenanceController::class, 'destroy'])->name('maintenance.delete');
// ->middleware('Admin')
;


// Company routes -------------------------------------------------------------------------
Route::get('/company/maintenance', [CompanyMaintenanceController::class, 'index'])->name('incomplete_maintenance')
    // ->middleware('CompanyAdmin')
;

Route::get('/company/maintenance/completed', [CompanyMaintenanceController::class, 'completed'])->name('complete_maintenance')
    // ->middleware('CompanyAdmin')
;

Route::post('/company/maintenance/{maintenance}', [CompanyMaintenanceController::class, 'update'])->name('company_maintenance.update');
    // ->middleware('CompanyAdmin')
;

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// brands routes -------------------------------------------------------------------------
Route::group([
    'prefix' => 'brands'
    // ,'middleware' => ['auth', 'Admin']
], function () {
    Route::get('/', [AdminBrandsController::class, 'index'])->name('brands.brands');
    Route::post('/', [AdminBrandsController::class, 'store'])->name('brands.store');
    Route::post('/{brand}', [AdminBrandsController::class, 'update'])->name('brands.update');
    Route::delete('/{brand}', [AdminBrandsController::class, 'destroy'])->name('brands.delete');
});
// brands routes -------------------------------------------------------------------------
Route::group([
    'prefix' => 'types'
    // ,'middleware' => ['auth', 'Admin']
], function () {
    Route::get('/', [AdminTypesController::class, 'index'])->name('types.types');
    Route::post('/', [AdminTypesController::class, 'store'])->name('types.store');
    Route::post('/{type}', [AdminTypesController::class, 'update'])->name('types.update');
    Route::delete('/{type}', [AdminTypesController::class, 'destroy'])->name('types.delete');
});

// offers routes -------------------------------------------------------------------------
Route::group([
    'prefix' => 'offer'
    // ,'middleware' => ['auth', 'Admin']
], function () {
    Route::get('/', [AdminOffersController::class, 'index'])->name('offer.offer');
    Route::post('/', [AdminOffersController::class, 'store'])->name('offer.store');
    Route::post('/{offer}', [AdminOffersController::class, 'update'])->name('offer.update');
    Route::delete('/{offer}', [AdminOffersController::class, 'destroy'])->name('offer.delete');
});
}
);
// consultants routes -------------------------------------------------------------------------
Route::group([
    'prefix' => 'consultant'
    // ,'middleware' => ['auth', 'Admin']
], function () {
    Route::get('/', [AdminConsultantsController::class, 'index']);
    Route::post('/', [AdminConsultantsController::class, 'store']);
    Route::post('/{consultant}', [AdminConsultantsController::class, 'update']);
    Route::delete('/{consultant}', [AdminConsultantsController::class, 'destroy']);
});

//route to show clients images -------------------------------------------------------------
Route::get('/clients_images/{filename}', function ($filename) {
    $path = storage_path('../public/clients_images/' . $filename);
    if (!FacadesFile::exists($path)) {
        abort(404);
    }
    return response()->file($path);
});

//route to show offers images----------------------------------------------------------------
Route::get('/offers/{filename}', function ($filename) {
    $path = storage_path('../public/offers/' . $filename);
    if (!FacadesFile::exists($path)) {
        abort(404);
    }
    return response()->file($path);
});

//route to show admins images----------------------------------------------------------------
Route::get('/users_images/{filename}', function ($filename) {
    $path = storage_path('../public/users_images/' . $filename);
    if (!FacadesFile::exists($path)) {
        abort(404);
    }
    return response()->file($path);
});
