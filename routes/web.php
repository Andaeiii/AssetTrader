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

Route::get('/', 'PagesController@homepage')->name('home');
Route::get('/user/login', 'PagesController@login')->name('login');

Route::post('/auth/login', 'UserController@authenticate')->name('process_login');
Route::get('/user/logout', 'UserController@logout')->name('logout');

Route::get('/user/register', 'UserController@newUser');
Route::post('/user/new', 'UserController@addUser')->name('register_user');

Route::get('/auth/bvn', 'BvnController@pullBVNInfo')->name('process_bvn');

Route::get('/auth/pay', 'PayController@addPayment');
Route::post('/pay/process', 'PayController@processPay')->name('process_pay');

Route::post('/bvn/process', 'BvnController@processBVN')->name('process_bvn');

Route::get('/register', function(){
	//pr(['helo', 'wassup']);
});

Route::group(['middleware'=>'auth'], function(){

	Route::get('/dashboard', 'PagesController@index')->name('dashboard');
	Route::get('/asset/all', 'AssetsController@allassets')->name('all_assets');
	Route::get('/asset/new', 'AssetsController@newasset')->name('new_asset');
	Route::post('/asset/add', 'AssetsController@addasset')->name('add_asset');

	Route::get('/relative/all', 'BnfController@manageAll')->name('manage_bnf');
	Route::get('/relative/new', 'BnfController@newRelative')->name('new_relative');

	Route::post('/relative/add', 'BnfController@addRelative')->name('add_beneficiary');
	Route::get('/assets/map', 'AssetsController@mapAssets')->name('map_assets');
	Route::get('/ajax/{id}/relatives', 'AssetsController@getUnMappedRelatives');
	Route::post('/ajax/setmapping', 'AssetsController@mapAssetsOBJ');

	Route::get('/mapping/{id}/del', 'AssetsController@removeMapping');
	Route::get('/mapping/{id}/pull', 'AssetsController@pullMappingInfo');


	Route::get('/execute/will', 'WillController@executewill');

});


//////////////////////////////////////////////////////////////////////////	the migrations starts here....

Route::get('/tb/migrate/{model}', function($model){
	$model = '\App\\'.studly_case($model);
	$model::migrate();
});


Route::get('/test', function(){
	echo bcrypt('123456');
});

////////////////////////////////////////////////////////////////////////////beginthe migration routes... 