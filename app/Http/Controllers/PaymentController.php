<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use Stripe;
use DB;

class PaymentController extends Controller
{ 
    public function PayAndOrder (Request $request) {

        DB::beginTransaction();

        try {

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $stripePayment=Stripe\Charge::create ([
                    "amount" => $request->amount * 100,
                    "currency" => "USD",
                    "source" => $request->stripeToken,
                    "description" => "Making test payment." 
            ]);
            //insert order table
           $order=new Order();
           $order->user_name=$request->name;
           $order->Phone=$request->Phone;
           $order->Address=$request->Address;
           $order->Quantity=$request->name;
           $order->save();
  


            //insert payment table
            $payment=new Payment();
            $payment->order_id=$order->id;
            $payment->Total=$request->Total;
            $payment->currency='USD';
            $payment->amount=$request->amount;
            $payment->status='pending';
            $payment->transaction_id=$stripePayment->id;
            $payment->save();


            DB::commit();
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }


    
    }

}
