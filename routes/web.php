<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillController;
use App\Http\Controllers\FileController;
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
//client
Route::post('/account/upload', 'App\Http\Controllers\FileController@viewFile');
Route::get('/','App\Http\Controllers\HomeController@index');
Route::post('/seacherOther','App\Http\Controllers\HomeController@seacherOther');
Route::get('/404page', 'App\Http\Controllers\LoginController@pageError');
Route::get('/products/{title}', 'App\Http\Controllers\HomeController@checkLinhProduct');
Route::post('/addCart', 'App\Http\Controllers\HomeController@addCartProduct');
Route::get('/loginClient', 'App\Http\Controllers\HomeController@login');
Route::get('/account/signup', 'App\Http\Controllers\HomeController@signUp');
Route::post('/account/create', 'App\Http\Controllers\HomeController@createUser');
Route::post('/account/checkLoginClient', 'App\Http\Controllers\HomeController@checkLoginClient');
Route::get('/checkouts', 'App\Http\Controllers\HomeController@checkOut');
Route::get('/cart', 'App\Http\Controllers\HomeController@cart');
Route::get('/getCity', 'App\Http\Controllers\HomeController@getCity');
Route::get('/getDistrict/{id}', 'App\Http\Controllers\HomeController@getDistrict');
Route::get('/getWard/{id}', 'App\Http\Controllers\HomeController@getWard');
Route::post('/deleteCart', 'App\Http\Controllers\HomeController@deleteCart');
Route::post('/qualityPlus/{id}', 'App\Http\Controllers\HomeController@qualityPlus');
Route::get('/account/view=account_info.smb', 'App\Http\Controllers\HomeController@user');
Route::get('/account/view=order.smb', 'App\Http\Controllers\HomeController@other');
Route::get('/account/view=addresses.smb', 'App\Http\Controllers\HomeController@address');
Route::get('/account/view=reset_password.smb', 'App\Http\Controllers\HomeController@reset_password');
Route::post('/checkouts/cart', 'App\Http\Controllers\HomeController@checkouts');
Route::post('/avatar', 'App\Http\Controllers\HomeController@avatar');
Route::post('/addressClient', 'App\Http\Controllers\HomeController@addressClient');
Route::post('/updateAddress', 'App\Http\Controllers\HomeController@updateAddress');
Route::post('/deletaAddress/{id}', 'App\Http\Controllers\HomeController@deletaAddress');
//send mail
Route::get('/send-mail', [BillController::class,'EmailCustomer']);
//login
Route::get('/login', 'App\Http\Controllers\LoginController@index');
Route::post('/login/check', 'App\Http\Controllers\LoginController@checkLogin');
Route::get('/login/forget_password', 'App\Http\Controllers\LoginController@forget_password');
//admin ->collection
Route::get('/admin/collection', 'App\Http\Controllers\CollectionController@index');
Route::post('/admin/collection/createCollection', 'App\Http\Controllers\CollectionController@createCollection');
Route::post('/admin/collection/getCollection', 'App\Http\Controllers\CollectionController@getCollection');
Route::delete('/admin/collection/delete/{id}', 'App\Http\Controllers\CollectionController@deleteItemCollection');
Route::post('/admin/collection/editCollection', 'App\Http\Controllers\CollectionController@editCollection');
Route::post('/admin/collection/getParentCollection/{id}', 'App\Http\Controllers\CollectionController@getParentCollection');
//admin post
Route::get('/admin/post', 'App\Http\Controllers\PostController@index');
Route::post('/admin/post/postTable', 'App\Http\Controllers\PostController@getTablePost');
Route::get('/admin/createPost', 'App\Http\Controllers\PostController@createPost');
Route::post('/admin/post/create/image', 'App\Http\Controllers\PostController@uploadImages');
Route::get('/admin/post/getCollection', 'App\Http\Controllers\PostController@getCollection');
Route::post('/admin/post/createPost', 'App\Http\Controllers\PostController@createPostZing');
// admin image
Route::post('/api/tinymce/image', 'App\Http\Controllers\PostController@renderImageTinymce');
Route::post('/api/tinymce/uploadImage', 'App\Http\Controllers\PostController@uploadImagesVs5');
//collection product
Route::get('/admin/collectionProduct', 'App\Http\Controllers\CollectionProductController@index');
Route::get('/admin/collectionProduct/create', 'App\Http\Controllers\CollectionProductController@createCollectionProduct');
Route::get('/admin/collectionProduct/edit/{id}', 'App\Http\Controllers\CollectionProductController@editCollectionProduct');
Route::post('/admin/collectionProduct/create/image', 'App\Http\Controllers\CollectionProductController@uploadImages');
Route::post('/admin/collectionProduct/create', 'App\Http\Controllers\CollectionProductController@CollectionProductCreate');
Route::post('/admin/collectionProduct/edit', 'App\Http\Controllers\CollectionProductController@edit');
// log
Route::get('/admin/log', 'App\Http\Controllers\LogController@index');
Route::get('/admin/log/getTable', 'App\Http\Controllers\LogController@getTable');
// user and access
Route::get('/admin/user', 'App\Http\Controllers\UserController@index');
Route::post('/admin/createUser', 'App\Http\Controllers\UserController@createUser');
Route::post('/admin/user/edit/{id}', 'App\Http\Controllers\UserController@getUser');
Route::post('/admin/user/edit', 'App\Http\Controllers\UserController@editUser');
Route::delete('/admin/user/delete/{id}', 'App\Http\Controllers\UserController@deleteUser');
//product
Route::get('/admin/product', 'App\Http\Controllers\ProductController@index')->name('seacher');
Route::get('/admin/product/create', 'App\Http\Controllers\ProductController@createProduct');
Route::post('/admin/product/create/image', 'App\Http\Controllers\ProductController@createProductimage');
Route::post('/admin/product/delete/image', 'App\Http\Controllers\ProductController@deleteImage');
Route::post('/admin/product/createProduct', 'App\Http\Controllers\ProductController@create');
Route::get('/admin/product/edit/{id}', 'App\Http\Controllers\ProductController@editProduct');
Route::post('/admin/product/edit', 'App\Http\Controllers\ProductController@edit');
Route::delete('/admin/product/delete/{id}', 'App\Http\Controllers\ProductController@delete');
Route::post('/admin/product/changeDisplay', 'App\Http\Controllers\ProductController@changeDisplay');
Route::post('/admin/product/changeHighlight', 'App\Http\Controllers\ProductController@changeHighlight');
Route::post('/admin/product/deleteVariant/{id}', 'App\Http\Controllers\ProductController@deleteVariant');
//moblie 
Route::get('/moblie/getCart', 'App\Http\Controllers\MobileController@getCart');
//billLog
Route::get('/admin/billLog', 'App\Http\Controllers\BillOtherController@store');
//blockapi
Route::post('/blockapis', 'App\Http\Controllers\LoginController@block_ips');