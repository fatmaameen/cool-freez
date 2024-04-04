<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/clients/register', [App\Http\Controllers\Clients\clientController::class, 'register']);

Route::post('/clients/login', [App\Http\Controllers\Clients\clientController::class, 'login']);


Route::post('/clients/logout/{id}', [App\Http\Controllers\Clients\clientController::class, 'logout'])
    ->middleware('auth:sanctum')
;

Route::get('/clients/profile/{id}', [App\Http\Controllers\Clients\clientController::class, 'show'])
->middleware('auth:sanctum')
;

Route::post('/clients/update/{client}', [App\Http\Controllers\Clients\clientController::class, 'update'])
->middleware('auth:sanctum')
;

Route::delete('/clients/{client}', [App\Http\Controllers\Clients\clientController::class, 'destroy'])
->middleware('auth:sanctum')
;
