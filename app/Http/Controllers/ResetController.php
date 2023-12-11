<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use App\Models\Reset;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Facades\Notification;
class ResetController extends Controller
{
     public function sendEmail(Request $request) {
        $validator = Validator::make($request->all(), [
          
            'email' => 'required|string|email|max:100|exists:users,email',
           
           
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $userResetEmail = Reset::create([
              
                'email' =>$request->input('email'),
                
                ]);
                
                $user=User::where('email',$userResetEmail->email)->first();
                // return $user->email;
                  Notification::route('mail', $user->email)->notify(new ResetPasswordNotification(null));
                // Notification::send(new ResetPasswordNotification($user));
         
        return response()->json([
            'message' => 'Email sended',
            
        ], 200);
    }
}
