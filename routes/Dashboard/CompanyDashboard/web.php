<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\CompanyDashboard\Maintenance\CompanyMaintenanceController;
use App\Http\Controllers\Dashboard\CompanyDashboard\Technicians\AdminTechnicianController;
use App\Http\Controllers\Dashboard\Auth\HomeController;

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
        Route::group(
            [
                'prefix' => 'company-dashboard',
                'middleware' => ['auth', 'CompanyAdmin']
            ],
            function () {
                // Company dashboard home page -------------------------------------------------------------------------------------------------------------------------------------------------------
                Route::get('/', function () {
                    return view('CompanyDashboard.dashboard');
                })->name('company-dashboard');
                // Company dashboard maintenances routes----------------------------------------------------------------------------------------------------------------------------------------------
                Route::group([
                    'prefix' => 'maintenance'
                ], function () {
                    Route::get('/{companyId}', [CompanyMaintenanceController::class, 'index'])->middleware('checkCompany')->name('incomplete_maintenance');
                    Route::get('/completed/{companyId}', [CompanyMaintenanceController::class, 'completed'])->middleware('checkCompany')->name('complete_maintenance');
                    Route::post('/{maintenance}', [CompanyMaintenanceController::class, 'update'])->name('company_maintenance.update');
                });
                Route::get('/profile', [AdminTechnicianController::class, 'profile'])->name('company_profile');
                Route::post('/update/{id}', [AdminTechnicianController::class, 'update_user'])->name('users.update');

                // Company dashboard technicians routes----------------------------------------------------------------------------------------------------------------------------------------------
                Route::group([
                    'prefix' => 'technician'
                ], function () {
                    Route::get('/{companyId}', [AdminTechnicianController::class, 'index'])->middleware('checkCompany')->name('technician');
                    Route::post('/store/{companyId}', [AdminTechnicianController::class, 'store'])->name('technician.store');
                    Route::post('/update/{technician}', [AdminTechnicianController::class, 'update'])->name('technician.update');
                    Route::post('/banned/{technician}', [AdminTechnicianController::class, 'banned'])->name('technician.assign');
                    Route::delete('/{technician}', [AdminTechnicianController::class, 'destroy'])->name('technician.delete');
                    Route::get('/search/{search}', [AdminTechnicianController::class, 'search']);
                });
            });
    }
);
