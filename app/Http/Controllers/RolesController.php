<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
class RolesController extends Controller
{
    public function index(){

    }

    public function create(Request $request){
        try {
           
            $check=DB::select("SELECT user_role FROM `role` WHERE user_role='$request->role'AND is_deleted=0 ");
                if ($check==true) {
                    return response()->json([
                        'message'   => "Role already exists",
                        'result'  => 'alert-danger'
                    ]);
                }
               
               
            $res=DB::insert("INSERT INTO `role` (`user_role`) VALUES ('$request->role')");
            if ($res==true) {
                return response()->json([
                    'message'   => "Saved Successfully",
                    'result'  => 'alert-success'
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
            $result = DB::select("SELECT * FROM `role`WHERE `role`.`is_deleted`=0");
            return response()->json(['result'=>'success','data'=>$result]);
        }catch(Exception $ex){
                     return response()->json(['result'=>'error','message'=>"Contact your system admintrator!",'data'=>'']); 
        }
        // return response()->json(['success'=>true, 'data' => $result],200);
    }

    public function edit($id){
  
        $result = DB::table('role')->select('*')->where(['id'=>$id])->first();
      
       if ($result) {
            return response()->json([ 'data' => $result]);
        } else {
            return response()->json([
                'message'   => "OOPS! Something went wrong",
                'result'  => 'alert-danger'
            ]);
          }
    }

    public function update(Request $request){
        
      try{
                $res = DB::update("UPDATE `role` SET `user_role` = '$request->role' WHERE `role`.`id` = $request->id");
            if ($res==true) {
                return response()->json([
                    'message'   => "Updated Successfully",
                    'result'  => 'alert-success'
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
    public function delete($id){
   
        $res = DB::update("UPDATE `role` SET `is_deleted` = '1' WHERE `role`.`id` = $id");
        if ($res==true) {
            return response()->json([
                'message'   => "Deleted Successfully",
                'result'  => 'alert-success'
            ]);
        } else {
            return response()->json([
                'message'   => "OOPS! Something went wrong",
                'result'  => 'alert-danger'
            ]);
        }
    }

}
