<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class FeedbackController extends Controller
{
   

    

    public function create(Request $request){
        try {
            $res=DB::insert("INSERT INTO `feedback` (`message`) VALUES ('$request->message')");
            if ($res==true) {
                return response()->json([
                    'message'   => "Saved Successfully",
                    'result'  => 'alert-success',
                    'status' => 200,
                ]);
            }else{
                return response()->json([
                    'message'   => "OOPS! Something went wrong",
                    'result'  => 'alert-danger'
                ]);
            }
        }
        catch (Exception $error) {
            Log::debug($error);
            return response()->json(['success'=>false, 'error' => $error],500);
        }  
    }


    public function get(){
        try{
            $res=DB::select("SELECT * FROM `feedback`");
            if ($res==true) {
                return response()->json([
                    'message'   => "Retrieved Successfully",
                    'result'  => $res,
                    'status' => 200,
                ]);
            }else{
                return response()->json([
                    'message'   => "OOPS! Something went wrong",
                    'result'  => 'alert-danger'
                ]);
            }
        }
        catch(Exception $error) {
            Log::debug($error);
            return response()->json(['success'=>false, 'error' => $error],500);
        }  
    }
    
}
