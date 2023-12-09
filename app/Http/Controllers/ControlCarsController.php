<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use App\Models\Car;
class ControlCarsController extends Controller
{
    public function show(){
 
    if(auth()->check()){ 
        $Cars=Car::where('user_id',auth()->user()->id)->paginate(6);
         return response()->json([
        'Cars'=>$Cars, 
         ],200); 
        }
        else{
           return response()->json([
             "message" => "You Arenot Authenticated",
         ],401);
         } 
    }

    public function add(Request $request){
        if( auth()->check()){ 
        $validator = Validator::make($request->all(), [
            'car_model' => 'required',
            'car_color' => 'required',
            'car_number' => 'required|numeric',
            'Car_Wash_Schedule_Days' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ]);
        }else{

            Car::create([
                'user_id' =>auth()->user()->id,
                'user_name' =>auth()->user()->name,
                'car_model' =>$request->input('car_model'),
                 'car_color' =>  $request->input('car_color'),
                 'car_number' =>$request->input('car_number'),
                'Car_Wash_Schedule_Days'=>$request->input('Car_Wash_Schedule_Days'),
            ]);
        }
        
        return response()->json([
            'message' => 'Car Added Successfully',

        ],200);

    }
    else{
       return response()->json([
         "message" => "You Arenot Authenticated",
         
     ],401);
     } 
    }


    public function update(Request $request,$id){
        if( auth()->check()){ 
            $validator = Validator::make($request->all(), [
            'car_model' => 'required',
            'car_color' => 'required',
            'car_number' => 'required|numeric',
            'Car_Wash_Schedule_Days' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ]);
        }
        $Car=Car::find($id);

        if(!$Car){
            return response()->json([
            'message' => 'Car not found',
            ],404);
        }

        $Car->update([
                'user_name' =>auth()->user()->name,
                'car_model' =>$request->input('car_model'),
                 'car_color' =>  $request->input('car_color'),
                 'car_number' =>$request->input('car_number'),
                'Car_Wash_Schedule_Days'=>$request->input('Car_Wash_Schedule_Days'),
            ]);
        if($Car){
            return response()->json([
                'message' => 'Car  updated successfully',

                ],200);
        }

        if($request->all() == null){
            
            return response()->json([
                'message'=>' You Must Edit a One Value at Least',
            ],404);

        }
    }
    else{
       return response()->json([
         "message" => "You Arenot Authenticated",
         
     ],401);
     } 
    }


    public function delete($id){
        if( auth()->check()){ 
        $Car=Car::find($id);

        if(!$Car){
            return response()->json([
                'message' => 'Car not found',
            ],404);
            
        }
        $Car->delete($id);

        if($Car){
            return response()->json([
                'message' => 'Car Delted',
            ],200);
        }
    }
    else{
       return response()->json([
         "message" => "You Arenot Authenticated",
         
     ],401);
     } 
    }



}




?>