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

Route::apiResources(['users' => 'API\UserController']);
Route::apiResources(['projects' => 'API\ProjectController']);
Route::apiResources(['suppliers' => 'API\SupplierController']);
Route::apiResources(['agents' => 'API\AgentController']);
//Route::group(['prefix'=>'users'],function(){
//    Route::apiResource('{user}/tasks','TaskController');
//});
//Route::apiResource('tasks','TaskController');
Route::apiResource('materials','API\MaterialController');

Route::get('findUser','API\UserController@search');
Route::get('findTask','API\AgentController@search');
Route::get('findMyTask','API\AgentController@search1');
Route::get('findProject','API\ProjectController@search');
Route::get('findSupplier','API\SupplierController@search');
Route::get('findSupplies','API\SupplierController@search1');
Route::get('findMaterials','API\MaterialController@search');


Route::get('profile','API\UserController@profile');
Route::put('profile','API\UserController@updateProfile');
Route::get('task','API\AgentController@task');
Route::get('showtask','API\AgentController@showTask');
Route::put('taskStatus','API\AgentController@taskStatus');

////////SNACKS API
Route::apiResource('/customers','snacks_api\CustomerController');

Route::group(['prefix'=>'customers'],function(){
    Route::apiResource('/{customer}/materials','snacks_api\MaterialController');
});



