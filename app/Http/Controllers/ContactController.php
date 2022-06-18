<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\ContactForm;
use DB;
class ContactController extends Controller
{
    public function index(Request $request){
        $data = $request->all();
        $res = DB::select("SELECT * from `users` WHERE role_id=1");
        $emailTo = isset($res[0])?$res[0]->email:"no_email";
        if($emailTo != "no_email"){
            try{
                Mail::to($emailTo)->cc($res[1])->send(new ContactForm($data));
                return response()->json([
                    'message'   => 'Email sent Successfully',
                    'result'  => 'alert-success',
                    'status' => 200,
                ]);
            }catch(Exception $ex){
                return response()->json([
                    'result'=>'error',
                    'error' => $ex
                ]);
            }
        }else{
            return response()->json([
                'message'   => 'No Email-Id, Contact Admin!',
                'result'  => 'failed'
            ]);
        }
    }
}
