<?php

use App\Http\Controllers\AllMessageController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChildMessgaeController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

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
// Auth Routes
Route::get('/', [AuthController::class,'index']);
Route::get('/login',function(){
    return redirect('/');
});
Route::post('/login', [AuthController::class,'login']);

Route::middleware('AuthMiddleware')->group(function(){
Route::get('/logout',[AuthController::class,'logout']);
Route::get('/dashboard',[MainController::class,'index'] );

Route::get('/get-data',[MainController::class,'get_data']);
Route::get('/message-dashboard',[MessageController::class,'dashboard']);
Route::get('/message',[MessageController::class,'index']);
Route::get('delete-msg/{id}',[MessageController::class,'destroy']);
// child-message
Route::get('/child-message/{id}',[ChildMessgaeController::class,'index']);
// Route::get('get-child-message/{id}',[ChildMessgaeController::class,'get_child_msg']);
Route::post('/create-child-message/{id}',[ChildMessgaeController::class,'store']);
Route::get('/edit-child-message/{id}',[ChildMessgaeController::class,'edit']);
Route::get('/get-message/{id}',[ChildMessgaeController::class,'get-message']);
// child-message
Route::get('get-message',[MessageController::class,'get_message']);
Route::post('/message/create',[MessageController::class,'store']);
Route::any('/change-message-status/{message_id}',[MessageController::class,'change_message_status']);

//application
Route::get('application',[ApplicationController::class,'index']);
Route::get('application-list',[ApplicationController::class,'application_list']);
Route::get('/application/create',[ApplicationController::class,'create']);
Route::post('/application',[ApplicationController::class,'store']);
Route::get('application/{application_id}',[ApplicationController::class,'show']);
Route::get('application/{application_id}/edit',[ApplicationController::class,'edit']);
Route::get('application/{application_id}/change-status',[ApplicationController::class,'changeStatus']);
//info
Route::get('/application-info/{application_id}',[ApplicationController::class,'info']);

//feedbacks
Route::get('/feedback/{application_id}',[FeedbackController::class,'index']);
Route::get('/feedback-list/{application_id}',[FeedbackController::class,'feedback_list']);

//dynamic message
Route::get('message/{application_id}',[AllMessageController::class,'index']);
Route::get('all-message-list/{application_id}',[AllMessageController::class,'all_message_list']);
Route::post('message/{application_id}/',[AllMessageController::class,'store']);
Route::get('message/edit/{application_id}',[AllMessageController::class,'edit']);
Route::get('message/delete/{application_id}',[AllMessageController::class,'destroy']);

//application's child message
Route::get('child-msg/{application_id}/{perentmsg_id}',[AllMessageController::class,'child_msg']);
Route::get('child-msg-list/{application_id}/{perentmsg_id}',[AllMessageController::class,'child_msg_list']);

//dynamic application child msg
Route::any('/child-message/{message_id}/edit',[ChildMessgaeController::class,'editChild']);
Route::any('/child-message/{message_id}/update',[ChildMessgaeController::class,'updateChild']);

Route::post('send-instant-notification/{application_id}',[AllMessageController::class,'send_instant_notification']);
});

Route::get('/clear', function() {
    Artisan::call('optimize:clear');
    dd('All Set 👌');
});

