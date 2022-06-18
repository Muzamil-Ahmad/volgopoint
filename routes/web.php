<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::group([
    'middleware' => ['IsLoggedIn'],
], function ($router) {
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    });
    Route::get('/category/show', function () {
        return view('pages.category.show');
    });
    
    Route::get('/user/profile', function () {
        return view('pages.user.profile');
    });
    Route::get('/user/show', function () {
        return view('pages.user.show');
    });
    Route::get('/user/create', function () {
        return view('pages.user.create');
    });
    Route::get('/user/edit/{id}', function ($id) {
        return view('pages.user.edit',['id' => $id]);
    });
    Route::get('/category/edit/{id}', function ($id) {
        return view('pages.category.edit',['id' => $id]);
    });
   
    Route::get('/category/create', function () {
        return view('pages.category.create');
    });
    Route::get('/subcategory/show', function () {
        return view('pages.subcategory.show');
    });
    Route::get('/subcategory/create', function () {
        return view('pages.subcategory.create');
    });
    Route::get('/subcategory/edit/{id}', function ($id) {
        return view('pages.subcategory.edit',['id' => $id]);
    });
    // Route::get('/category/show','CategoryController@showAll');
    Route::get('/products/show', function () {
        return view('pages.product.show');
    });
    Route::get('/product/create', function () {
        return view('pages.product.create');
    });
    Route::get('/product/edit/{id}', function ($id) {
        return view('pages.product.edit',['id' => $id]);
    });
    Route::get('/brand/show', function () {
        return view('pages.brand.show');
    });
    Route::get('/brand/create', function () {
        return view('pages.brand.create');
    });
    Route::get('/brand/edit/{id}', function ($id) {
        return view('pages.brand.edit',['id' => $id]);
    });
    Route::get('/attributes/show', function () {
        return view('pages.attributes.show');
    });
    Route::get('/attributes/create', function () {
        return view('pages.attributes.create');
    });
    Route::get('/attributes/edit/{id}', function ($id) {
        return view('pages.attributes.edit',['id' => $id]);
    });
    Route::get('/orders', function () {
        return view('pages.order.show');
    });
    Route::get('/orders/view/{id}', function ($id) {
        return view('pages.order.view',['id' => $id]);
    });
    Route::get('/roles/show', function () {
        return view('pages.roles.show');
    });
    Route::get('/roles/create', function () {
        return view('pages.roles.create');
    });
    Route::get('/roles/edit/{id}', function ($id) {
        return view('pages.roles.edit',['id' => $id]);
    });
    // Route::get('/smtp_settings/show', function () {
    //     CoreComponentRepository::instantiateShopRepository();
    //     return view('pages.smtp_settings.show');
    // });
    Route::get('/smtp_settings/show', 'SettingsController@index');
    // Route::get('/general_settings/edit/{id}', function ($id) {
    //     return view('pages.general_settings.edit',['id' => $id]);
    // });
    Route::get('/order/view', function () {
        return view('pages.order.view');
    });
    Route::get('/order/download-invoice/{OrderID}', 'OrdersController@downloadOrderInvoice');
    Route::get('/settings/show', function () {
        return view('pages.settings.show');
    });
    Route::get('/carousal/show', function () {
        return view('pages.carousal.show');
    });
    Route::get('/carousal/create', function () {
        return view('pages.carousal.create');
    });
    Route::get('/carousal/{id}', function ($id) {
        return view('pages.carousal.edit',['id' => $id]);
    });
    Route::get('/tags/show', function () {
        return view('pages.tags.show');
    });
    Route::get('/tags/create', function () {
        return view('pages.tags.create');
    });
    Route::get('/tags/{id}', function ($id) {
        return view('pages.tags.edit',['id' => $id]);
    });
    
});
// Route::get('/', function () {
//     return view('invoices.customer_invoice');
// });
Route::get('/admin', function () {
    return view('pages.login');
});


Route::get('/forgot_password', function () {
        return view('pages.security.forgot_login');
});

Route::get('/reset_password/{email}', function () {
    return view('pages.security.reset_password_form');
});


Route::post('/env_key_update', 'SettingsController@env_key_update')->name('env_key_update.update');
