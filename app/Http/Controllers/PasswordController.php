<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Reminder;
use App\User;
use Mail;
use DB;
class PasswordController extends Controller
{
    public function forgot(Request $request)
    {
        $user= User::where(['email'=>$request->email])->first();
        if ($user==null) {
            return response()->json(['result'=>'error','message'=>"email not exists",'data'=>'']);
        }
        
        //$user = Sentinel::findById($user->id);
       
        // $reminder = Reminder::exists($user) ? : Reminder::create($user);
        $this->sendEmail($user);
        return response()->json(['result'=>'success','message'=>"link sent to your email to reset password",'data'=>'']);
    }
    public function sendEmail($user)
    {
        Mail::send(
            'email.forgot',
            ['user'=>$user,'code'=>123],
            function ($message) use ($user) {
              $message->to($user->email);
              $message->subject("$user->name,reset your password.");
          }
        );
    }
    public function reset(Request $request)
    {
        // $res = DB::update("UPDATE `users` SET `password` = ' bcrypt($request->password)' WHERE `users`.`email` = $request->email");
        $res = DB::table('users')->where(['email'=>$request->email])->update(['password'=>bcrypt($request->password)]);
        if ($res==true) {
          
                return response()->json([
                    'message'   => "Password changed Successfully",
                    'result'  => 'alert-success'
                ]);
            }else{
                return response()->json([
                    'message'   => "OOPS! Something went wrong",
                    'result'  => 'alert-danger'
                ]);
       
        }
    }
}
