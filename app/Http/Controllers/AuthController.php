<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use App\Models\Car;

class AuthController extends Controller
{

    public function login(Request $request){
     
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'number' => 'required|string| |max:11',
            'zone_number' => 'required|numeric|',
            'building_number' => 'required|numeric',
            'apartment_number' => 'required|numeric',
            'car_model' => 'required',
            'car_color' => 'required',
            'car_number' => 'required|numeric',
            'Car_Wash_Schedule_Days' => 'required',
           
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create([
                'first_name' =>$request->input('first_name'),
                'last_name' =>$request->input('last_name'),
                'name' =>$request->input('first_name')." ".$request->input('last_name'),
                'email' =>$request->input('email'),
                'password' =>\Hash::make($request->input('password')),
                'number' =>$request->input('number'),
                'zone_number' =>$request->input('zone_number'),
                'building_number' =>$request->input('building_number'),
                 'apartment_number' =>$request->input('apartment_number'),
                'car_model' =>$request->input('car_model'),
                 'car_color' =>  $request->input('car_color'),
                 'car_number' =>$request->input('car_number'),
                'Car_Wash_Schedule_Days'=>$request->input('Car_Wash_Schedule_Days'),
                
                ]);
         $carUser=Car::create([
                'user_id' =>$user->id,
                'user_name' =>$request->input('first_name')." ".$request->input('last_name'),
                'car_model' =>$request->input('car_model'),
                 'car_color' =>  $request->input('car_color'),
                 'car_number' =>$request->input('car_number'),
                'Car_Wash_Schedule_Days'=>$request->input('Car_Wash_Schedule_Days'),
            ]);
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 200);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        if(auth()->check()){ 
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
        }
        else{
            return response()->json([
              "message" => "You Arenot Authenticated",
          ],401);
          } 
    
}

    public function userProfile() {
        if(auth()->check()){ 
        return response()->json(auth()->user());
    }
    else{
        return response()->json([
          "message" => "You Arenot Authenticated",
      ],401);
      } 
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }




    
    
    
    
    public function updateFirstName(Request $request){
        if( auth()->check()){ 
         
        $User=User::where('id',auth()->user()->id)->first();

        if(!$User){
            return response()->json([
            'message' => 'User not found',
            ],404);
        }else{
            
             $User->update([
                 "first_name"=>$request->first_name
                 ]);
            
        }
          return response()->json([
         "message" => "FirstName Updated Successfully",
         
     ],401);
          
        }

     
    else{
       return response()->json([
         "message" => "You Arenot Authenticated",
         
     ],401);
     } 
     
     
    }
    
    public function updateLastName(Request $request){
        if( auth()->check()){ 
         
        $User=User::where('id',auth()->user()->id)->first();

        if(!$User){
            return response()->json([
            'message' => 'User not found',
            ],404);
        }else{
            
             $User->update([
                 "last_name"=>$request->last_name
                 ]);
            
        }
             return response()->json([
         "message" => "LastName Updated Successfully",
         
     ],401);
        }

     
    else{
       return response()->json([
         "message" => "You Arenot Authenticated",
         
     ],401);
     } 
     
     
    }
    
    public function updateEmail(Request $request){
        if( auth()->check()){ 
         
        $User=User::where('id',auth()->user()->id)->first();

        if(!$User){
            return response()->json([
            'message' => 'User not found',
            ],404);
        }else{
            
             $User->update([
                 "email"=>$request->email
                 ]);
            
        }
             return response()->json([
         "message" => "Email Updated Successfully",
         
     ],401);
        }

     
    else{
       return response()->json([
         "message" => "You Arenot Authenticated",
         
     ],401);
     } 
     
     
    }
    
    public function updatePassword(Request $request){
        if( auth()->check()){ 
         
        $User=User::where('id',auth()->user()->id)->first();

        if(!$User){
            return response()->json([
            'message' => 'User not found',
            ],404);
        }else{
            
             $User->update([
                 "password"=>$request->password
                 ]);
            
        }
             return response()->json([
         "message" => "Password Updated Successfully",
         
     ],401);
        }

     
    else{
       return response()->json([
         "message" => "You Arenot Authenticated",
         
     ],401);
     } 
     
     
    }
    
    public function updateNumber(Request $request){
        if( auth()->check()){ 
         
        $User=User::where('id',auth()->user()->id)->first();

        if(!$User){
            return response()->json([
            'message' => 'User not found',
            ],404);
        }else{
            
             $User->update([
                 "number"=>$request->number
                 ]);
            
        }
             return response()->json([
         "message" => "Number Updated Successfully",
         
     ],401);
        }

     
    else{
       return response()->json([
         "message" => "You Arenot Authenticated",
         
     ],401);
     } 
     
     
    }
}