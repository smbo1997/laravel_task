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
Route::get('{locale}/mycard', 'UserController@mycard');
Route::post('/addcard', 'UserController@addcard');
Route::post('/sendmessageAdmin', 'UserController@sendmessageAdmin');
Route::post('/getstoremessages', 'UserController@getstoremessages');



//Store
Route::get('/nextpaginate/{id}', 'StoreController@nextpaginate');
Route::get('/{locale}/', 'StoreController@index');
Route::post('?page={page}', 'StoreController@index');
Route::get('/{locale}/service', 'StoreController@service');
Route::get('/{locale}/store/{id}', 'StoreController@getstoreById');
Route::post('/getproductsbystore', 'StoreController@getproductsbystore');
Route::post('/getstoresbyservice', 'StoreController@getstoresbyservice');
Route::post('/getproductbystoreandtypeid', 'StoreController@getproductbystoreandtypeid');



//user_home
Route::get('{locale}/user_home', 'HomeController@index');


//StoreOwner
Route::get('{locale}/store_owner', 'StoreOwnerController@showblade');
Route::post('/updatedata', 'StoreOwnerController@updatedata');
Route::post('/changedata', 'StoreOwnerController@changedata');
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
Route::get('{locale}/bouthproducts', 'StoreOwnerController@bouthproducts');
Route::get('{locale}/store_chat', 'StoreOwnerController@showStorechat');
Route::post('/getproductsByprice', 'StoreOwnerController@getproductsByprice');
Route::get('{locale}/deleteboutproductbystore/{basket_id}', 'StoreOwnerController@deleteboutproductbystore');



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
Route::get('{locale}/messages', 'AdminController@messages');
Route::get('{locale}/deletemessagebyadmin/{message_id}', 'AdminController@deletemessagebyadmin');
Route::get('{locale}/adminseenmessage/{message_id}', 'AdminController@adminseenmessage');
Route::get('{locale}/Deleteshop/{shop_id}', 'AdminController@Deleteshop');
Route::post('/sendmessagetouser', 'AdminController@sendmessagetouser');
Route::get('{locale}/addtypes', 'AdminController@addtypes');
Route::post('addnewtype', 'AdminController@addnewtype');


//Chat
Route::get('{locale}/chat', 'ChatController@showchat');
Route::post('/getmessagesbyadminsmall', 'ChatController@getmessagesbyadminsmall');

