<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Role;
use Session;
class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {
      //  dd($request->all());
         $result=User::where(['email'=>$request->email,'is_deleted'=>0])->select('email')->first();
         $result=isset($result->email)?1:0;
        if($result)
        {
            return response()->json([
                'message' => 'Email already exists!',
                'result'=>'danger'
            ], 201);
        }
        if(isset($request->role)){
            if($request->role==1){
               // dd("reached here!");
                $check=User::where(['role_id'=>1,'is_deleted'=>0])->select('email')->first();
               
                $check=isset($check->email)?1:0;
                if($check){
                    return response()->json([
                        'message' => 'Admin already exists!',
                        'result'=>'danger'
                    ], 201);
            }
        }
        }
       
                $buyer=Role::where(['user_role'=>'buyer'])->select('id')->first();
                $buyer=isset($buyer->id)?$buyer->id:0;
                $user = new User([
                    'name' => $request->name,
                    'email' => $request->email,
                    'role_id' => isset($request->role)?$request->role:$buyer,
                    'phone'=>$request->phone,
                    'password' => bcrypt($request->password)
                ]);
                if($user->save()){
                    return response()->json([
                        'message' => 'User created successfully!',
                        'result'=>'success'
                    ], 201);
                }else{
                    return response()->json([
                        'message' => 'Something went wrong!',
                        'result'=>'error'
                    ], 502);
                }
       
       
    
            
    }
  
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            // 'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        $role_data=Role::select('*')->where(['id'=>$user->role_id])->first();
        if($role_data->user_role == 'admin'){
           session(['token' => $tokenResult->accessToken]);
         }
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'user'=> $user ,
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        Session::flush();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
  
    public function edit($id){
        $result = \DB::table('users')->select('role_id')->where(['id'=>$id])->first();
    
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
                $res = \DB::table('users')->where(['id'=>$request->id])->update(['role_id'=>$request->role]);
                return response()->json([
                    'message'   => "Updated Successfully",
                    'result'  => 'alert-success'
                ]);
            }
            catch (Exception $error) {
                Log::debug($error);
                return response()->json(['success'=>false, 'error' => $error],500);
            }  
        
    }
    public function delete($id){
        $res = \DB::update("UPDATE `users` SET `is_deleted` = '1' WHERE `users`.`id` = $id");
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
        
    
    public function get(){
        try{  
            $result = \DB::select("SELECT users.id,users.name,users.email,users.phone,role.user_role FROM `users`,`role` WHERE users.role_id=role.id AND users.is_deleted=0 AND role.is_deleted=0");
              //$result=\DB::select('*')->InnerJoin('role','role.id','=','user.role_id')->where(['role.is_deleted'=>0,'users.is_deleted'=>0])->get();     
            return response()->json(['result'=>'success','data'=>$result]);
        }catch(Exception $ex){
                     return response()->json(['result'=>'error','message'=>"Something went wrong!!!",'data'=>'']); 
        }
        // return response()->json(['success'=>true, 'data' => $result],200);
    }



}