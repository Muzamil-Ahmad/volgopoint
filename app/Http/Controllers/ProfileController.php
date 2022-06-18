<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\User;
class ProfileController extends Controller
{
    public function get($email){
       
        try{  
          
            $result = DB::select("SELECT * FROM `users` WHERE `email`='$email'");
            if($result)
                 return response()->json(['result'=>'success','data'=>$result,'message'=>""]);
            else{
                return response()->json([
                    'message'   => "OOPS! Something went wrong",
                    'result'  => 'failure'
                ]);
              }
        }catch(Exception $ex){
                     return response()->json(['result'=>'error','message'=>"Contact your system admintrator!",'data'=>'']); 
        }
     
    }
    public function update(Request $request){
        try{ 
          
           if($request->dp!=null){
            
           $validation1 = Validator::make($request->all(),
                [
                'dp' => 'required:jpeg,png,jpg,gif',
                ]
            );
                
            if ($validation1->passes()) {
                $file1      = $request->file('dp');
                $filename1  = $file1->getClientOriginalName();
                $picture1   = date('His').'-'.$filename1;
                $file1->move(public_path('img'), $picture1);
               
            } else {
                return response()->json([
                    'message'   => $validation1->errors()->all(),
                    'result'  => 'alert-danger'
                ]);
            }
            User::where(['email'=>$request->email])->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone'=>$request->phone,
                'password' => bcrypt($request->password),
                'dp'=>$picture1
            ]);
            return response()->json([ 'message'   => "Updated Successfully",
            'data' => $picture1,
            'result'  => 'alert-success']);
        }
        else{
            User::where(['email'=>$request->email])->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone'=>$request->phone,
                'password' => bcrypt($request->password),
            ]);
            return response()->json([ 'message'   => "Updated Successfully",
            'data' => null,
            'result'  => 'alert-success']);
        }
           
         
           
            }catch(Exception $ex){
                     return response()->json(['result'=>'error','message'=>"Contact your system admintrator!",'data'=>'']); 
            }
    }
}
