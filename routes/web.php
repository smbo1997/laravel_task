<?php

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

Route::get('/', function () {
    return redirect('en');
});





//Auth::routes();
$this->get('{locale}/login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('{locale}/login', 'Auth\LoginController@login');
$this->post('{locale}/logout', 'Auth\LoginController@logout')->name('logout');
$this->get('{locale}/register', 'Auth\RegisterController@showRegistrationForm');
$this->post('{locale}/register', 'Auth\RegisterController@register');
$this->get('{locale}/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
$this->get('{locale}/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');

//user
Route::get('{locale}/charts', 'UserController@showcharts');
Route::post('/buyproduct', 'UserController@buyproduct');
Route::post('/getbaskets', 'UserController@getbasketsdata');
Route::get('{locale}/deletebasket/{Productid}', 'UserController@deletebasket');
Route::post('/buymyproduct', 'UserController@buymyproduct');
Route::post('/buyall', 'UserController@buyall');



//Store
Route::get('/nextpaginate/{id}', 'StoreController@nextpaginate');
Route::get('/{locale}', 'StoreController@index');
Route::get('/{locale}/service', 'StoreController@service');
Route::get('/{locale}/store/{id}', 'StoreController@getstoreById');
Route::post('/getproductsbystore', 'StoreController@getproductsbystore');

//user_home
Route::get('{locale}/user_home', 'HomeController@index');


//StoreOwner
Route::get('{locale}/store_owner', 'StoreOwnerController@showblade');
Route::post('/updatedata', 'StoreOwnerController@updatedata');
Route::post('/changedata', 'StoreOwnerController@changedata');
Route::get('{locale}/addtypes', 'StoreOwnerController@addtypes');
Route::post('addnewtype', 'StoreOwnerController@addnewtype');
Route::get('/{locale}/deletetype/{type_id}', 'StoreOwnerController@deletetype');
Route::get('/{locale}/products', 'StoreOwnerController@products');
Route::post('/addnewproduct', 'StoreOwnerController@addnewproduct');
Route::get('{locale}/seeproducts', 'StoreOwnerController@seeproducts');
Route::post('/selectproducts', 'StoreOwnerController@selectproducts');
Route::get('/{locale}/deleteproduct/{product_id}', 'StoreOwnerController@deleteproduct');
Route::get('/{locale}/updatedproductbyadmin', 'StoreOwnerController@updatedproductbyadmin');
Route::post('/seenupdate', 'StoreOwnerController@seenupdate');
Route::post('/mynotification', 'StoreOwnerController@mynotification');
Route::get('{locale}/makestoreworkers', 'StoreOwnerController@makestoreworkers');
Route::post('/addstoreworkers', 'StoreOwnerController@addstoreworkers');
Route::get('{locale}/deleteworker/{worker_id}', 'StoreOwnerController@deleteworker');



//store_workers
Route::get('/{locale}/store_worker', 'StoreWorkerController@showstoreworker');
Route::post('/addnewproductwithworkers', 'StoreWorkerController@addnewproductwithworkers');
Route::get('{locale}/seeproductwithworkers', 'StoreWorkerController@seeproductwithworkers');
Route::get('{locale}/deleteproductwithworker/{product_id}', 'StoreWorkerController@deleteproductwithworker');
Route::post('/selectproductswithworkers', 'StoreWorkerController@selectproductswithworkers');
Route::get('{locale}/updateproductwithworker/{product_id}', 'StoreWorkerController@updateproductwithworker');
Route::post('/updatedproductwithworkers', 'StoreWorkerController@updatedproductwithworkers');


//Admin
Route::get('{locale}/admin', 'AdminController@showblade');
Route::post('/addimage', 'AdminController@addimage');
Route::get('{locale}/shops', 'AdminController@seeshops');
Route::get('{locale}/LoginwithUserId/{userid}', 'AdminController@LoginwithUserId');
Route::get('{locale}/backadmin', 'AdminController@backadmin');
Route::get('{locale}/seeproductswithAdmin', 'AdminController@seeproductswithAdmin');
Route::post('/gettypeswithadmin', 'AdminController@gettypeswithadmin');
Route::post('/getproductsbyadmin', 'AdminController@getproductsbyadmin');
Route::get('{locale}/updateproductbtadmin/{product_id}', 'AdminController@updateproductbtadmin');
Route::post('/updatedproductbyadmin', 'AdminController@updatedproductbyadmin');

//////////////////