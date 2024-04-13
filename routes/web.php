<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainDashboard\users\userController;
use App\Http\Controllers\MainDashboard\clients\AdminClientsController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'  ]
    ], function(){

    Route::get('/', function () {
        return redirect()->route('login');
    });

    Route::get('/register', function () {
        return redirect()->route('login');
    });

    Auth::routes(['register' => false]);

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');




    //Route::post('assignRole', [userController::class ,'assignRole']);

   // Route::get('getAllPermissions', 'UserController@getAllPermissions');




// Route::get('/users', [App\Http\Controllers\MainDashboard\users\userController::class, 'index'])
//     ->middleware(['auth', 'SuperAdmin']);

// Route::get('/users/{id}', [App\Http\Controllers\MainDashboard\users\userController::class, 'show'])
//     ->middleware(['auth', 'Admin']);
// Route::post('/users/add', [App\Http\Controllers\MainDashboard\users\userController::class, 'store'])
//     ->middleware(['auth', 'SuperAdmin']);

// Route::post('/users/update/{user}', [App\Http\Controllers\MainDashboard\users\userController::class, 'update'])
//     ->middleware(['auth', 'Admin']);

// Route::post('/users/updateRole/{user}', [App\Http\Controllers\MainDashboard\users\userController::class, 'updateRole'])
//     ->middleware(['auth', 'SuperAdmin']);

// Route::delete('/users/{user}', [App\Http\Controllers\MainDashboard\users\userController::class, 'destroy'])
//     ->middleware(['auth', 'SuperAdmin']);

Route::group(['prefix' => 'users', 'middleware' => 'auth'], function () {
    Route::get('/', [userController::class, 'index'])->middleware('SuperAdmin');
    //Route::get('/{id}', [userController::class, 'show'])->middleware('Admin');
    Route::post('/store', [userController::class, 'store'])->middleware('SuperAdmin')->name('users.store');
    Route::post('/update/{id}', [userController::class, 'update'])->middleware('Admin')->name('users.update');
    Route::post('/updateRole/{user}', [userController::class, 'updateRole'])->middleware('SuperAdmin');
    Route::post('/{id}', [userController::class, 'destroy'])->middleware('SuperAdmin')->name('users.delete');
});




Route::group(['prefix' => 'clients', 'middleware' => ['auth', 'Admin']], function () {
    Route::get('/', [AdminClientsController::class, 'index']);
    Route::post('/{client}', [AdminClientsController::class, 'update']);
    Route::delete('/{client}', [AdminClientsController::class, 'destroy']);
});
 });
