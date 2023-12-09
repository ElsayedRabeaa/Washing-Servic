<?php

use Illuminate\Support\Facades\Route;
use App\Events\TestEvent;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\PaymentController;


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
    event(new TestEvent('pusher work successfully'));
    return view('charge');
});

// Route::get('/send-sms', [SmsController::class, 'sendSMS']);

// Route::get('/charge_wiew', function () {
//     return view('charge');
// });


Route::get('/order_page',function(){
    return view('order');
});
Route::get('/payment_page',function(){
    return view('payment');
});
Route::post('/charge',[PaymentController::class, 'PayAndOrder']);
