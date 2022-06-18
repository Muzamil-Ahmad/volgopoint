<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
class AttributeController extends Controller
{
    
    public function get(Request $request){
        try{  
            $columns = array(
                0 => 'id',
                1 => 'name',
                2 => 'slug'
            );
            $limit = $request->input('length');
            $start = $request->input('start');
            // dd($request->all());
            $order = $columns[$request->input('order.0.column')];
            $dir   = $request->input('order.0.dir');

        
        $data = array();
           $totalData=\DB::table('attribute')->where(['is_deleted'=>0])->count();
           $details=\DB::table('attribute')->where(['is_deleted'=>0])
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
                $nestedData['slug'] = $entity->slug;
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
    public function create(Request $request){
        try {
            
            $check=DB::select("SELECT name FROM `attribute` WHERE name='$request->name'AND is_deleted=0 ");
                if ($check==true) {
                    return response()->json([
                        'message'   => "Attribute name already exists",
                        'result'  => 'alert-danger'
                    ]);
                }
        
             $slug=preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
          
            $res=DB::insert("INSERT INTO `attribute` (`name`, `slug`) VALUES ('$request->name', '$slug')");
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
    public function edit($id){
        $result = DB::select("SELECT * FROM `attribute` WHERE `attribute`.`id` = $id AND `attribute`.`is_deleted` = 0");
        if ($result) {
            return response()->json([ 'data' => $result[0]]);
        } else {
            return response()->json([
                'message'   => "OOPS! Something went wrong",
                'result'  => 'alert-danger'
            ]);
          }
    }


    public function update(Request $request){
        try {
               
                $check = DB::select("SELECT name FROM `attribute` WHERE id<>'$request->id' AND name='$request->name' AND `is_deleted`=0");
     
                if (count($check)==1)
                    {
                        return response()->json(['message' => "Attribute name already exists", 'class_name' => 'alert-danger']);
                    }
                    $slug=preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
                    $res = DB::update("UPDATE `attribute` SET `name` = '$request->name',`slug` = '$slug' WHERE `attribute`.`id` = $request->id");
             
                if ($res==0) {
                    return response()->json([
                        'message'   => "Updated Successfully",
                        'result'  => 'alert-success'
                    ]);
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
       
        $res = DB::update("UPDATE `attribute` SET `is_deleted` = '1' WHERE `attribute`.`id` = $id");
        if ($res==true) {
            return response()->json([
                'message'   => "Deleted Successfully",
                'result'  => 'success'
            ]);
        } else {
            return response()->json([
                'message'   => "OOPS! Something went wrong",
                'result'  => 'fail'
            ]);
        }
    }
    
}
