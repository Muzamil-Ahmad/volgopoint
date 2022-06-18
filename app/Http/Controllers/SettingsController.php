<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Artisan;

class SettingsController extends Controller
{
     public function index()
     {
        return view('pages.smtp_settings.show');
     }
    public function get(){
       
        try{  
            $result = DB::select("SELECT * FROM `general_settings`");
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
    public function update(Request $request)
    {
      
        try {
          
            $validation1 = Validator::make($request->all(),
                [
                'logo' => 'required:jpeg,png,jpg,gif',
              
                ]
            );
                
            if ($validation1->passes()) {
                $file1      = $request->file('logo');
                $filename1  = $file1->getClientOriginalName();
                // $extension1 = $file1->getClientOriginalExtension();
                $picture1   = date('His').'-'.$filename1;
                $file1->move(public_path('images/logo'), $picture1);
           } else {
                return response()->json([
                    'message'   => $validation1->errors()->all(),
                    'result'  => 'alert-danger'
                ]);
            }
           
               
                $res = DB::update("UPDATE `general_settings` SET `sitename` = '$request->sitename',`address` = '$request->address',`footertext` = '$request->footertext',`email` = '$request->email',`phone` = '$request->phone', `logo` = '$picture1'");
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


    /* function to get saved smtp settings
    **/
    public function getSmtp()
    {
      
    }
    // public function updateSmtp(Request $request)
    // {
    //     dd("update");
    // }

    /**
     * Update the API key's for other methods.
     */
    public function updateSmtp(Request $request)
    {
        foreach ($request->types as $key => $type) {

            $this->writeOnEnvFile($type, $request[$type]);
         }
        return response()->json(['result'=>'success','message'=>'Saved successfully!','data'=>'']);
    }
    public function writeOnEnvFile($type, $val)
    {

        $path = base_path('.env');
        if (file_exists($path)) {
            $val = '"'.trim($val).'"';
            // dd($val);
            if(is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0){
                file_put_contents($path, str_replace(
                    $type.'="'.env($type).'"', $type.'='.$val, file_get_contents($path)
                ));
               
            }
            else{
                file_put_contents($path, file_get_contents($path)."\r\n".$type.'='.$val);
            }
        }
    }

     /**
     * Update the API key's for other methods.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function env_key_update(Request $request)
    {
        // dd($request->all());
        foreach ($request->types as $key => $type) {
                $this->overWriteEnvFile($type, $request[$type]);
        }
        // flash("Settings updated successfully")->success();
        return back();
        // flash("Settings updated successfully")->success();
        // return redirect('/smtp_settings/show');
    }
    /**
     * overWrite the Env File values.
     * @param  String type
     * @param  String value
     * @return \Illuminate\Http\Response
     */
    public function overWriteEnvFile($type, $val)
    {
        // dd($type,$val);
        $path = base_path('.env');
        if (file_exists($path)) {
            $val = '"'.trim($val).'"';
            // dd($val);

            if(is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0){
                echo $type.'="'.env($type).'"';
                echo $type.'='.$val;
               
                file_put_contents($path, str_replace(
                    $type.'="'.env($type).'"', $type.'='.$val, file_get_contents($path)
                ));
            }
            else{
               
                file_put_contents($path, file_get_contents($path)."\r\n".$type.'='.$val);
            }
        }
    }


}
