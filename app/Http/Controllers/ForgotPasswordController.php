<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Exception;
use Mail;
use App\Events\SendPasswordMail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    //
    public function forgotPassword(Request $request){
        //validate email
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
        ]);
        try {
            if ($validator->passes()) {
                $token = Str::random(10);
                $email = $request->email;
                $user = User::where('email', $email)->first();
                // add token
                $user->token =  $token;
                $user->save();
                //send reset passwword mail
                //event(new SendPasswordMail($email, $user, $token));
                $customData = [
                    'email' => $email,
                    'user' => $user,
                    'token' => $token
                ];
                $mail = Mail::send(
                    'resetmail',
                    ["customData" => $customData],
                    function ($m)use($customData) {  
                    $m->from('meeulaco@meeula.com');
                    $m->to($customData['email'])->subject('Reset | Password!');
                    }
                );
                //if(!$mail) throw new Exception('No connection established') ;
                
                return response()->json([
                    'message' => 'You will recieve a notification in your mail shortly!',
                ], 200);
            }
            //return error message
            return response()->json([
                'message' => $validator->errors(),
            ], 400);
        } catch (Exception $exception) {
            return response()->json([
                $exception->getMessage(),
            ], 500);
        }
        


    }
}
