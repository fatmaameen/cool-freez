<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MainDashboard\users\userController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\MainDashboard\clients\AdminClientsController;
use App\Http\Controllers\MainDashboard\Maintenance\AdminMaintenanceController;
use App\Http\Controllers\CompanyDashboard\Maintenance\CompanyMaintenanceController;




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

Route::post('/maintenance/{id}', [AdminMaintenanceController::class, 'update'])->name('maintenance.update')
// ->middleware('Admin')
;

Route::delete('/maintenance/{id}', [AdminMaintenanceController::class, 'destroy'])->name('maintenance.delete');
// ->middleware('Admin')
;
    }
);


// Company routes -------------------------------------------------------------------------
Route::get('/company/maintenance', [CompanyMaintenanceController::class, 'index'])->name('incomplete_maintenance')
    // ->middleware('CompanyAdmin')
;

Route::get('/company/maintenance/completed', [CompanyMaintenanceController::class, 'completed'])->name('complete_maintenance')
    // ->middleware('CompanyAdmin')
;

Route::post('/company/maintenance/{id}', [CompanyMaintenanceController::class, 'update'])->name('company_maintenance.update');
    // ->middleware('CompanyAdmin')
;

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
