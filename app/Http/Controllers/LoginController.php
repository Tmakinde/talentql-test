<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Hash;
use Auth;

class LoginController extends Controller
{
    public function __construct(){
        return $this->middleware('auth:api')->only('logout');
    }

    public function login(Request $request){
        $validated = Validator::make($request->all(), [
            'email' => 'required|email|exists:App\Models\User,email',
            'password' => 'required',
        ]);
        
        $email = $request->email;
        $password = $request->password;
        $credentials = $request->only('email', 'password');

        if ($validated->passes()) {
            $user = User::where('email', $email)->first();
            $checkPassword = Hash::check($request->password, $user->password);
            
            if(!$checkPassword){
               
                return response()->json(['message' => "credentials does not match", 'status_code' => 400], 400);
            }else{
                $accessToken = Auth::guard('api')->login($user);

                return response()->json(['message' => 'Login successful', 'accessToken' => $accessToken, 'status_code' => 200], 200);
            }

        }else{
            return response()->json(['message' => $validated->errors()], 400);
        }
    }

    /**
     * Logout
     * 
     *  */ 

    public function logout() {
        auth()->logout();

        return response()->json(['message' => "User successfully logout"]);
    }

}
