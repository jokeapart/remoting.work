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

/*===========================
=           employers           =
=============================*/

Route::apiResource('/employers', \App\Http\Controllers\API\EmployerController::class);

/*=====  End of employers   ======*/

/*===========================
=           candidates           =
=============================*/

Route::apiResource('/candidates', \App\Http\Controllers\API\CandidateController::class);

/*=====  End of candidates   ======*/

/*===========================
=           employers           =
=============================*/

Route::apiResource('/employers', \App\Http\Controllers\API\EmployerController::class);

/*=====  End of employers   ======*/

/*===========================
=           bPOS           =
=============================*/

Route::apiResource('/bPOS', \App\Http\Controllers\API\BPOController::class);

/*=====  End of bPOS   ======*/

/*===========================
=           employers           =
=============================*/

Route::apiResource('/employers', \App\Http\Controllers\API\EmployerController::class);

/*=====  End of employers   ======*/
