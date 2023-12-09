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
            'name' => 'required|string|between:2,50',
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
        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));
         $carUser=Car::create([
                'user_id' =>$user->id,
                'user_name' =>$request->input('name'),
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




    public function update(){
        if( auth()->check()){ 
            $validator = Validator::make($request->all(), [
            'name' => 'required',
            'number' => 'required|unique:users',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ]);
        }
        $User=User::where('id',auth()->user()->id)->first();

        if(!$User){
            return response()->json([
            'message' => 'User not found',
            ],404);
        }

        $User->update([
                'name' =>$request->input('name'),
                'number' =>$request->input('number'),
                 'email' =>  $request->input('email'),
                 'password' =>$request->input('password'),
            ]);
        if($User){
            return response()->json([
                'message' => 'User  updated successfully',

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
}