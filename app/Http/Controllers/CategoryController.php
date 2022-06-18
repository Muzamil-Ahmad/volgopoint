<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    public function index(){
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'banner',
            3 => 'icon',
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        // $orderSec = $columns[$request->input('order.1.column')];
        // $dirSec   = $request->input('order.1.dir');
        //    $totalFiltered = $totalData;
        
           $data = array();
           $totalData=categories::where(['is_deleted'=>0])->count();
           $details=categories::where(['is_deleted'=>0])
           ->when($start, function($query,$start){
            return $query->offset($start);
           })
           ->orderBy($order, $dir)
           ->limit($limit)
           ->get();
        //   dd($details);
           if($details) {
            foreach ($details as $key => $entity) {
                $nestedData['id'] = $entity->id;
                $nestedData['name'] = $entity->name;
                $nestedData['banner'] = $entity->banner;
                $nestedData['icon'] = $entity->icon;
                $data[] = $nestedData;
            }
        }
        // $totalData=count($details);
        $totalFiltered = $totalData;
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        return response()->json($json_data);
    }
     /**
     * Show the form to add specified resource.
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
     **/
    

    public function create(Request $request){
        try {
           // dd($request->all());
            $validation1 = Validator::make($request->all(),
                [
                'icon' => 'required:jpeg,png,jpg,gif',
                'banner' => 'required:jpeg,png,jpg,gif'
                ]
            );
                
            if ($validation1->passes()) {
                $file1      = $request->file('banner');
                $filename1  = $file1->getClientOriginalName();
                // $extension1 = $file1->getClientOriginalExtensioncontrol();
                $picture1   = date('His').'-'.$filename1;
                $file1->move(public_path('img'), $picture1);
               
                $file2      = $request->file('icon');
                $filename2  = $file2->getClientOriginalName();
                // $extension2 = $file2->getClientOriginalExtension();
                $picture2   = date('His').'-'.$filename2;
                $file2->move(public_path('img'), $picture2);
                
            } else {
                return response()->json([
                    'message'   => $validation->errors()->all(),
                    'result'  => 'alert-danger'
                ]);
            }
            $check=DB::select("SELECT name FROM `categories` WHERE name='$request->name' AND is_deleted=0 ");
                if ($check==true) {
                    return response()->json([
                        'message'   => "Category name already exists",
                        'result'  => 'alert-danger'
                    ]);
                }
                $result = array_filter(json_decode($request->alt_tags), function($var){
                    return ($var !== NULL && $var !== FALSE && $var !== "");
                });
                $myJSON =json_encode($result); 
                $slug=preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5); 
            $res=DB::insert("INSERT INTO `categories` (`name`,`category_slug`,`banner`, `icon`,`alt_tag`) VALUES ('$request->name','$slug','$picture1','$picture2','$myJSON')");
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
    
    public function get(Request $request){
        try{  
            
            $columns = array(
                0 => 'id',
                1 => 'name',
                2 => 'banner',
                3 => 'icon'
            );
            $limit = $request->input('length');
            $start = $request->input('start');
            // dd($request->all());
            $order = $columns[$request->input('order.0.column')];
            $dir   = $request->input('order.0.dir');

        
        $data = array();
           $totalData=\DB::table('categories')->where(['is_deleted'=>0])->count();
           $details=\DB::table('categories')->where(['is_deleted'=>0])
           ->when($start, function($query,$start){
            return $query->offset($start);
           })
           ->limit($limit)
           ->orderby($order,$dir)
           ->get();
           if($details) {
            foreach ($details as $key => $entity) {
                $nestedData['id'] = $entity->id;
                $nestedData['name'] = $entity->name;
                $nestedData['banner'] = $entity->banner;
                $nestedData['icon'] = $entity->icon;
                $data[] = $nestedData;
            }
        }
        // $totalData=count($details);
        $totalFiltered = $totalData;
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        return response()->json($json_data);

            }catch(Exception $ex){
                return response()->json(['result'=>'error','message'=>"Contact your system admintrator!",'data'=>'']); 
        }




     
    }

   

    public function edit($id){
  
        $result = DB::table('categories')->select('*')->where(['id'=>$id,'is_deleted'=>0])->first();
      
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
       
        try {
          
            if($request->bannerchanged == 1){
            $validation1 = Validator::make($request->all(),
                [
                
                'banner' => 'required:jpeg,png,jpg,gif'
                ]
            );
                
            if ($validation1->passes()) {
                $file1      = $request->file('banner');
                $filename1  = $file1->getClientOriginalName();
                $extension1 = $file1->getClientOriginalExtension();
                $picture1   = date('His').'-'.$filename1;
                $file1->move(public_path('img'), $picture1);
              
               
           } else {
                return response()->json([
                    'message'   => $validation1->errors()->all(),
                    'result'  => 'alert-danger'
                ]);
            }
        }
        if($request->iconchanged == 1){
            $validation2 = Validator::make($request->all(),
            [
            'icon' => 'required:jpeg,png,jpg,gif',
            
            ]
        );
            
        if ($validation2->passes()) {
            
            $file2      = $request->file('icon');
            $filename2  = $file2->getClientOriginalName();
            $extension2 = $file2->getClientOriginalExtension();
            $picture2   = date('His').'-'.$filename2;
            $file2->move(public_path('img'), $picture2);
           
       } else {
            return response()->json([
                'message'   => $validation1->errors()->all(),
                'result'  => 'alert-danger'
            ]);
        }
    }
    $check = DB::select("SELECT name FROM `categories` WHERE id<>'$request->id' AND name='$request->name' AND `is_deleted`=0");
     
    if (count($check)==1)
        {
            return response()->json(['message' => "Category name already exists", 'class_name' => 'alert-danger']);
        }
        $result = array_filter(json_decode($request->alt_tags), function($var){
            return ($var !== NULL && $var !== FALSE && $var !== "");
        });
       
        $myJSON =json_encode($result); 
       
        if($request->bannerchanged == 1 && $request->iconchanged == 1 )
        $res = DB::update("UPDATE `categories` SET `name` = '$request->name', `alt_tag` = '$myJSON',`banner` = '$picture1', `icon` = '$picture2' WHERE `categories`.`id` = $request->id");
        if($request->bannerchanged == 1 && $request->iconchanged == 0 )
        $res = DB::update("UPDATE `categories` SET `name` = '$request->name',`alt_tag` = '$myJSON', `banner` = '$picture1' WHERE `categories`.`id` = $request->id");
        if($request->bannerchanged == 0 && $request->iconchanged == 1 )
        $res = DB::update("UPDATE `categories` SET `name` = '$request->name', `alt_tag` = '$myJSON',`icon` = '$picture2' WHERE `categories`.`id` = $request->id");
        if($request->bannerchanged == 0 && $request->iconchanged == 0 )
         {
      $sql="UPDATE `categories` SET `name` = '$request->name' ,`alt_tag` = '$myJSON' WHERE `categories`.`id` = $request->id";
        $res = DB::update($sql);
        $res=1;
         }
        
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
        $jes = DB::select("SELECT * FROM `products`  WHERE `category_id`= $id AND is_deleted = 0");
        if(count($jes)>0){
            return response()->json([
                        'message'   => "Category cant be deleted",
                        'result'  => 'alert-danger'
            ],419);
        }

        $res = DB::update("UPDATE `categories` SET `is_deleted` = '1' WHERE `categories`.`id` = $id");
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

