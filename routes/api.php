<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ControlCarsController;





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
'prefix' => 'auth'
], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
    Route::post('/updateprofile', [AuthController::class, 'update']);    
});


Route::group([
    'prefix' => 'Message'
    ], function () {
        Route::post('/add', [ContactController::class, 'sendMessage']);
});



Route::group([
    'prefix' => 'cars'
    ], function () {
        Route::get('/show', [ControlCarsController::class, 'show']);
        Route::post('/add', [ControlCarsController::class, 'add']);
        Route::post('/update/{id}', [ControlCarsController::class, 'update']);
        Route::post('/delete/{id}', [ControlCarsController::class, 'delete']);
});


?>

