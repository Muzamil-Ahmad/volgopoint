<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class UserController extends Controller
{
    public function get(){
        try{  
            $result = DB::select("SELECT users.id,users.name,users.email,role.user_role FROM `users`,`role` WHERE users.role_id=role.id AND users.is_deleted=0 AND role.is_deleted=0");
                   
            return response()->json(['result'=>'success','data'=>$result]);
        }catch(Exception $ex){
                     return response()->json(['result'=>'error','message'=>"Something went wrong!!!",'data'=>'']); 
        }
        // return response()->json(['success'=>true, 'data' => $result],200);
    }
    public function create(Request $request){
        try {
           
            $check=DB::select("SELECT email FROM `users` WHERE email='$request->email'AND is_deleted=0");
                if ($check==true) {
                    return response()->json([
                        'message'   => "User already exists",
                        'class_name'  => 'alert-danger'
                    ]);
                }
                $checkadmin=DB::select("SELECT role_id FROM `users` WHERE  is_deleted=0 ");
                if ($checkadmin==true) {
                    return response()->json([
                        'message'   => "Admin cannot be more than one.",
                        'result'  => 'alert-danger'
                    ]);
                }
               $password=bcrypt($request->password);
            $res=DB::insert("INSERT INTO `users` (`name`, `email`, `password`,`role_id`,`phone`) VALUES ('$request->name','$request->email','$password',$request->role,$request->phone)");
            
            if ($res==true) {
                return response()->json([
                    'message'   => "Saved Successfully",
                    'class_name'  => 'alert-success'
                ]);
            }else{
                return response()->json([
                    'message'   => "OOPS! Something went wrong",
                    'class_name'  => 'alert-danger'
                ]);
            }
        }
        catch (Exception $error) {
            Log::debug($error);
            return response()->json(['success'=>false, 'error' => $error],500);
        }  
    }
    

}
