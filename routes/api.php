<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ControlCarsController;
use App\Http\Controllers\NewPasswordController;


use App\Http\Controllers\PasswordResetRequestController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ResetController;


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
Route::group([
'prefix' => 'api/auth'
], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
    // Route::put('/updateprofile', [AuthController::class, 'update']);    

 Route::put('/updateFirstName', [AuthController::class, 'updateFirstName']);   
  Route::put('/updateLastName', [AuthController::class, 'updateLastName']);   
   Route::put('/updateEmail', [AuthController::class, 'updateEmail']);   
    Route::put('/updatePassword', [AuthController::class, 'updatePassword']);   
     Route::put('/updateNumber', [AuthController::class, 'updateNumber']);   

    Route::post('/reset-password-request', [ResetController::class, 'sendEmail']);
    Route::put('/change-password', [ChangePasswordController::class, 'resetPassword']);
    
});

Route::get('auth/createNewPassword', [NewPasswordController::class, 'createNewPassword']);

Route::group([
    'prefix' => 'api/Message'
    ], function () {
        Route::post('/add', [ContactController::class, 'sendMessage']);
});



Route::group([
    'prefix' => 'api/cars'
    ], function () {
        Route::get('/show', [ControlCarsController::class, 'show']);
        Route::post('/add', [ControlCarsController::class, 'add']);
        Route::put('/update/{id}', [ControlCarsController::class, 'update']);
        Route::delete('/delete/{id}', [ControlCarsController::class, 'delete']);
});


?>
