<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Api Section

// Users
Route::post('user/login', 'api\UserController@login');
Route::post('register', 'api\UserController@register');
Route::get('show/{id}', 'api\UserController@showbyid');
Route::get('show/', 'api\UserController@show');
Route::put('update/{id}', 'api\UserController@update');
Route::delete('delete/{id}', 'api\UserController@delete');
Route::get('logout', 'api\UserController@logout')->middleware('auth:api');


// Users Type
Route::post('userType/create', 'api\UserTypeController@create');
Route::put('userType/update/{id}', 'api\UserTypeController@update');
Route::get('userType/show/{id}', 'api\UserTypeController@showbyid');
Route::get('userType/show/', 'api\UserTypeController@show');
Route::delete('userType/delete/{id}', 'api\UserTypeController@delete');

// Users Rights
Route::post('userRights/create', 'api\RightsController@create');
Route::put('userRights/update/{id}', 'api\RightsController@update');
Route::get('userRights/show/{id}', 'api\RightsController@showbyid');
Route::get('userRights/show/', 'api\RightsController@show');
Route::delete('userRights/delete/{id}', 'api\RightsController@delete');

// Brand
Route::post('brand/create', 'api\BrandController@create');
Route::put('brand/update/{id}', 'api\BrandController@update');
Route::get('brand/show/{id}', 'api\BrandController@showbyid');
Route::get('brand/show/', 'api\BrandController@show');
Route::delete('brand/delete/{id}', 'api\BrandController@delete');

