<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Product;

class ProductController extends Controller
{
    /**
     * Show the table with specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
    //  dd($request->all());
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'product_original_price',
            3 => 'product_discounted_price',
            4 => 'product_quantity'
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        // $orderSec = $columns[$request->input('order.1.column')];
        // $dirSec   = $request->input('order.1.dir');
        //    $totalFiltered = $totalData;
        
           $data = array();
           $totalData=Product::where(['is_deleted'=>0])->count();
           $details=Product::where(['is_deleted'=>0])
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
                $nestedData['product_original_price'] = $entity->product_original_price;
                $nestedData['product_discounted_price'] = $entity->product_discounted_price;
                $nestedData['product_quantity'] = $entity->product_quantity;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
         // dd($request->all());
        // $myObj->color = $request->color;
        // $myObj->style = $request->style;
        // $myObj->size = $request->size;

        // $myJSON = json_encode($myObj);
        // dd($myJSON);
        $attributes=[];
      
        foreach($request->label as $key=>$value)
        {
            $data=[];
            if($request->value!="")
            {
            $data[$value]=$request->value[$key];
            $attributes[]=$data;
            }
        }
        // dd(json_encode($attributes));
        // $result = array_filter(($request->attributes), function($var){
        //     return ($var !== NULL && $var !== FALSE && $var !== "");
        // });
        // dd($result);
        // $myJSON =json_encode($request->attributes); 
        // dd($myJSON);
        $product = new Product;
        try{
            $product->name=$request->name;
            $product->attributes= json_encode($attributes);
            $product->carousal_id=$request->carousals!=""?$request->carousals:0;
            $product->tag_id=$request->Offers!=""?$request->Offers:0;
            $product->user_id= $request->user()->id;  
            $product->added_by= $request->user()->id;
            $product->category_id=$request->category;
            $product->slug=preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
            $product->subcategory_id=isset($request->sub_category)?$request->sub_category:0;
            $product->brand_id=isset($request->brand)?$request->brand:0;
            $product->product_original_price=$request->product_original_price;
            $product->product_discounted_price=$request->product_sale_price;
            $product->product_tax=$request->product_tax;
            $result = array_filter($request->alt_image_tag_photo, function($var){
                return ($var !== NULL && $var !== FALSE && $var !== "");
            });
            $product->photos_tags=json_encode( $result );
            // dd($request->alt_image_tag_thumbnail);
            $product->thumbnail_img_tag=$request->alt_image_tag_thumbnail;
            //Discount of product
           
            $discount_percentage = (($request->product_original_price - $request->product_sale_price)*100) /$request->product_original_price;
            $product->product_discount=$discount_percentage;
            $product->product_quantity=$request->product_quantity;
            $product->product_description=isset($request->product_description)?$request->product_description:"No Description Added";
            $product->product_cart_description=isset($request->product_cart_description)?$request->product_cart_description:"No Description Added";
            $product->product_specification=isset($request->product_specification)?$request->product_specification:"No Specification Added";
            $product->meta_title=$request->meta_title;
            $product->meta_description=isset($request->meta_description)?$request->meta_description:"No Description Added";
            $product->meta_keywords=isset($request->meta_keywords)?$request->meta_keywords:"No Key Words Added";
            $photos = array();
                if($request->hasFile('photos')){
                    foreach ($request->photos as $key => $photo) {
                        $path = $photo->store('products/photos',['disk' => 'public']);
                        array_push($photos, $path);
                    }
                    $product->photos = json_encode($photos);
                
                }

                if($request->hasFile('thumbnail_img')){
                    $product->thumbnail_img = $request->thumbnail_img->store('products/thumbnail',['disk' => 'public']);
                }

                // if($request->hasFile('featured_img')){
                //     $product->featured_img = $request->featured_img->store('products/featured',['disk' => 'public']);
                    
                // }

                // if($request->hasFile('flash_deal_img')){
                //     $product->flash_deal_img = $request->flash_deal_img->store('products/flash_deal',['disk' => 'public']);
                // }
            if($product->save()){
               return response()->json(['result'=>'success','message'=>"Saved Successfully!",'data'=>$product]);
            }else{
                return response()->json(['result'=>'fail','message'=>"Something went wrong!",'data'=>'']); 
            }
        }catch(Exception $ex){
            return response()->json(['result'=>'error','message'=>"Contact your system administrator!",'data'=>'']); 
        }

    }
    /**
     * Show the form to edit specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $data=Product::where(['id'=>$id,'is_deleted'=>0])->first();
        $data->photos=json_decode($data->photos);
        $data->photos_tags=json_decode($data->photos_tags,true);
        $data->attributes=json_decode($data->attributes);
        return response()->json(['data'=>$data]);
    }
     /**
     * Show to update specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id){
        // dd($request->all());
        try{
            $attributes=[];
      
           foreach($request->label as $key=>$value)
           {
                $data=[];
                if($request->value!="")
                {
                $data[$value]=$request->value[$key];
                $attributes[]=$data;
                }
            }
            $product = new Product;
            if($request->has('previous_photos')){
                $photos = $request->previous_photos;
            }
            else{
                $photos = array();
            }
            $photos_tags=json_encode($request->previous_alt_image_tag_photo);
            if($request->alt_image_tag_photo[0] != ""){
                $photos_tags = json_encode($request->alt_image_tag_photo);
            }
            if($request->hasFile('photos')){
                foreach ($request->photos as $key => $photo) {
                    $path = $photo->store('products/photos',['disk' => 'public']);
                    array_push($photos, $path);
                }
            }
            $photos = json_encode($photos);
            $newattributes= json_encode($attributes);
            $thumbnail_img = $request->previous_thumbnail_img;
            if($request->hasFile('thumbnail_img')){
                $thumbnail_img = $request->thumbnail_img->store('products/thumbnail',['disk' => 'public']);
            }

            // $featured_img = $request->previous_featured_img;
            // if($request->hasFile('featured_img')){
            //     $featured_img = $request->featured_img->store('products/featured',['disk' => 'public']);
            // }
            $featured_img =" ";
            // $flash_deal_img = $request->previous_flash_deal_img;
            // if($request->hasFile('flash_deal_img')){
            //     $flash_deal_img = $request->flash_deal_img->store('products/flash_deal',['disk' => 'public']);
                
            // }
            $flash_deal_img="";
            $sub_category=isset($request->sub_category)?$request->sub_category:0;
            $brand=isset($request->brand)?$request->brand:0;
            $discount_percentage = (($request->product_original_price - $request->product_sale_price)*100) /$request->product_original_price;
            $product=Product::where(['id'=>$id])->select('slug')->first();
            $slug=preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.substr($product->slug, -5);
            // $result = array_filter($request->alt_image_tag_thumbnail, function($var){
            //     return ($var !== NULL && $var !== FALSE && $var !== "");
            // }); 
            $thumbnail_tag=$request->previous_alt_image_tag_thumbnail;
            if($request->alt_image_tag_thumbnail != ""){
                $thumbnail_tag = $request->alt_image_tag_thumbnail;
            }
            $result=Product::where(['id'=>$id])->update(['name'=>$request->name,'user_id'=>$request->user()->id,'added_by'=>$request->user()->id,
            'category_id'=>$request->category,'subcategory_id'=>$request->sub_category,'carousal_id'=>$request->carousals,'brand_id'=>$request->brand,'tag_id'=>$request->Offers,'slug'=>$slug,
            'product_original_price'=>$request->product_original_price,'product_discounted_price'=>$request->product_sale_price,
            'product_tax'=>$request->product_tax,'product_discount'=>$discount_percentage,
            'product_quantity'=>$request->product_quantity,'product_description'=>$request->product_description,'meta_title'=>$request->meta_title,
            'meta_description'=>$request->meta_description,'meta_keywords'=>$request->meta_keywords,'product_cart_description'=>$request->product_cart_description,'photos'=>$photos,'thumbnail_img'=>$thumbnail_img,
            'featured_img'=>$featured_img,'attributes'=>$newattributes,'flash_deal_img'=>$flash_deal_img,'photos_tags'=>$photos_tags,'thumbnail_img_tag'=>$thumbnail_tag]);
            if($result){
                return response()->json(['result'=>'success','message'=>"Updated Successfully!",'data'=>$result]);
            }else{
                 return response()->json(['result'=>'fail','message'=>"Something went wrong!",'data'=>'']); 
            }
        }catch(Exception $ex){
            return response()->json(['result'=>'error','message'=>"Contact your system adminstrator!",'data'=>'']); 
        }

    }
      /**
     * Show to delete specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        try{
            $result=Product::where(['id'=>$id])->update(['is_deleted'=>1]);
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
