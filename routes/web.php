<?php

use App\Http\Controllers\CompanyDashboard\Maintenance\CompanyMaintenanceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainDashboard\users\userController;
use App\Http\Controllers\MainDashboard\clients\AdminClientsController;
use App\Http\Controllers\MainDashboard\Maintenance\AdminMaintenanceController;

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

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
});

Route::get('/register', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'users', 'middleware' => 'auth'], function () {
    Route::get('/', [userController::class, 'index'])->middleware('SuperAdmin');
    Route::get('/{id}', [userController::class, 'show'])->middleware('Admin');
    Route::post('/add', [userController::class, 'store'])->middleware('SuperAdmin');
    Route::post('/update/{user}', [userController::class, 'update'])->middleware('Admin');
    Route::post('/updateRole/{user}', [userController::class, 'updateRole'])->middleware('SuperAdmin');
    Route::delete('/{user}', [userController::class, 'destroy'])->middleware('SuperAdmin');
});


Route::group(['prefix' => 'clients', 'middleware' => ['auth', 'Admin']], function () {
    Route::get('/', [AdminClientsController::class, 'index']);
    Route::post('/{client}', [AdminClientsController::class, 'update']);
    Route::delete('/{client}', [AdminClientsController::class, 'destroy']);
    Route::post('/search', [AdminClientsController::class, 'search']);
});

Route::get('/maintenance', [AdminMaintenanceController::class, 'index'])
// ->middleware('Admin')
;

Route::post('/maintenance/{maintenance}', [AdminMaintenanceController::class, 'update'])
// ->middleware('Admin')
;

Route::delete('/maintenance/{maintenance}', [AdminMaintenanceController::class, 'destroy']);
// ->middleware('Admin')
;


// Company routes -------------------------------------------------------------------------
Route::get('/company/maintenance', [CompanyMaintenanceController::class, 'index'])
// ->middleware('CompanyAdmin')
;

Route::get('/company/maintenance/completed', [CompanyMaintenanceController::class, 'completed']);
// ->middleware('CompanyAdmin')
;

Route::post('/company/maintenance/{maintenance}', [CompanyMaintenanceController::class, 'update']);
// ->middleware('CompanyAdmin')
;
