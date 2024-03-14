<?php

use App\Http\Controllers\Api\Employer\JobListingController;
use App\Http\Controllers\API\Employers\HomeController;
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

Route::group(['middleware' => ['auth:sanctum']], function(){
    //Route::post('/auth/register', [AuthController::class, 'register'])->middleware('restrictRole:admin');


    //Routes for Employer
    Route::get('/employer/dashboard', [HomeController::class, 'index'])->middleware('restrictRole:employer');
    Route::get('/employer/joblistings', [JobListingController::class, 'index'])->middleware('restrictRole:employer');
    Route::post('/employer/joblistings/create', [JobListingController::class, 'create'])->middleware('restrictRole:employer');
    Route::put('/employer/joblistings/update/{id}', [JobListingController::class, 'update'])->middleware('restrictRole:employer');
    Route::delete('/employer/joblistings/destroy/{id}', [JobListingController::class, 'destroy'])->middleware('restrictRole:employer');

    Route::get('/employer/profile', [HomeController::class, 'profile'])->middleware('restrictRole:employer');
    Route::put('/employer/profile/update/{id}', [HomeController::class, 'profile_update'])->middleware('restrictRole:employer');

    //Routes for Customers
    Route::get('/candidate/dashboard', [\App\Http\Controllers\Api\Candidate\HomeController::class, 'index'])->middleware('restrictRole:candidate');
    Route::get('/candidate/profile', [\App\Http\Controllers\Api\Candidate\HomeController::class, 'profile'])->middleware('restrictRole:candidate');

});


/*===========================
=           employers           =
=============================*/

Route::apiResource('/employers', \App\Http\Controllers\API\EmployerController::class);

/*=====  End of employers   ======*/

/*===========================
=           candidates           =
=============================*/
Route::post('register', '\App\Http\Controllers\API\Candidate\Auth\RegistrationController@register');
Route::post('login', '\App\Http\Controllers\API\Auth\LoginController@login');

//Employers API routes
//Route::get('/employer/dashboard', '\App\Http\Controllers\API\Employers\HomeController@index');
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

/*===========================
=           jobPostings           =
=============================*/

Route::apiResource('/jobPostings', \App\Http\Controllers\API\JobPostingController::class);

/*=====  End of jobPostings   ======*/
