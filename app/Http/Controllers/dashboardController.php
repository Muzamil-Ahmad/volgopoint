<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function get(){
        try{  
             
            $category_count = DB::table('categories')->select('id')->where(['is_deleted'=>0])->count();
            $product_count = DB::table('products')->select('id')->where(['is_deleted'=>0])->count(); 
             $brand_count = DB::table('brand')->select('id')->where(['is_deleted'=>0])->count(); 
              $user_count = DB::table('users')->select('id')->count();
             return response()->json(['result'=>'success','data'=>['total_categories'=>$category_count,'total_products'=> $product_count,'total_brand'=>$brand_count,'total_users'=>$user_count]]);
             }catch(Exception $ex){
                     return response()->json(['result'=>'error','message'=>"Contact your system admintrator!"]); 
        }
        
    }

}
