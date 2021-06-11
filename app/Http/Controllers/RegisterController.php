<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Hash;
use Exception;

class RegisterController extends Controller
{
    /**
     * register user function
     */

    public function register(Request $request){
        try {
            $validated = Validator::make($request->all(), [
                'username' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required',
            ]);
            
            if ($validated->passes()) {
    
                $user = User::create([
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);
                return response()->json(['message' => 'account created successfully'], 201);
    
            }
    
            return response()->json(['message' => $validated->errors()], 400);
        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
        
        
    }
}
