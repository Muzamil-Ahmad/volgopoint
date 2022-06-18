<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('contact','ContactController@index');
    Route::post('password_reset', 'PasswordController@reset');
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::get('user', 'AuthController@get');
    Route::post('forgot_password', 'PasswordController@forgot');
    // Route::get('reset_password/{email}/{code}', 'PasswordController@reset');
    Route::delete('user/{id}', 'AuthController@delete');
    Route::get('user/{id}', 'AuthController@edit');
    Route::post('user/{id}', 'AuthController@update');
});

Route::group([
    'middleware' => 'auth:api'
], function() {
     //Attributes
     Route::get('attribute', 'AttributeController@get');
     Route::post('attribute', 'AttributeController@create');
     Route::get('attribute/{id}', 'AttributeController@edit');
     Route::post('attribute/{id}', 'AttributeController@update');
     Route::delete('attribute/{id}', 'AttributeController@delete');
    //reviews
    Route::get('buyer/productReviewsBySlug/{slug}','ApiController@getProductReviewsBySlug');
    Route::post('buyer/productReviewsBySlug','ApiController@setProductReviewsBySlug');
  

    //User
    Route::get('logout', 'AuthController@logout');
    Route::get('user', 'AuthController@user');
    
    //categories
    Route::get('categories', 'CategoryController@get');
    Route::post('categories', 'CategoryController@create');
    Route::get('categories/{id}', 'CategoryController@edit');
    Route::post('categories/{id}', 'CategoryController@update');
    Route::delete('categories/{id}', 'CategoryController@delete');
    
    //Product
    Route::get('products', 'ProductController@index');
    Route::post('products', 'ProductController@create');
    Route::get('products/{id}', 'ProductController@edit');
    Route::post('products/{id}', 'ProductController@update');
    Route::delete('products/{id}', 'ProductController@delete');


   //Feedback
   Route::post('feedback', 'FeedbackController@create');
   Route::get('feedback', 'FeedbackController@get');
    // subcategories
    Route::post('subcategories', 'SubcategoryController@create');
    Route::get('subcategories', 'SubcategoryController@get');
    Route::get('subcategories/{id}', 'SubcategoryController@edit');
    Route::post('subcategories/{id} ', 'SubcategoryController@update');
    Route::delete('subcategories/{id} ', 'SubcategoryController@delete');
    
    // orders
    Route::get('orders', 'OrdersController@index');
    Route::get('orders/view/', 'OrdersController@view');
    Route::delete('orders/{id}', 'OrdersController@delete');
    // Route::post('orders/paystatus', 'OrdersController@paystatus'); 
    Route::post('orders/deliverystatus', 'OrdersController@changeDeliveryStatus'); 
    Route::get('orders/deliverystatus','OrdersController@getDeliveryStatus');
    Route::post('orders/paymentstatus', 'OrdersController@changePaymentStatus'); 
    Route::get('orders/paymentstatus','OrdersController@getPaymentStatus');

    //configuration_settings
    Route::get('generalsettings', 'GeneralSettingsController@get');
    Route::post('generalsettings/edit/{id}', 'GeneralSettingsController@edit');
    //brands
    Route::get('brand', 'BrandController@get');
    Route::post('brand', 'BrandController@create');
    Route::get('brand/{id}', 'BrandController@edit');
    Route::post('brand/{id}', 'BrandController@update');
    Route::delete('brand/{id} ', 'BrandController@delete');

    //roles
    Route::get('roles', 'RolesController@get');
    Route::post('roles', 'RolesController@create');
    Route::get('roles/{id}', 'RolesController@edit');
    Route::post('roles/{id}', 'RolesController@update');
    Route::delete('roles/{id} ', 'RolesController@delete');
    
    
    //profile
   Route::get('profile/{email}', 'ProfileController@get');
   Route::post('profile', 'ProfileController@update');


   //settings
   Route::get('settings', 'SettingsController@get');
   Route::post('settings', 'SettingsController@update');

   //SMTP Settings
   Route::get('smtp', 'SettingsController@getSmtp');
   Route::post('smtp', 'SettingsController@updateSmtp');

    //dashboard
    Route::get('dashboard','DashboardController@get');
    
    //cart apis
    Route::post('order/add-to-cart', 'ApiController@addToCart');
    Route::delete('order/remove-from-cart/{id}', 'ApiController@removeFromCart');
    Route::get('order/get-orders-from-cart','ApiController@getOrdersFromCart');
    Route::post('order/change-product-quantity','ApiController@changeProductQuantity');
   
    Route::get('buyer/count', 'ApiController@getCartCount');
//     Route::get('order/get-orders-from-cart/{id}', 'ApiController@getOrdersFromCart');
    //buyer_addresses
    Route::get('buyer/addresses','ApiController@getUserAddress');
    Route::post('buyer/addresses','ApiController@setUserAddress');
    Route::delete('buyer/addresses','ApiController@deleteUserAddress');
    Route::get('buyer/defaultAddress','ApiController@defaultAddress');

    //Profile data of Buyer
    Route::get('buyer/profile','ApiController@profileGet');
    Route::post('buyer/profile','ApiController@profileSet');
    // //buyer_addresses
    // Route::get('buyer/addresses','ApiController@getUserAddress');
    // Route::post('buyer/addresses','ApiController@setUserAddress');
    // Route::delete('buyer/addresses','ApiController@deleteUserAddress');

    //Order API
    Route::get('buyer/orders','ApiController@reviewOrder');
    Route::post('buyer/orders','ApiController@storeOrder');
    Route::post('buyer/cancelorder','ApiController@cancelOrder');
    Route::get('buyer/myorders','ApiController@getMyOrders');
    Route::delete('buyer/addresses/{id}','ApiController@deleteUserAddress');

     //Carousal
     Route::get('carousals', 'CarosalController@index');
     Route::post('carousals', 'CarosalController@create');
     Route::get('carousals/{id}', 'CarosalController@edit');
     Route::post('carousals/{id}', 'CarosalController@update');
     Route::delete('carousals/{id}', 'CarosalController@delete');
     
     //Tags
     Route::get('tags', 'TagsController@index');
     Route::get('tags/product', 'TagsController@offersForAddProduct');
     Route::get('tags/categories', 'TagsController@categoriesForAddProduct');
     Route::get('tags/subcategories', 'TagsController@subcategoriesForAddProduct');
     Route::get('tags/carousal', 'TagsController@carousalForAddProduct');
     Route::get('tags/attributes', 'TagsController@attributesForAddProduct');
     Route::get('tags/brand', 'TagsController@brandsForAddProduct');
     Route::post('tags', 'TagsController@create');
     Route::get('tags/{id}', 'TagsController@edit');
     Route::post('tags/{id}', 'TagsController@update');
     Route::delete('tags/{id}', 'TagsController@delete');

     
});

Route::get('buyer/products/{category_id}', 'ApiController@getCategoryProductsForBuyer');
Route::get('buyer/product/{slug}', 'ApiController@getProductForBuyer');
Route::get('buyer/categories', 'ApiController@getCategoriesForBuyer');
Route::post('search', 'ApiController@searchProduct');
Route::get('buyer/carousals/products/{carousal_id}', 'ApiController@getCarousalsProductsForBuyer');
Route::get('carousals', 'CarosalController@index');
Route::get('getalltagswithproducts', 'ApiController@getAllTagsWithProducts');
Route::post('getproductswithoutlogin', 'ApiController@getProductsWithoutLogin');

Route::post('buyer/popularProducts', 'ApiController@getPopularProductsForBuyer');
Route::post('buyer/latestProducts', 'ApiController@getLatestProductsForBuyer');
Route::post('buyer/topRatedProducts', 'ApiController@getTopRatedProductsForBuyer');
Route::post('buyer/discountedProducts', 'ApiController@getDiscountedProductsForBuyer');
Route::post('buyer/getProductBySlug/{slug}', 'ApiController@getProductBySlug');
Route::post('buyer/productsList', 'ApiController@getProductsListImplement');
Route::post('buyer/getCategoryBySlugImplement', 'ApiController@getCategoryBySlugImplement');
Route::post('buyer/getNavItemlist', 'ApiController@getNavItemlist');
Route::post('buyer/relatedProducts', 'ApiController@getRelatedProducts');
Route::get('buyer/productReviewsBySlug/{slug}', 'ApiController@getProductReviewsBySlug');
Route::post('buyer/productReviewsBySlug', 'ApiController@setProductReviewsBySlug');
Route::post('buyer/trackorder', 'ApiController@trackOrder');

 //Download PDF


//remove it later, it is test purpose for react cms
// Route::get('dashboard','DashboardController@get');

