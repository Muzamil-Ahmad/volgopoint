<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CarosalController extends Controller
{
    public function index(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'text',
            2 => 'image',
            3 => 'alt_tag',
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $temp = $request->input('order.0.column');
        $columnId = isset($temp) ? $request->input('order.0.column') : 0;
        $order = $columns[$columnId];
        $temp = $request->input('order.0.dir');
        $columnId = isset($temp) ? $request->input('order.0.dir') : 'desc';
        $dir   = $columnId;
        // $order = $columns[$request->input('order.0.column')];
        // $dir   = $request->input('order.0.dir');
        // $orderSec = $columns[$request->input('order.1.column')];
        // $dirSec   = $request->input('order.1.dir');
        //    $totalFiltered = $totalData;
        $data = array();
        $totalData=\DB::table('carousal')->where(['is_deleted'=>0])->count();
        $details=\DB::table('carousal')->where(['is_deleted'=>0])
        ->when($start, function($query,$start){
        return $query->offset($start);
        })
        ->limit($limit)
        ->get();

           if($details) {
            foreach ($details as $key => $entity) {
                $nestedData['id'] = $entity->id;
                $nestedData['title'] = $entity->title;
                $nestedData['text'] = $entity->text;
                $nestedData['image'] = $entity->image;
                $nestedData['image_classic'] = ['ltr'=>$entity->image,'rtl'=>$entity->image];
                $nestedData['image_full'] = ['ltr'=>$entity->image,'rtl'=>$entity->image];
                $nestedData['image_mobile'] = ['ltr'=>$entity->image,'rtl'=>$entity->image];
                $nestedData['alt_tag'] = $entity->alt_tag;
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
    public function create(Request $request)
    {
        $img_tag      = $request->file('alt_image');
        $img_tag_name  = $img_tag->getClientOriginalName();
        $extension = $img_tag->getClientOriginalExtension();
        $image  = date('His').'-'.$img_tag_name;
        $img_tag->move(public_path('img'), $image);
        $count=\DB::table('carousal')->where(['is_deleted'=>0])->count(); 
        if($count>=5){
                return response()->json(['result'=>'denied','message'=>'You cannot add more than five carousal!']);
        }else{
            $result=\DB::table('carousal')->insert(['text'=>$request->text,'image'=>$image,'alt_tag'=>$request->alt_tag]);
            return response()->json(['result'=>'success','message'=>'Carousal added successfully!']);
        }
    }
    public function edit($id)
    {
        $data =\DB::table('carousal')->select('*')->where(['id'=>$id,'is_deleted'=>0])->first();
        return response()->json(['result'=>'success','message'=>'Carousal added successfully!','data'=>$data]);
    }
    public function update(Request $request,$id)
    {
        //dd($request->all());
       $img="";
       if($request->logochanged == 1){
            $img_tag      = $request->file('img');
            $img_tag_name  = $img_tag->getClientOriginalName();
            $extension = $img_tag->getClientOriginalExtension();
            $image  = date('His').'-'.$img_tag_name;
            $img_tag->move(public_path('img'), $image);    
            $img="image='".$image."'";
        }     

        if($request->logochanged == 1){
            $sqlQuery="UPDATE carousal SET text='".$request->text."',alt_tag='".$request->alt_tag."',".$img." WHERE id=".$id;

}else{
    $sqlQuery="UPDATE carousal SET text='".$request->text."',alt_tag='".$request->alt_tag."' WHERE id=".$id;

}
    
    $result=\DB::update($sqlQuery);
    if($result==0 ||$result==true)
    return response()->json(['result'=>'success','message'=>'Carousal updated successfully!']);
      else     
       return response()->json(['result'=>'fail','message'=>'something went wrong!!!!']);
    }

    public function delete($id)
    {
        
        try{
            $assignedCount=\DB::table('products')->where(['carousal_id'=>$id,'is_deleted'=>0])->count();
            if($assignedCount<=0){
                $result=\DB::table('carousal')->where(['id'=>$id])->update(['is_deleted'=>1]);
                if($result){
                    return response()->json(['result'=>'success','message'=>"Deleted Successfully!",'data'=>'']); 
                }else{
                    return response()->json(['result'=>'fail','message'=>"Something went wrong!",'data'=>'']); 
                }
            }else{
                return response()->json(['result'=>'assigned','message'=>"Carousal is assigned to product cannot be deleted!",'data'=>'']); 
            }
        }catch(Exception $ex){
            return response()->json(['result'=>'error','message'=>"Contact your system admintrator!",'data'=>'']); 
        }
    }
}
