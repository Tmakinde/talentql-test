<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Hash;
use Auth;
use Exception;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function filter($var){
        if($var == '' || $var == null){
            return 1;
        }
    }

    public function matrix(Request $request){
        $validator = Validator::make($request->all(), [
            'matrixA' => ['required', 'array'],
            'matrixB' => ['required', 'array']
        ]);
        
        try {
            if($validator->passes()){
                $matrixA = $request->matrixA;
        
                $matrixB = $request->matrixB;
                $count_A_first_col = count($matrixA["1"]);
                $count_B_first_col = count($matrixB["1"]);

                if ($count_A_first_col != count($matrixB)) {
                    return \response()->json([
                        "message" => "column of the first must be equal to row of the second"
                    ], 400);
                }

                //print($count_A_first_col);
                foreach ($matrixA as $key => $value){
                    if ($count_A_first_col != count($value)) {
                        return \response()->json([
                            "message" => "invalid column numbers"
                        ]);
                    }

                    $collection = collect($value);

                    $result = $collection->filter(function($value){
                        return $this->filter($value);
                    });
                    
                }
                if($result->isNotEmpty()){
                    return \response()->json([
                        "message" => "empty value cannot exist for matrix"
                    ], 400);
                }
                
                foreach ($matrixB as $key => $value){
                    if ($count_B_first_col != count($value)) {
                        return \response()->json([
                            "message" => "invalid column numbers"
                        ]);
                    }
                    $collection = \collect($value);
                    $result = $collection->filter(function($value){
                        return $this->filter($value);
                    });
                    
                }
                if($result->isNotEmpty()){
                    return \response()->json([
                        "message" => "empty value cannot exist for matrix"
                    ], 400);
                }
                $col_B_array = [];
                $colOfMatB = [];   
                $resultCollection = [];
                $rowByCol='';
                foreach ($matrixA as $key_A => $value_A){
                    $rowOfMatA = $value_A;
                    for ($i=0; $i < $count_A_first_col; $i++) { 
                        foreach($matrixB as $key_B => $value_B){
                            array_push($colOfMatB, $value_B[$i]);
                            $col_B_array[$i] = $colOfMatB;
                        }
                        $colOfMatB = [];
                    }

                    for ($i=0; $i < count($col_B_array); $i++) { 
                        for ($j=0; $j < count($rowOfMatA); $j++) {
                            $rowByCol .=''.$rowOfMatA[$j].''.$col_B_array[$i][$j];
                            if($j == count($rowOfMatA) - 1){
                                $resultCollection[$key_A][] = $rowByCol;
                            }
                        }
                        $rowByCol = '';
                        
                    }

                }
                return \response()->json([
                    "result" => $resultCollection
                ], 201);
                
            }

            return \response()->json([
                "message" => $validator->errors()
            ], 400);
            
        } catch (Exception $ex) {
            return \response()->json([
                "message" => $ex->getMessage()
            ], 500);
        }
        
    }
}
