<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Validator;
class ContactController extends Controller
{
    public function sendMessage(Request $request) {
    if(auth()->check()){ 

        $validator = Validator::make($request->all(), [
             'message' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $contact = Contact::create(array_merge(
                    $validator->validated(),
                    ['user_name' => auth()->user()->name,'message' => $request->message]
                ));
        return response()->json([
            'message' => 'User Send Message successfully ',
        ], 200);
    }

    else{
        return response()->json([
          "message" => "You Arenot Authenticated",
      ],401);
      } 
}

}