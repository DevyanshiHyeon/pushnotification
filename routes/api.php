<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\SecureFolderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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

Route::post('/device-token',[DeviceController::class,'store']);
Route::post('/add-token/{application_id}/{package_name}',[ApplicationController::class,'add_token']);
Route::post('/feedback/{application_id}',[FeedbackController::class,'store']);

Route::post('/test-notificatuion',[Controller::class,'test']);