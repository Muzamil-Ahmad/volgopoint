<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Review;
use DB;
use App\User;
// use App\Order;
// use App\Product;
// use App\Color;
// use App\OrderDetail;
// use App\CouponUsage;
// use App\OtpConfiguration;
// use App\BusinessSetting;
use PDF;
use Mail;
use App\Mail\InvoiceEmailManager;

class ApiController extends Controller
{
    /**
     * Getting the specified resource of products for frontend.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCategoryProductsForBuyer($id){
        $data=Product::Select('id','name','photos','thumbnail_img','featured_img','flash_deal_img','product_original_price','product_discounted_price','product_discount','product_quantity','product_tax','product_description','slug')->where(['category_id'=>$id])->get();
        if(count($data)>0){
            return response()->json(['result'=>'success','message'=>"Successfull!",'data'=>$data]); 
        }else{
            return response()->json(['result'=>'success','message'=>"Products not availiable!",'data'=>'']); 
        }
    }
     /**
     * Getting the specified resource of products for frontend.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPopularProductsForBuyer(Request $data){
        // dd($data->all());
        $limit=$data->limit;
        $category_slug=isset($data->category_slug)?$data->category_slug:'all';
        if($category_slug != 'all')
        $data=Product::Select('products.id as product_id','products.name as product_name','photos','thumbnail_img','product_original_price','product_discounted_price','product_discount','slug','attributes')->join('categories','categories.id','=','products.category_id')->where(['categories.category_slug'=>$category_slug,'categories.is_deleted'=>0,'products.is_deleted'=>0])->limit($limit)->get();
        else
        $data=Product::Select('products.id as product_id','products.name as product_name','photos','thumbnail_img','product_original_price','product_discounted_price','product_discount','slug','attributes')->join('categories','categories.id','=','products.category_id')->where(['categories.is_deleted'=>0,'products.is_deleted'=>0])->limit($limit)->get();
        $reviewdata=DB::select("SELECT product_id,count(*)as count, avg(review_stars)as averageRating FROM `review` GROUP BY (product_id)");
        $reviewdataproduct=array_column($reviewdata,"product_id");
  
        $result=[];
        $associate=[];
        foreach($data as $row)
        {
            $index=array_search($row->product_id,$reviewdataproduct);
            $associate['slug']=$row->slug;
            $associate['name']=$row->product_name;
            $associate['price']=$row->product_discounted_price;
            $associate['images']=json_decode($row->photos);
            $associate['rating']=$index!=false||$index===0?ceil($reviewdata[$index]->averageRating):0;
            $associate['reviews']=$index!=false||$index===0?ceil($reviewdata[$index]->count):0;
            $associate['badges']='sale';
            $associate['availability']=2;
            $associate['categories']=[];
            $associate['attributes']=$row->attributes;
            $result[]=$associate;
        }
        // dd($result);
        if(count($result)>0){
            return response()->json(['result'=>'success','message'=>"Successfull!",'data'=>$result]); 
        }else{
            return response()->json(['result'=>'success','message'=>"Products not availiable!",'data'=>'']); 
        }
    }
    /**
     * Getting the specified resource of products for frontend.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getLatestProductsForBuyer(Request $data){
        $limit=$data->limit;
        $category_slug=isset($data->category_slug)?$data->category_slug:'all';
        if($category_slug != 'all')
        $data=Product::Select('products.id as product_id','products.name as product_name','photos','thumbnail_img','product_original_price','product_discounted_price','product_discount','slug','attributes')->join('categories','categories.id','=','products.category_id')->where(['categories.category_slug'=>$category_slug,'categories.is_deleted'=>0,'products.is_deleted'=>0])->limit($limit)->get();
        else
        $data=Product::Select('products.id as product_id','products.name as product_name','photos','thumbnail_img','product_original_price','product_discounted_price','product_discount','slug','attributes')->join('categories','categories.id','=','products.category_id')->where(['categories.is_deleted'=>0,'products.is_deleted'=>0])->limit($limit)->get();
        $reviewdata=DB::select("SELECT product_id,count(*)as count, avg(review_stars)as averageRating FROM `review` GROUP BY (product_id)");
        $reviewdataproduct=array_column($reviewdata,"product_id");
  
        $result=[];
        $associate=[];
        foreach($data as $row)
        {
            $index=array_search($row->product_id,$reviewdataproduct);
            $associate['slug']=$row->slug;
            $associate['name']=$row->product_name;
            $associate['price']=$row->product_discounted_price;
            $associate['images']=json_decode($row->photos);
            $associate['rating']=$index!=false||$index===0?ceil($reviewdata[$index]->averageRating):0;
            $associate['reviews']=$index!=false||$index===0?ceil($reviewdata[$index]->count):0;
            $associate['badges']='sale';
            $associate['availability']=2;
            $associate['categories']=[];
            $associate['attributes']=$row->attributes;
            $result[]=$associate;
        }
        // dd($result);
        if(count($result)>0){
            return response()->json([
            'result'=>'success',
            'message'=>"Successfull!",
            'items'=>$result
            ]); 
        }else{
            return response()->json(['result'=>'success','message'=>"Products not availiable!",'data'=>'']); 
        }
    }
     /**
     * Getting the specified resource of products for frontend.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getTopRatedProductsForBuyer(Request $data){
       $limit=$data->limit;
       $reviewdata=DB::select("SELECT product_id,count(*)as count, avg(review_stars)as averageRating FROM `review` GROUP BY (product_id)");
       $reviewdataproduct=array_column($reviewdata,"product_id");
       $data=Product::Select('products.id as product_id','products.name as product_name','photos','thumbnail_img','product_original_price','product_discounted_price','product_discount','slug','attributes')->join('categories','categories.id','=','products.category_id')->where(['categories.is_deleted'=>0,'products.is_deleted'=>0])->orderBy('products.created_at','DESC')->limit($limit)->get();
        $result=[];
        $associate=[];
        foreach($data as $row)
        {
            $index=array_search($row->product_id,$reviewdataproduct);
            $associate['slug']=$row->slug;
            $associate['name']=$row->product_name;
            $associate['price']=$row->product_discounted_price;
            $associate['images']=json_decode($row->photos);
            $associate['rating']=$index!=false||$index===0?ceil($reviewdata[$index]->averageRating):0;
            $associate['reviews']=$index!=false||$index===0?ceil($reviewdata[$index]->count):0;
            $associate['badges']='sale';
            $associate['availability']=2;
            $associate['categories']=[];
            $associate['attributes']=$row->attributes;
        
            $result[]=$associate;
        }
        if(count($result)>0){
            return response()->json(['result'=>'success','message'=>"Successfull!",'data'=>$result]); 
        }else{
            return response()->json(['result'=>'success','message'=>"Products not availiable!",'data'=>'']); 
        }
    }
     /**
     * Getting the specified resource of products for frontend.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDiscountedProductsForBuyer(Request $data){
        $limit=$data->limit;
        // $category_slug=isset($data->category_slug)?$data->category_slug:'all';
        // if($category_slug != 'all')
        // $data=Product::Select('products.id as product_id','products.name as product_name','photos','thumbnail_img','product_original_price','product_discounted_price','product_discount','slug')->join('categories','categories.id','=','products.category_id')->where(['categories.category_slug'=>$category_slug,'categories.is_deleted'=>0,'products.is_deleted'=>0])->limit($limit)->get();
        // else

        $data=Product::Select('products.id as product_id','products.name as product_name','photos','thumbnail_img','product_original_price','product_discounted_price','product_discount','slug','attributes')->join('categories','categories.id','=','products.category_id')->where(['categories.is_deleted'=>0,'products.is_deleted'=>0])->limit($limit)->get();
        $reviewdata=DB::select("SELECT product_id,count(*)as count, avg(review_stars)as averageRating FROM `review` GROUP BY (product_id)");
        $reviewdataproduct=array_column($reviewdata,"product_id");
  
        $result=[];
        $associate=[];
        foreach($data as $row)
        {
            $index=array_search($row->product_id,$reviewdataproduct);
            $associate['slug']=$row->slug;
            $associate['name']=$row->product_name;
            $associate['price']=$row->product_discounted_price;
            $associate['images']=json_decode($row->photos);
            $associate['rating']=$index!=false||$index===0?ceil($reviewdata[$index]->averageRating):0;
            $associate['reviews']=$index!=false||$index===0?ceil($reviewdata[$index]->count):0;
            $associate['badges']='sale';
            $associate['availability']=2;
            $associate['categories']=[];
            $associate['attributes']=$row->attributes;
        
            $result[]=$associate;
        }
        if(count($result)>0){
            return response()->json(['result'=>'success','message'=>"Successfull!",'data'=>$result]); 
        }else{
            return response()->json(['result'=>'success','message'=>"Products not availiable!",'data'=>'']); 
        }
    }
    /**
     * Getting the specified resource of categories for frontend.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCategoriesForBuyer(){
        $data=array();
        $details=DB::table('categories')->where(['categories.is_deleted'=>0])
        ->join('products','products.category_id','=','categories.id')
        ->select(DB::raw("categories.*"))
        //->select(DB::raw("count(products.id) as containerProducts","categories*"))
        ->groupBy('categories.id')
        ->get();
        
        $count_prod=DB::table('categories')->where(['categories.is_deleted'=>0])
        ->join('products','products.category_id','=','categories.id')
        ->select(DB::raw("count(products.id) as containerProducts" ))
        ->groupBy('categories.id')
        ->get();
        //dd($count);
      if($details) {
        $nestedData['id'] = 0;
        $nestedData['name'] = "All";
        $nestedData['category_slug'] = "all";
        $nestedData['alt_tag'] = "";
        $nestedData['title'] = "all";
        $nestedData['url'] = '/shop';
        $nestedData['products'] =  "";
        $nestedData['image'] = "";
        $data[]=$nestedData;
       foreach ($details as $key => $entity) {
                $nestedData['id'] = $entity->id;
                $nestedData['name'] = $entity->name;
                $nestedData['category_slug'] = $entity->category_slug;
                $nestedData['alt_tag'] = $entity->alt_tag;
                $nestedData['title'] = $entity->name;
                $nestedData['url'] = '/shop';
                // $nestedData['products']=300;
                $nestedData['products'] =  $count_prod[$entity->id-1]->containerProducts;
                $nestedData['image'] = $entity->icon;
                $nestedData['subcategories'] = [
                    ['title'=>'Screwdrivers','url'=>'/shop'],
                    ['title'=>'Milling Cutters','url'=>'/shop'],
                    ['title'=>'Sanding Machines','url'=>'/shop'],
                    ['title'=>'Wrenches','url'=>'/shop'],
                    ['title'=>'Drills','url'=>'/shop']
                ];
                $data[] = $nestedData;
        }
    }
            if(count($data)>0){
                return response()->json(['result'=>'success','message'=>"Successfull!",'data'=>$data]); 
            }else{
                return response()->json(['result'=>'success','message'=>"Categories not availiable!",'data'=>[]]); 
            }
    }
     /**
     * Getting the specified resource of product for frontend.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProductBySlug($slug){
        $data=Product::where(['slug'=>$slug])->first();
        $associate=[];
        $reviewdata=DB::select("SELECT product_id,count(*)as count, avg(review_stars)as averageRating FROM `review` GROUP BY (product_id)");
        $reviewdataproduct=array_column($reviewdata,"product_id");
        
        if(isset($data['slug'])){
            $associate['slug']=$data->slug;
            $associate['name']=$data->name;
            $associate['price']=$data->product_discounted_price;
            $associate['compareAtPrice']=$data->product_original_price;
            $associate['product_description']=$data->product_description;
            $associate['product_cart_description']=$data->product_cart_description;
            $associate['product_specification']=$data->product_cart_description;
            $associate['images']=json_decode($data->photos);
            $associate['tags']=json_decode($data->photos_tags);
            $associate['rating']= 0;
            $associate['reviews']=0;
             $associate['badges']='sale';
            $associate['availability']=2;
            $associate['categories']=[];
            $associate['attributes']=$data->attributes;
        
            // $associate['attributes']=[
            //     ['slug'=> 'color', 'values'=> 'dark-blue' ],
            //     ['slug'=> 'speed', 'values'=> '750-rpm','featured'=> true],
            //     ['slug'=> 'power-source', 'values'=> 'cordless-electric','featured'=> true],
            //     ['slug'=> 'battery-cell-type', 'values'=> 'lithium','featured'=> true],
            //     ['slug'=> 'voltage', 'values'=> '20-volts','featured'=> true],
            //     ['slug'=> 'battery-capacity', 'values'=> '2-Ah','featured'=> true]
            // ];
        }
        if($associate){
            return response()->json(['result'=>'success','message'=>"Successfull!",'data'=>$associate]); 
        }else{
            return response()->json(['result'=>'success','message'=>"Products not availiable!",'data'=>'']); 
        }
    }
       /**
     * Getting the specified resource of product for frontend.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProductsListImplement(Request $data){
        // dd($data->all());
        $brands="";
        $price_range="";
        if(($data->query("filter_price")!="undefined")){
            $price=explode("-",$data->query("filter_price"));
            $price_range="AND (products.product_discounted_price >= $price[0] AND products.product_discounted_price <= $price[1])";
        }
        // dd($price_range);
        if($data->query("filters_brand")!="undefined"){
            $brands=$data->query("filters_brand");
            $brands=explode(",",$brands);
            $brands=implode("','",$brands);
            $brands=DB::select("SELECT id FROM `brand` WHERE brand.slug IN('$brands') AND is_deleted=0");
            $brands=array_column($brands, 'id');
            $brands=implode(",",$brands);
            $brands="AND products.brand_id IN($brands)";
        }
        $page=$data->query('page')!="undefined"?$data->query('page'):1;
        $limit=$data->query('limit')!="undefined"?$data->query('limit'):12;
        $category=$data->query('filter_category')!="undefined"?$data->query('filter_category'):"undefined";
        $sort=$data->query('sort')!="undefined"?($data->query('sort')=='name_asc'?'asc':'desc'):'default';
        $order="";
        $sort!="default"?$order="ORDER BY products.name $sort":$order="";
        $category_data=$category!="undefined"?DB::table('categories')->select('id')->where(['is_deleted'=>0,'category_slug'=>$category])->first():"";
        $cat_id=isset($category_data->id)?"AND products.category_id=$category_data->id":"";
       
        $total="SELECT products.id as product_id,products.name as product_name,photos,thumbnail_img,product_original_price,product_discounted_price,product_discount,slug,attributes FROM products JOIN categories ON categories.id = products.category_id WHERE categories.is_deleted=0 AND products.is_deleted=0 $cat_id $order $brands $price_range ";
        $data=DB::select($total);
        $count=count($data);
        $pages=$count>0?round($count/$limit):1;
        $offset=($page-1)*$limit;

        $query="SELECT products.id as product_id,products.name as product_name,photos,thumbnail_img,product_original_price,product_discounted_price,product_discount,slug,attributes FROM products JOIN categories ON categories.id = products.category_id WHERE categories.is_deleted=0 AND products.is_deleted=0 $cat_id $order $brands $price_range LIMIT ".$offset.",".$limit;
        $data=DB::select($query);
        $reviewdata=DB::select("SELECT product_id,count(*) as count, avg(review_stars)as averageRating FROM `review` GROUP BY (product_id)");
        $reviewdataproduct=array_column($reviewdata,"product_id");
      
        $result=[];
        $associate=[];
        foreach($data as $row)
        {
            $index=array_search($row->product_id,$reviewdataproduct);
            $associate['id']=$row->product_id;
            $associate['slug']=$row->slug;
            $associate['customFields']=[];
            $associate['compareAtPrice']="";
            $associate['name']=$row->product_name;
            $associate['price']=$row->product_discounted_price;
            $associate['images']=json_decode($row->photos);
            $associate['rating']=$index!=false || $index===0?ceil($reviewdata[$index]->averageRating):0;
            $associate['reviews']=$index!=false || $index===0?ceil($reviewdata[$index]->count):0;
            $associate['sku']="83690/32";
            $associate['badges']=["new"];
            $associate['availability']="in-stock";
            $associate['categories']=[];
            $associate['attributes']=$row->attributes;
            $result[]=$associate;
        }
        $to_count=round(count($result))+$offset;
        $categorieList=array();
        $details=DB::table('categories')->where(['categories.is_deleted'=>0])
        ->join('products','products.category_id','=','categories.id')
        ->select(DB::raw("categories.*"))
        ->groupBy('categories.id')
        ->get();
        $count_prod=DB::table('categories')->where(['categories.is_deleted'=>0])
        ->join('products','products.category_id','=','categories.id')
        ->select(DB::raw("count(products.id) as containerProducts" ))
        ->groupBy('categories.id')
        ->get();
      if($details) {
        foreach ($details as $key => $entity) {
                $nestedData['id'] = $entity->id;
                $nestedData['name'] = $entity->name;
                $nestedData['slug'] = $entity->category_slug;
                // $nestedData['banner'] = $entity->banner;
                // $nestedData['icon'] = $entity->icon;
                $nestedData['alt_tag'] = $entity->alt_tag;
                $nestedData['title'] = $entity->name;
                $nestedData['url'] = '/shop';
                $nestedData['products'] =  $count_prod[$entity->id-1]->containerProducts;
                $nestedData['items'] = 272;
                $nestedData['parent'] = null;
                $nestedData['image'] = $entity->icon;
                $nestedData['subcategories'] = [
                    ['title'=>'Screwdrivers','url'=>'/shop'],
                    ['title'=>'Milling Cutters','url'=>'/shop'],
                    ['title'=>'Sanding Machines','url'=>'/shop'],
                    ['title'=>'Wrenches','url'=>'/shop'],
                    ['title'=>'Drills','url'=>'/shop']
                ];
                $categorieList[] = $nestedData;
        }
    }

    // $brandlist=[
    //     ["slug"=> "brandix", "name"=> "Brandix", "count"=> 5],
    //     ["slug"=> "zosch", "name"=> "Zosch", "count"=> 1],
    //     ["slug"=> "wakita", "name"=> "Wakita", "count"=> 2]
    // ];
    $brandlist=DB::select("SELECT * FROM `brand` WHERE is_deleted=0");
    $radio=[
        ["slug"=> "any", "name"=> "Any", "count"=> 16],
        ["slug"=> "no", "name"=> "No", "count"=> 15],
        ["slug"=> "yes", "name"=> "Yes", "count"=> 1]
    ];

    $colors=[
        ["slug"=> "white", "name"=> "White", "color"=> "#fff", "count"=> 1],
    ];
    $product=DB::select("SELECT MIN(product_discounted_price) as min_price,MAX(product_discounted_price) as max_price FROM `products` WHERE is_deleted=0");
    $min_price=isset($product[0]->min_price)?$product[0]->min_price:0;
    $max_price=isset($product[0]->max_price)?$product[0]->max_price:0;
    $filters=[
        ["type"=>"category","slug"=>"category", "name"=> "Categories", "items"=>$categorieList, "value"=> null],
        ["type"=>"range", "slug"=>"price", "name"=> "Price", "min"=>  $min_price, "max"=> $max_price,"value"=>[$min_price,$max_price]],
        ["type"=>"check", "slug"=>"brand", "name"=> "Brand", "items"=> $brandlist, "value"=> []],
        // ["type"=>"radio", "slug"=>"discount", "name"=> "Discount", "items"=> $radio, "value"=> "any"],
        // ["type"=>"color", "slug"=>"color", "name"=> "Color", "items"=> $colors, "value"=> []]
    ];
        
        if(count($result)>0){
            return response()->json(['from'=>$offset,'limit'=>$limit,'page'=>$page,'pages'=>$pages,'sort'=>'default','to'=>$to_count,'total'=>$count,'items'=>$result,'filters'=>$filters]); 
        }else{
            return response()->json(['result'=>'success','message'=>"Products not availiable!",'data'=>[]]); 
        }
}
  /**
     * Getting the specified resource of product for frontend.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCategoryBySlugImplement(Request $request)
    {
        $details = DB::table('categories')->where(['categories.is_deleted'=>0,'category_slug'=>$request->query('slug')])
                    ->select("categories.*")
                    ->first();
        $count_prod=DB::table('categories')->where(['categories.is_deleted'=>0])
                    ->join('products','products.category_id','=','categories.id')
                    ->select(DB::raw("count(products.id) as containerProducts" ))
                    ->groupBy('categories.id')
                    ->get();
        if($details) {
                    $nestedData['id'] = $details->id;
                    $nestedData['name'] = $details->name;
                    $nestedData['slug'] = $details->category_slug;
                    $nestedData['alt_tag'] = $details->alt_tag;
                    $nestedData['title'] = $details->name;
                    $nestedData['url'] = '/shop';
                    $nestedData['products'] =  $count_prod[$details->id-1]->containerProducts;
                    $nestedData['image'] = $details->icon;
                    $nestedData['subcategories'] = [
                        ['title'=>'Screwdrivers','url'=>'/shop'],
                        ['title'=>'Milling Cutters','url'=>'/shop'],
                        ['title'=>'Sanding Machines','url'=>'/shop'],
                        ['title'=>'Wrenches','url'=>'/shop'],
                        ['title'=>'Drills','url'=>'/shop']
                    ];
                    return response()->json(['result'=>'success','message'=>"Successfull!",'data'=>$nestedData]); 
        }
    }
        /**
     * Getting the specified resource of product for frontend.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getNavItemlist()
    {
        $data=[
            ["title"=>"Home","url"=>"/","props"=>["external"=>true]],
            ["title"=>"About Us","url"=>"/site","props"=>["external"=>true]],
            ["title"=>"Contact Us","url"=>"/site/contact-us","props"=>["external"=>true]],
            // ["title"=>"Blog","url"=>"/","props"=>["external"=>true]],
            // ["title"=>"Categories","url"=>"","submenu"=>["type"=> "categories","menu"=>["size"=>"nl","columns"=>[["size"=>6,"links"=>[["title"=>"Laptops","url"=>"","links"=>[["title"=>"hello","url"=>""]]]]]]]]]
        ];
        return response()->json(['result'=>'success','message'=>"Successfull!",'data'=>$data]); 
    }
    /**
     * Getting the specified resource of product for frontend.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getRelatedProducts(Request $data)
    {
        $limit=$data->limit;
        $category_slug=isset($data->category_slug)?$data->category_slug:'all';
        if($category_slug != 'all')
        $data=Product::Select('products.id as product_id','products.name as product_name','photos','thumbnail_img','product_original_price','product_discounted_price','product_discount','slug','attributes')->join('categories','categories.id','=','products.category_id')->where(['categories.category_slug'=>$category_slug,'categories.is_deleted'=>0,'products.is_deleted'=>0])->limit($limit)->get();
        else
        $data=Product::Select('products.id as product_id','products.name as product_name','photos','thumbnail_img','product_original_price','product_discounted_price','product_discount','slug','attributes')->join('categories','categories.id','=','products.category_id')->where(['categories.is_deleted'=>0,'products.is_deleted'=>0])->limit($limit)->get();
        $reviewdata=DB::select("SELECT product_id,count(*)as count, avg(review_stars)as averageRating FROM `review` GROUP BY (product_id)");
        $reviewdataproduct=array_column($reviewdata,"product_id");
      
        $result=[];
        $associate=[];
        foreach($data as $row)
        {
            $index=array_search($row->product_id,$reviewdataproduct);
            $associate['slug']=$row->slug;
            $associate['name']=$row->product_name;
            $associate['price']=$row->product_discounted_price;
            $associate['images']=json_decode($row->photos);
            $associate['rating']=$index!=false||$index===0?ceil($reviewdata[$index]->averageRating):0;
            $associate['reviews']=$index!=false||$index===0?ceil($reviewdata[$index]->count):0;
            $associate['badges']='sale';
            $associate['availability']=2;
            $associate['categories']=[];
            $associate['attributes']=$row->attributes;
            $result[]=$associate;
        }
        if(count($result)>0){
            return response()->json(['result'=>'success','message'=>"Successfull!",'data'=>$result]); 
        }else{
            return response()->json(['result'=>'success','message'=>"Products not availiable!",'data'=>'']); 
        }
    }
     /**
     * Getting the specified resource of product for frontend.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProductReviewsBySlug($slug){
        $reviews=[["avatar"=>"images/avatars/avatar-1.jpg","author"=>"Muzamil Ahmad","rating"=>5,"text"=>"Good Product","date"=>"12-January-2021"],["avatar"=>"images/avatars/avatar-2.jpg","author"=>"Muzamil Ahmad","rating"=>5,"text"=>"Good Product","date"=>"12-January-2021"],["avatar"=>"images/avatars/avatar-3.jpg","author"=>"Muzamil Ahmad","rating"=>5,"text"=>"Good Product","date"=>"12-January-2021"]];
        return response()->json(["result"=>"success","data"=>$reviews]);
    }
      /**
     * Getting the specified resource of product for frontend.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProductForBuyer($slug){
        $data=Product::where(['slug'=>$slug])->first();
        if(isset($data)){
            $data->photos = json_decode($data->photos);
            return response()->json(['result'=>'success','message'=>"Successfull!",'data'=>$data]); 
        }else{
            return response()->json(['result'=>'success','message'=>"Products not availiable!",'data'=>'']); 
        }
    }

  /**
     * Getting the specified resource of product for frontend.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request){
        // dd($request->quan);
        $count = 0;
        $user = auth()->user();
        $id = $user->id;
        $product = Product::where('slug','=',$request->slug)->first();
        // dd($product->id);
        if(!$product) {
            return response()->json([
                    "message" => "Product not found"
                ], 404);
        }

        $cart = DB::table('carts')->where('userId', '=', $id)->where('productId', '=', $product->id)->first();
        $quantity = isset($request->quan) ? $request->quan : 1;
        if($cart){
            DB::table('carts')
                ->where('userId', $id)
                ->where('productId',  $product->id)
                ->update(['quantity' => $quantity]);

            $quantity = DB::table('carts')->where('userId','=',$id)->get('quantity');
            // dd($quantity);
            foreach($quantity as $key =>$entity){
                // $nestedData['total'] = $entity->product_original_price;
                $count = $count + $entity->quantity;
            }
            
            return response()->json([
                "message" => "Product added to cart successfully",
                "count" => $count,
            ], 201); 
        }

        $added = DB::insert("INSERT INTO `carts` (`userId`, `productId`, quantity) VALUES ('$id', '$product->id','$quantity')");
        if (!$added) {
            return response()->json([
                "message" => "Something went wrong",
            ], 422);
        }
        $quantity = DB::table('carts')->where('userId','=',$id)->get('quantity');
        // dd($quantity);
        foreach($quantity as $key =>$entity){
            // $nestedData['total'] = $entity->product_original_price;
            $count = $count + $entity->quantity;
        }
        return response()->json([
            "message" => "Product added to cart successfully",
            "count" => $count,
        ], 201);        
    }
  /**
     * Getting the specified resource of product for frontend.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeFromCart($productId){

        $user = auth()->user();
        // return $user;
        $cart = DB::table('carts')->where('userId', '=', $user->id)->where('productId', '=', $productId)->first();
        // dd($cart);
        if(!$cart){
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }
        $del = DB::table('carts')->where('userId', '=', $user->id)->where('productId', '=', $productId)->delete();
        $count = DB::table('carts')->where('userId','=',$user->id)->count();
        if($del){
            return response()->json([
                "message" => "Product deleted",
                "count" => $count,
            ], 200);
        }
    }
  /**
     * Getting the specified resource of product for frontend.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getOrdersFromCart(){
        $user = auth()->user();

        $data = DB::table('carts')
            ->leftJoin('products', 'carts.productId', '=', 'products.id')
            ->where('userId','=',$user->id)
            ->select('products.id','products.name','products.product_description','products.thumbnail_img','products.product_discounted_price','product_discount','product_original_price','slug','photos as images','carts.quantity')
            ->get();
            // dd($data);
        $dat = [];
        $nestedData = [];
        // dd($data);
        $count = 0;
        $total = 0;
        $quantity = DB::table('carts')->where('userId','=',$user->id)->get('quantity');
        if($data){
            foreach ($data as $key => $entity) {
                $nestedData['id'] = $entity->id;
                $nestedData['options'] = [];
                $nestedData['product'] = $entity;
                $nestedData['price'] = $entity->product_original_price;
                $nestedData['quantity'] = $entity->quantity;
                $nestedData['product']->images = json_decode($entity->images);
                $nestedData['total'] = $entity->product_original_price;
                $count = $count + $entity->quantity;
                $total = $total + ( $entity->quantity * $entity->product_original_price );
                $dat[]=$nestedData;
            }
            // foreach ($quantity as $key => $quan) {
               
            // }
        }
        if($data){
            return response()->json([
                'orders' => $dat, 'quantity'=> $count, 'subtotal'=>$total,'total'=>$total
            ], 200);
        }
        // $data['orders']=  $orders;
        // $data['count']= $count;
    }
  /**
     * Getting the specified resource of product for frontend.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCartCount(){
        $user = auth()->user();
        // return $user->id;
        $count = DB::table('carts')->where('userId','=',$user->id)->count();
        if($count == 0 ){
            return response()->json([
                "message" => "No items in the cart"
            ], 404);
        }
        if(!$count){
            return response()->json([
                "message" => "Something went wrong"
            ], 500);
        }

        return response()->json($count, 201);
    }
      /**
     * Getting the Order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trackOrder(Request $request){
        // dd($request->all());
        if($request->trackOrderID){
            $orderData=DB::table('order_details')
            ->join('orders','order_details.order_id','=','orders.id')
            ->select('order_details.delivery_status')
            ->where(['orders.code'=>$request->trackOrderID])
            ->first();
            $status=isset($orderData->delivery_status)?$orderData->delivery_status:"default";
            if( $status=='pending'){
                $message="YOUR ORDER STATUS IS PENDING!";
            }else if($status=='shipped'){
                $message="YOUR ORDER ORDER HAS BEEN SHIPPED!";
            }else if($status=='delivered'){
                $message="YOUR ORDER ORDER HAS BEEN DELIVERED TO YOU!";
            }else{
                $message="YOUR ORDER CODE IS INNCORRECT!";
            }
            return response()->json(['result'=>'success','orderStatus'=>$message]);
        }else{
            return response()->json(['result'=>'success','orderStatus'=>"ENTER A CORRECT CODE!"]);
        }
        
    }
      /**
     * Getting the specified resource of product for frontend.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUserAddress(){
        try{
        $user_id=Auth()->user()->id;
        $result = DB::select("SELECT id,name,address1,address2,city,state,pincode,country,is_active FROM `address` WHERE user_id=$user_id AND is_deleted=0");
        //    return $result;
           //dd($user_id);
        return response()->json(['result'=>'success','message'=>"address fetched Successfully!",'data'=>$result]);
        }catch(Exception $ex){
                     return response()->json(['result'=>'error','message'=>"Something went wrong!!!",'data'=>'']); 
        }
    }
  /**
     * Getting the specified resource of product for frontend.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //     public function setUserAddress(Request $request){
    //     try{
    //     $user_id=Auth()->user()->id;
    //     $sqlQuery="INSERT INTO `address` (`name`, `address1`, `address2`,`city`,`state`,`pincode`,`country`,`is_active`,`user_id`) VALUES ('$request->name', '$request->address1', '$request->address2', '$request->city', '$request->state', '$request->pincode', '$request->country',".$request->is_active.",".$user_id.")";
    //     $res=DB::insert($sqlQuery);
    //             if ($res==true) {
    //                 return response()->json([
    //                     'message'   => "Saved Successfully",
    //                     'result'  => 'alert-success'
    //                 ]);
    //             }else{
    //                 return response()->json([
    //                     'message'   => "OOPS! Something went wrong",
    //                     'result'  => 'alert-danger'
    //                 ]);
    //             }
    // }
    // catch(Exception $ex){
    //     return response()->json(['result'=>'error','message'=>"Something went wrong!!!",'data'=>'']); 
    // }
    // }
/**
 * Getting the specified resource of product for frontend.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
// public function deleteUserAddress(){
//     try{
//         $user_id=Auth()->user()->id;
//         $res = DB::update("UPDATE `address` SET `is_deleted` = '1' WHERE `user_id` = $user_id");
//         if ($res==true) {
//                     return response()->json([
//                         'message'   => "Deleted Successfully",
//                         'result'  => 'alert-success'
//                     ]);
//                 }else{
//                     return response()->json([
//                         'message'   => "OOPS! Something went wrong",
//                         'result'  => 'alert-danger'
//                     ]);
//                 }
//     }
//     catch(Exception $ex){
//         return response()->json(['result'=>'error','message'=>"Something went wrong!!!",'data'=>'']); 
//     }
//     }
  /**
     * Getting the specified resource of product for frontend.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profileGet()
    {
        $user_id=Auth()->user()->id;
        $result=User::where(['id'=>$user_id])->first();
        $name = explode(" ", $result->name);
        $data=[];
        $data['email']=$result->email;
        $data['firstname']=isset($name[0])?$name[0]:"";
        $data['lastname']=isset($name[1])?$name[1]:"";
        return response()->json(['message'=>'success','data'=>$data]);
    }

    public function profileSet(Request $request)
    {
        $username=isset($request['firstname'])?$request['firstname']." ".$request['lastname']:"";
        $user_id=Auth()->user()->id;
        $result=User::where(['id'=>$user_id])->update(['name'=>$username]);
        return response()->json(['message'=>'success']);
    }
    // API to review order
    public function reviewOrder(Request $request)
    {
         //Getting the id of buyer
         $data=array();
         $user = auth()->user();
        //Getting product, user and address information from cart table
        $data=DB::table('carts')->leftjoin('products','products.id','=','carts.productId')->select('name','userId','productId','quantity','product_discounted_price','product_discount','product_description')->where(['carts.userId'=>$user->id])->get();
        
        //Getting address of the buyer
        $shipping_address=DB::table('address')
        ->leftjoin('users','address.user_id','=','users.id')
        ->select('users.email','address.name','address.address1','address.address2','address.city','address.state','address.country','address.pincode')
        ->where(['address.user_id'=>$user->id,'address.is_active'=>1,'address.is_deleted'=>0])->first();
        // dd($shipping_address);
        // $json_shipping_adress=json_encode($shipping_address);
        // $orders->shipping=$json_shipping_adress;
        $data['shipping']=$shipping_address;
        return response()->json(['result'=>'success','order'=>$data]);

    }
    // API to store order
    public function storeOrder(Request $request)
    {   
        //Getting the id of buyer
        $user = auth()->user();
        if(isset($request->name)){
            // dd($request->all());
            $sqlQuery="INSERT INTO `address` (`name`, `address1`, `address2`,`city`,`state`,`pincode`,`country`,`is_active`,`user_id`) VALUES ('$request->name', '$request->street', '$request->address', '$request->city', '$request->state', '$request->zip', '$request->country', 1 ,".$user->id.")";
            $res=DB::insert($sqlQuery);
            if(!$res){
                return response()->json(['message'=>'something went wrong']);
            }
        }
        //Getting product, user and address information from cart table
        $orders=DB::table('carts')->leftjoin('products','products.id','=','carts.productId')->where(['carts.userId'=>$user->id])->get();
        
        //Getting address of the buyer
        $shipping_address=DB::table('address')
            ->leftjoin('users','address.user_id','=','users.id')
            ->select('users.email','address.name','address.address1','address.address2','address.city','address.state','address.country','address.pincode')
            ->where(['address.user_id'=>$user->id,'address.is_active'=>1])->first();
            $json_shipping_adress=json_encode($shipping_address);
        // dd($shipping_address->email);
        //Saving order info in order table
        $order_code = date('Ymd-His').rand(10,99);
        $order_date = date('Y-m-d H:i:s');
        $grand_total=0;
        $shipping_cost=0;
        try {
            $order_id=DB::transaction(function () use($json_shipping_adress,$grand_total,$order_code,$order_date,$shipping_cost,$orders) {
                    $user = auth()->user();
                    $order_id = DB::table('orders')->insertGetId(['user_id'=>$user->id,'shipping_address'=>$json_shipping_adress,'grand_total'=>$grand_total,'code'=>$order_code,'payment_status'=>'unpaid','payment_details'=>'pending','shipping_cost'=>$shipping_cost,'created_at'=>$order_date,'updated_at'=>$order_date]);
                    //saving order data in order_details
                    foreach($orders as $order){
                        $quantity=$order->quantity;
                        $result=DB::table('order_details')->insertGetId(['order_id'=>$order_id,'product_id'=>$order->productId,'price'=>$order->product_discounted_price,'actual_price'=>$order->product_original_price,'quantity'=>$quantity,'tax'=>$order->product_tax,'discount'=>$order->product_discount,'shipping_cost'=>$shipping_cost,'shipping_type'=>'home delivery','created_at'=>$order_date,'updated_at'=>$order_date]);
                    // decrement the products quantity by the order quantity.
                    }   
                    return $order_id;
            });
        }catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        //Creates the pdf for invoice
        $generalsetting = \DB::table('general_settings')->first(); 
        $order=\DB::table('orders')->where(['id'=>$order_id])->first(); 
        $order_details=\DB::table('order_details')->join('products','products.id','=','order_details.product_id')->where(['order_id'=>$order_id])->get();
      
        $pdf = PDF::loadView('invoices.customer_invoice',['generalsetting'=>$generalsetting,'order'=>$order,'order_details'=>$order_details])->setPaper('a4', 'landscape');
        $output = $pdf->Output();
        file_put_contents('invoices/'.'Order#'.$order_code.'.pdf', $output);
        $array['view'] = 'emails.invoice';
        $array['subject'] = 'Order Placed - '.$order_code;
        $array['from'] = env('MAIL_USERNAME');
        // $array['content'] = 'Hi. A new order has been placed. Please check the attached invoice.';
        $array['content'] = 'Hi. A new order has been placed. Please check the attached invoice.';
        $array['file'] = 'invoices/Order#'.$order_code.'.pdf';
        $array['file_name'] = 'Order#'.$order_code.'.pdf';
        //sends email to customer with the invoice pdf attached
        if(env('MAIL_USERNAME') != null){
            try {
                Mail::to($shipping_address->email)->queue(new InvoiceEmailManager($array));
                // Mail::to(User::where('user_type', 'admin')->first()->email)->queue(new InvoiceEmailManager($array));
                } catch (\Exception $e) {
                    return $e;
                }
        }

       //Getting product, user and address information from cart table
        $result=DB::table('carts')->where(['userId'=>$user->id])->delete();
        $ordersPlaced=DB::table('order_details')
        ->leftjoin('products','products.id','=','order_details.product_id')
        ->select('products.name','order_details.quantity','products.product_discounted_price','order_details.created_at','products.thumbnail_img','products.thumbnail_img_tag')
        ->where(['order_id'=>$order_id])->get();
        $defaultAddress = DB::table('address')->where(['user_id'=>$user->id,'is_active'=>1])->first();
        return response()->json(['result'=>'success','message'=>"Your order has been successfully placed!",'data'=>['order_code'=>$order_code, 'ordersPlaced'=>$ordersPlaced, 'address'=>$defaultAddress]]);
    }

    public function setUserAddress(Request $request){
        try{
            $user_id=Auth()->user()->id;
            if($request->id){
                $res = DB::update("UPDATE `address` SET `is_active` = '1' WHERE `user_id` = $user_id AND `id` = $request->id AND `is_deleted` = '0'");
                $result = DB::update("UPDATE `address` SET `is_active` = '0' WHERE `user_id` = $user_id AND `id` != $request->id AND `is_deleted` = '0'");
                if($res){
                    return response()->json([
                        'message'   => "Address Selected Successfully",
                        'result'  => 'alert-success'
                    ]);
                }
            }
            else{
                DB::update("UPDATE `address` SET `is_active` = '0' WHERE `user_id` = $user_id AND `is_deleted` = '0'");
                $sqlQuery="INSERT INTO `address` (`name`, `address1`, `address2`,`city`,`state`,`pincode`,`country`,`is_active`,`user_id`) VALUES ('$request->name', '$request->address1', '$request->address2', '$request->city', '$request->state', '$request->zip', '$request->country', 1 ,".$user_id.")";
                $res=DB::insert($sqlQuery);
                $sqlQuery="SELECT * FROM `address` WHERE id = (SELECT MAX(id) FROM `address` WHERE `user_id` = $user_id AND `is_deleted` = '0')";
                $response=DB::select($sqlQuery);
                    if ($res==true) {
                        return response()->json([
                            'message'   => "Saved Successfully",
                            'result'  => 'alert-success',
                            'successData'  => $response
                        ]);
                    }else{
                        return response()->json([
                            'message'   => "OOPS! Something went wrong",
                            'result'  => 'alert-danger'
                        ]);
                    }
                    }
            }
        catch(Exception $ex){
        return response()->json(['result'=>'error','message'=>"Something went wrong!!!",'data'=>'']); 
        }   
    }

    public function deleteUserAddress($id){
        try{
            $user_id = Auth()->user()->id;
            $res = DB::update("UPDATE `address` SET `is_deleted` = '1' WHERE `user_id` = $user_id AND `id` = $id");
            if ($res==true) {
                        return response()->json([
                            'message'   => "Deleted Successfully",
                            'result'  => 'alert-success'
                        ]);
                    }else{
                        return response()->json([
                            'message'   => "OOPS! Something went wrong",
                            'result'  => 'alert-danger'
                        ]);
                    }
        }
        catch(Exception $ex){
            return response()->json(['result'=>'error','message'=>"Something went wrong!!!",'data'=>'']); 
        }
    }

    public function changeProductQuantity(Request $request){
        try{
            $user_id = Auth()->user()->id;
            $res = DB::update("UPDATE `carts` SET `quantity` = $request->quantity WHERE `productId` = $request->id AND `userId` = $user_id");
            
            $data = DB::table('carts')
            ->leftJoin('products', 'carts.productId', '=', 'products.id')
            ->where('userId','=',$user_id)
            ->select('products.id','products.name','products.product_description','products.thumbnail_img','products.product_discounted_price','product_discount','product_original_price','slug','photos as images','carts.quantity')
            ->get();
            $quantity = DB::table('carts')->where('userId','=',$user_id)->get('quantity');
            // dd($quantity);
            $count = 0;
            $total = 0;
            foreach($data as $key =>$entity){
                // $nestedData['total'] = $entity->product_original_price;
                $count = $count + $entity->quantity;
                $total = $total + ( $entity->quantity * $entity->product_original_price );
            }
            // dd($count,$total);
            if ($res) {
                return response()->json([
                    'message'   => "Qunatity changed Successfully",
                    'result'  => 'alert-success',
                    'quantity'=> $count, 'subtotal'=>$total,'total'=>$total
                ], 201);
            }else{
                return response()->json([
                    'message'   => "OOPS! Something went wrong",
                    'result'  => 'alert-danger'
                ], 500);
            }

        }
        catch(Exception $ex){
            return response()->json(['result'=>'error','message'=>"Something went wrong!!!",'data'=>'']); 
        }
    }

    public function searchProduct(Request $request){
        // return $request->searchItem;
        $res = DB::table('products')->select('id','name','thumbnail_img','thumbnail_img_tag','slug')->where('name', 'LIKE', '%' . $request->searchItem . '%')->get();
        return $res;       
    }
  /**
     * Getting the specified resource of products for frontend.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    public function getCarousalsProductsForBuyer($id)
    {
        $data=Product::Select('id','name','photos','thumbnail_img','featured_img','flash_deal_img','product_original_price','product_discounted_price','product_discount','product_quantity','product_tax','product_description','slug')->where(['carousal_id'=>$id])->get();
        if(count($data)>0){
            return response()->json(['result'=>'success','message'=>"Successfull!",'data'=>$data]); 
        }else{
            return response()->json(['result'=>'success','message'=>"Products not availiable!",'data'=>'']); 
        }

    }
    // Get offers for buyer
    public function getAllTagsWithProducts()
    {
       // $data=array();
        $tags=DB::table('tags')->where(['tags.is_deleted'=>0])
        ->join('products','products.tag_id','=','tags.id')->where(['products.is_deleted'=>0])
        ->select(DB::raw("tags.*"))
        ->orderBy('tags.id')
        ->get();
     
       // $tags = DB::table('tags')->get();
       $data=[];
        foreach($tags as $tag){
            $tagProducts = DB::table('products')->where(['tag_id'=>$tag->id])->limit(6)->get();
            $data[$tag->tag_name]=$tagProducts;
        }
        return response()->json(['result'=>'success','data'=>$data]);
    }

    //Get order of sign in buyer
    public function getMyOrders(Request $request){
        $user_id=Auth::user()->id;
        $orders=DB::table('orders')->leftjoin('order_details','orders.id','=','order_details.order_id')->leftjoin('products','products.id','=','order_details.product_id')->select('*', 'order_details.id as orderDetailsId', 'order_details.is_deleted as orderCancelled')->where(['orders.user_id'=>$user_id,'orders.is_deleted'=>0])->get();
        return response()->json(['message'=>'success','order'=>$orders]);
    }

    public function cancelOrder(Request $request){
        DB::update("UPDATE `order_details` SET `is_deleted` = '1' WHERE `id` = '$request->id' AND `is_deleted` = '0'");
        return response()->json(['message'=>'Order Cancelled Successfully','status'=>200]);
    }

    public function getProductsWithoutLogin(Request $request){

        $count = count($request->ids[0]);

        // $orders = DB::table('products')->whereIn('id',$request->ids[0])->get();

//         SELECT * FROM (
//     SELECT id,name,surname, 1 as type_user
//     FROM table_name
// ) as `ta`
// WHERE ta.type_user = 1;
        $links = implode(',', $request->ids[0]);
        $orders = DB::select( DB::raw("SELECT * FROM (SELECT *, 1 as quantity FROM products ) as `ta` WHERE ta.id IN($links)"));
        // dd($orders);
        if($count === 0){
            return response()->json([
                "message" => "Orders not found",
            ], 404);
        }
        $data['orders']=  $orders;
        $data['count']= $count;

        return response()->json($data, 200);
    }
// for reviews....
// public function getProductReviewsBySlug($slug){
       
//     try{  
      
//         $result = DB::select("SELECT * FROM `review` WHERE `product_slug`='$slug'");
//         if($result)
//              return response()->json(['result'=>'success','data'=>$result,'message'=>""]);
//         else{
//             return response()->json([
//                 'message'   => "OOPS! Something went wrong",
//                 'result'  => 'failure'
//             ]);
//           }
//     }catch(Exception $ex){
//                  return response()->json(['result'=>'error','message'=>"Contact your system admintrator!",'data'=>'']); 
//     }
 
// }
public function setProductReviewsBySlug(Request $request){
    try{  
        $result = DB::insert("INSERT INTO  `review` (`your_review`, `your_email`, `your_name`,`product_slug`,`review_stars`,`product_id`) VALUES ('$request->your_review', '$request->your_email', '$request->your_name', '$request->product_slug', '$request->review_stars', '$request->product_id' ");
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



    public function defaultAddress(Request $request){
        $user = auth()->user();
        $id = $user->id;
        $addresses = DB::table('address')->where(['user_id'=>$id,'is_active'=>1])->first();
        return response()->json($addresses, 200);
    }
}
