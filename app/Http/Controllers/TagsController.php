<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'tag_name'
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        $data = array();
        $totalData=\DB::table('tags')->where(['is_deleted'=>0])->count();
        $details=\DB::table('tags')->where(['is_deleted'=>0])
        ->when($start, function($query,$start){
        return $query->offset($start);
        })
        ->orderBy($order, $dir)
        ->limit($limit)
        ->get();
           if($details) {
            foreach ($details as $key => $entity) {
                $nestedData['id'] = $entity->id;
                $nestedData['tag_name'] = $entity->tag_name;
                $data[] = $nestedData;
            }
        }
        // $totalData=count($details);
        $totalFiltered = $totalData;
        $json_data = array(
            "result"          => 'success',
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        return response()->json($json_data);
    }

    public function categoriesForAddProduct(Request $request)
    {
        $details=\DB::table('categories')->where(['is_deleted'=>0])->get();
           if($details) {
            foreach ($details as $key => $entity) {
                $nestedData['id'] = $entity->id;
                $nestedData['name'] = $entity->name;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "result"          => 'success',
            "data"            => $data
        );
        return response()->json($json_data);
    }
    public function subcategoriesForAddProduct(Request $request)
    {
        
        $details=\DB::table('subcategories')->where(['is_deleted'=>0])->get();
      
           if($details) {
            foreach ($details as $key => $entity) {
                $nestedData['id'] = $entity->id;
                $nestedData['name'] = $entity->name;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "result"          => 'success',
            "data"            => $data
        );
        return response()->json($json_data);
    }
    public function carousalForAddProduct(Request $request)
    {
        
        $details=\DB::table('carousal')->where(['is_deleted'=>0])->get();
      
           if($details) {
            foreach ($details as $key => $entity) {
                $nestedData['id'] = $entity->id;
                $nestedData['text'] = $entity->text;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "result"          => 'success',
            "data"            => $data
        );
        return response()->json($json_data);
    }
    public function attributesForAddProduct(Request $request)
    {
        
        $details=\DB::table('attribute')->where(['is_deleted'=>0])->get();
      
           if($details) {
            foreach ($details as $key => $entity) {
                $nestedData['id'] = $entity->id;
                $nestedData['name'] = $entity->name;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "result"          => 'success',
            "data"            => $data
        );
        return response()->json($json_data);
    }

    public function brandsForAddProduct(Request $request)
    {
        $details=\DB::table('brand')->where(['is_deleted'=>0])->get();
           if($details) {
            foreach ($details as $key => $entity) {
                $nestedData['id'] = $entity->id;
                $nestedData['name'] = $entity->name;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "result"          => 'success',
            "data"            => $data
        );
        return response()->json($json_data);
    }

    public function offersForAddProduct(Request $request)
    {
        $details=\DB::table('tags')->where(['is_deleted'=>0])->get();
           if($details) {
            foreach ($details as $key => $entity) {
                $nestedData['id'] = $entity->id;
                $nestedData['tag_name'] = $entity->tag_name;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "result"          => 'success',
            "data"            => $data
        );
        return response()->json($json_data);
    }
    public function create(Request $request)
    {
        $check=\DB::select("SELECT tag_name FROM `tags` WHERE tag_name='$request->tag_name'AND is_deleted=0 ");
    
                if ($check==true) {
                    return response()->json([
                        'message'   => "Offer already exists",
                        'result'  => 'alert-danger'
                    ]);
                }
                $check=\DB::table('tags')->where(['is_deleted'=>0])->count(); 
        if($check>=5){
                return response()->json(['result'=>'denied','message'=>'You cannot add more than five offers!']);
        }
            $result=\DB::table('tags')->insert(['tag_name'=>$request->tag_name]);
            return response()->json(['result'=>'success','message'=>'Product Offer added successfully!']);
    }
    public function edit($id)
    {
         
        $data=\DB::table('tags')->where(['id'=>$id,'is_deleted'=>0])->first();
        return response()->json(['result'=>'success','message'=>'Tag added successfully!','data'=>$data]);
    }
    public function update(Request $request,$id)
    {
            $result=\DB::table('tags')->where(['id'=>$id])->update(['tag_name'=>$request->tag_name]);
            return response()->json(['result'=>'success','message'=>'Tag updated successfully!']);
     
    }

    public function delete($id)
    {
        try{
            $result=\DB::table('tags')->where(['id'=>$id])->update(['is_deleted'=>1]);
            if($result){
                return response()->json(['result'=>'success','message'=>"Deleted Successfully!",'data'=>'']); 
            }else{
                return response()->json(['result'=>'fail','message'=>"Something went wrong!",'data'=>'']); 
            }
        }catch(Exception $ex){
            return response()->json(['result'=>'error','message'=>"Contact your system admintrator!",'data'=>'']); 
        }
    }
}
