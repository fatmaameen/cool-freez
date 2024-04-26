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
                'prefix' => 'company-dashboard', 'middleware' => ['auth', 'CompanyAdmin']
            ],
            function () {
                // Company dashboard home page -------------------------------------------------------------------------------------------------------------------------------------------------------
                Route::get('/', [HomeController::class, 'index'])->name('company-dashboard');
                // Company dashboard maintenances routes----------------------------------------------------------------------------------------------------------------------------------------------
                Route::group([
                    'prefix' => 'maintenance'
                ], function () {
                    Route::get('/', [CompanyMaintenanceController::class, 'index'])->name('incomplete_maintenance');
                    Route::get('/completed', [CompanyMaintenanceController::class, 'completed'])->name('complete_maintenance');
                    Route::post('/{maintenance}', [CompanyMaintenanceController::class, 'update'])->name('company_maintenance.update');
                });
                // Company dashboard technicians routes----------------------------------------------------------------------------------------------------------------------------------------------
                Route::group([
                    'prefix' => 'technician'
                ], function () {
                    Route::get('/', [AdminTechnicianController::class, 'index']);
                    Route::post('/', [AdminTechnicianController::class, 'store']);
                    Route::post('/{technician}', [AdminTechnicianController::class, 'update']);
                    Route::delete('/{technician}', [AdminTechnicianController::class, 'destroy']);
                    Route::post('/search', [AdminTechnicianController::class, 'search']);
                });
            }
        );
    }
);
