<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::controller(AuthController::class)->group(function () {
    // Register And Login to Generate Bearer Token For the Next APIS //
    Route::post('/register', 'register');
    Route::post('/login' ,'login');

});

Route::middleware('auth:sanctum')->group(function (){
    Route::apiResource('/users' ,UserController::class)->only('index')->middleware('auth:sanctum');

    // get search/users?filter[firstName]=mohamed&filter[lastName]=amin&filter[email]=gmail  << Works like that Dynamic
    Route::get('/search/users' , [UserController::class , 'search']);
});


