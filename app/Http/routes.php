<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');
/*跳转*/

Route::get('phone' , ['as' => 'Phone', 'uses' => 'HomeController@phone']);
Route::get('invest' , ['as' => 'Invest', 'uses' => 'HomeController@invest']);
Route::get('group' , ['as' => 'Group', 'uses' => 'HomeController@group']);
Route::get('edit' , ['as' => 'Edit', 'uses' => 'HomeController@edit']);

/*关闭注册*/
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

 Route::controllers([
 	'auth' => 'Auth\AuthController',
 	'password' => 'Auth\PasswordController',
 ]);



/*建立_token*/
Route::group(['prefix'=>'api'],function(){
	/*获取token*/
	Route::get('get-csrf-token', ['as' => 'Api.General.GetCsrfToken', 'uses' => 'Api\GeneralController@getCsrfToken']);

	Route::post('sendEmail' , ['as' => 'Api.sendEmail', 'uses' => 'Api\UserController@sendEmail']);
	Route::post('sendPhone' , ['as' => 'Api.sendPhone', 'uses' => 'Api\UserController@sendPhone']);
	Route::post('investor/{id}' , ['as' => 'Api.investor', 'uses' => 'Api\UserController@investor']);

	/*ajax*/
	Route::post('group/{id}' , ['as' => 'Api.group', 'uses' => 'Api\UserController@group']);
	Route::post('updateGroup/{id}' , ['as' => 'Api.groupGroup', 'uses' => 'Api\UserController@updateGroup']);
	Route::post('delGroup/{id}' , ['as' => 'Api.delGroup', 'uses' => 'Api\UserController@delGroup']);
	Route::post('updateAllGroup' , ['as' => 'Api.updateAllGroup', 'uses' => 'Api\UserController@updateAllGroup']);

	/*excel*/
	Route::post('uploadExcel' , ['as' => 'Api.uploadExcel', 'uses' => 'Api\UserController@uploadExcel']);

	Route::get('edit' , ['as' => 'Api.editInvestor', 'uses' => 'Api\UserController@editInvestor']);

	Route::post('uploadTxt' , ['as' => 'Api.uploadTxt', 'uses' => 'Api\UserController@uploadTxt']);
});



/*微信*/
//Route::get('/login', function () {
//	return Socialite::driver('wechat')->redirect('www.laravel.com/home');
//});
//
//Route::get('home', function () {
//	$user = Socialite::driver('wechat')->user();
//    dd($user);
//});