<?php

use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\User;
use App\Http\Livewire\Admin;

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

//Route::get('/', function () {
//
//    return view('welcome');
//});

Route::get('/', ["uses"=>"App\Http\Controllers\ProductsController@index",'as'=>'allProducts']);

Route::get('/product', ["uses"=>"App\Http\Controllers\ProductsController@index",'as'=>'allProducts']);

//Fruit
Route::get('/fruit', ["uses"=>"App\Http\Controllers\ProductsController@fruitProducts",'as'=>'fruitProducts']);

//Vegetables
Route::get('/vegetables', ["uses"=>"App\Http\Controllers\ProductsController@vegetablesProducts",'as'=>'vegetablesProducts']);

//Search
Route::get('search', ["uses"=>"App\Http\Controllers\ProductsController@search",'as'=>'searchProducts']);


Route::get('product/addToCart/{id}',['uses'=>"App\Http\Controllers\ProductsController@addProductToCart",'as'=>'AddToCartProduct']);

//show cart item
Route::get('cart', ["uses"=>"App\Http\Controllers\ProductsController@showCart",'as'=>'cartproducts']);

//delete item from cart
Route::get('product/deleteFromCart/{id}',['uses'=>"App\Http\Controllers\ProductsController@deleteItemFromCart",'as'=>'DeleteItemFromCart']);

//checkout Page
Route::get('checkoutProducts',['uses'=>"App\Http\Controllers\ProductsController@checkoutProducts",'as'=>'checkoutProducts']);

//process checkout Page
Route::post('product/createNewOrder/',['uses'=>"App\Http\Controllers\ProductsController@createNewOrder",'as'=>'createNewOrder']);

//checkout Page
Route::post('product/createOrder',['uses'=>"App\Http\Controllers\ProductsController@createOrder",'as'=>'createOrder']);


//increase single product
Route::get('product/incSingleProduct/{id}',['uses'=>"App\Http\Controllers\ProductsController@incSingleProduct",'as'=>'incSingleProduct']);
//decrease single product

Route::get('product/decSingleProduct/{id}',['uses'=>"App\Http\Controllers\ProductsController@decSingleProduct",'as'=>'decSingleProduct']);



//For User
Route::middleware('auth:sanctum', 'verified')->group(function (){
    Route::get('/user/dashboard',UserDashboardComponent::class)->name('user.dashboard');
});

//For Admin
//Route::middleware('auth:sanctum', 'verified','authadmin')->group(function (){
//    Route::get('/admin/dashboard',AdminDashboardComponent::class)->name('admin.dashboard');
//});

Route::middleware('auth:sanctum', 'verified','authadmin')->group(function (){
    Route::get('/admin/dashboard',["uses"=>"App\Http\Controllers\Admin\AdminProductsController@index"])->name('admin.dashboard');

    //Admin Panel: Edit Format form
    Route::get('/admin/editProductForm/{id}',
        ["uses"=>"App\Http\Controllers\Admin\AdminProductsController@editProductForm"])->name('adminEditProductForm');

    //Admin Panel: Edit Format for display
    Route::get('/admin/editProductImageForm/{id}',
        ["uses"=>"App\Http\Controllers\Admin\AdminProductsController@editProductImageForm"])->name('adminEditProductImageForm');

    //Post update product image
    Route::post('/admin/updateProductImage/{id}',
        ["uses"=>"App\Http\Controllers\Admin\AdminProductsController@updateProductImage"])->name('adminUpdateProductImage');

    //Post update product data
    Route::post('/admin/updateProduct/{id}',
        ["uses"=>"App\Http\Controllers\Admin\AdminProductsController@updateProduct"])->name('adminUpdateProduct');

    //Admin Panel: Add Format form Post
    Route::post('/admin/addProductForm',
        ["uses"=>"App\Http\Controllers\Admin\AdminProductsController@addProductForm"])->name('adminAddProduct');

    //delete product
    Route::get('/admin/deleteProduct/{id}',
        ["uses"=>"App\Http\Controllers\Admin\AdminProductsController@deleteProduct"])->name('adminDeleteProduct');


    //User post
    Route::post('/admin/addUserForm',
        ["uses"=>"App\Http\Controllers\Admin\AdminProductsController@addUserForm"])->name('adminAddUser');

    //Admin Panel: User display
    Route::get('/admin/addUserDisplay',
        ["uses"=>"App\Http\Controllers\Admin\AdminProductsController@addUserDisplay"])->name('adminAddUserDisplay');

    //Admin User Dash
    Route::get('/admin/usersDashboard',["uses"=>"App\Http\Controllers\Admin\AdminProductsController@userList"])->name('admin.dashboard.userList');

    //delete User
    Route::get('/admin/usersListDelete/{id}',
        ["uses"=>"App\Http\Controllers\Admin\AdminProductsController@deleteUser"])->name('adminDeleteUser');

    //Admin Panel: Edit User get form
    Route::get('/admin/editUserForm/{id}',
        ["uses"=>"App\Http\Controllers\Admin\AdminProductsController@editUserForm"])->name('adminEditUserForm');

    //Post update product data
    Route::post('/admin/updateUser/{id}',
        ["uses"=>"App\Http\Controllers\Admin\AdminProductsController@updateUser"])->name('adminUpdateUser');

    //Admin Code Dash
    Route::get('/admin/codesDashboard',["uses"=>"App\Http\Controllers\Admin\AdminProductsController@codeList"])->name('admin.dashboard.codeList');

    //Admin order item Dash
    Route::get('/admin/orderitemDashboard',["uses"=>"App\Http\Controllers\Admin\AdminProductsController@orderList"])->name('admin.dashboard.orderitemList');

    //Add code post
    Route::post('/admin/addCodeForm',
        ["uses"=>"App\Http\Controllers\Admin\AdminProductsController@addCodeForm"])->name('adminAddCode');

    //Admin Panel: details order get form
    Route::get('/admin/orderDetails/{id}',
        ["uses"=>"App\Http\Controllers\Admin\AdminProductsController@orderDetails"])->name('adminOrderDetails');

    //delete User
    Route::get('/admin/orderListDelete/{id}',
        ["uses"=>"App\Http\Controllers\Admin\AdminProductsController@deleteOrder"])->name('adminDeleteOrder');

});




////Post update product image
//Route::middleware('auth:sanctum', 'verified','authadmin')->group(function (){
//    Route::post('/admin/updateProductImage/{id}',["uses"=>"App\Http\Controllers\Admin\AdminProductsController@updateProductImage"])->name('adminUpdateProductImage');
//});



//Route::middleware(['auth:sanctum', 'verified'])->red('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');
