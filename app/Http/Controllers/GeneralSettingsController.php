<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class GeneralSettingsController extends Controller
{
    public function get(){
        try{  
            $result = DB::select("SELECT * FROM `mail_configuration`");
            return response()->json(['result'=>'success','data'=>$result]);
        }catch(Exception $ex){
                     return response()->json(['result'=>'error','message'=>"Contact your system admintrator!",'data'=>'']); 
        }
}

    public function edit(Request $request)

    {
        
    $res=DB::update("UPDATE `mail_configuration` SET  `mail_address`='$request->mailadd', `mail_encryption`= '$request->mailenc', `mail_host`='$request->mailhost',`mail_from`='$request->mailfrom',`mailer_name`='$request->mailname',`mail_password`='$request->mailpass' WHERE `mail_configuration`.`id` = $request->id");
    
    try{
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

}