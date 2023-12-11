<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatePasswordRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Http\Controllers\PasswordResetRequestController;
use Validator;
use App\Models\Reset;
class ChangePasswordController extends Controller {

protected $passReset;

public function __construct(PasswordResetRequestController $passResetetVariable )
{
  
  $this->passReset =$passResetetVariable;
    
  
}
  /*   public function passwordResetProcess(Request $request){

    return $this->updatePasswordRow($request)->count() > 0 ? $this->resetPassword($request) : $this->tokenNotFoundError(); 
    }
    // Verify if token is valid
    private function updatePasswordRow($request){
       return DB::table('password_reset_tokens')->where([
           'email' => $request->email,
           'token' => $request->passwordToken
       ]);
    }
    // Token not found response
    private function tokenNotFoundError() {
        return response()->json([
          'error' => 'Either your email or token is wrong.'
        ],Response::HTTP_UNPROCESSABLE_ENTITY);
    } */


    // Reset password
    public function resetPassword(Request $request) {
        
             $validator = Validator::make($request->all(), [
             'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ]);
        }
        // find email
        
      
         $resetEmail=Reset::latest()->first();
         
          $userDataEmail = User::where('email',"=",$resetEmail->email)->first();
          $userDataEmail->update([
              'password'=>\Hash::make($request->password),
              
              ]);
              
              return response()->json([
                  'message'=>"password Updated Successfully"
                  ]);
         
          }
          


}