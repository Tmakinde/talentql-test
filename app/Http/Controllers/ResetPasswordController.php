<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Employee;
use Validator;
use Exception;
use Hash;

class ResetPasswordController extends Controller
{
    //
    public function isExpire($token){
        //check if token exist
        $user = User::where('token', $token)->first();

        //perform action if token exist
        if (!empty($user)) {
            // check for link life span if it has pass 30 minutes
            if (Carbon::now()->diffInMinutes($user->updated_at) < 3600) {
                return true;
            }else{
                return false;
            }
        }
        
        return false;

    }

    public function resetPassword(Request $request, $token){
        $validator = Validator::make($request->all(), [
            'password' => 'required',
        ]);

        try {
            if ($validator->passes() && $request->password == $request->password_confirm) {
                $user = User::where('token', $token)->first();
                $employee = Employee::where('token', $token)->first();
                if((empty($user) && $this->isExpire($token) == false) || (empty($employee))) throw new Exception('invalid token');
                
                // 
                if (!empty($user)) {
                    $user->token = null;
                    $user->password = Hash::make($request->password);
                    $user->save();
                    return response()->json([
                        'mesasge' => 'you have successfully reset your password',
                    ], 200);
                }
                
                $employee->token = null;
                $employee->password = Hash::make($request->password);
                $employee->save();
                return response()->json([
                    'mesasge' => 'you have successfully reset your password',
                ], 200);
                
    
            }else{
                return response()->json([
                    'error' => "password does not match!",
                ], 400);
            }
        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], 500);
        }
        
        
    }
}
