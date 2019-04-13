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

/*Route::get('/', function () {
    return view('welcome');
});*/

//Index page
Route::get('/','PagesController@index');
//Contact Page
Route::get('/contacts','SendMailController@index');
Route::post('/contacts/send','SendMailController@send');
//about_us Page
Route::get('/about_us','PagesController@about_us');

//Project Page
Route::resource('/project','ProjectController');
//Projects
Route::get('bungalow','ProjectController@bungalow');
Route::get('house','ProjectController@house');
Route::get('land','ProjectController@land');
Route::get('flat','ProjectController@flat');
Route::get('projectpage','ProjectController@projectShow');

Auth::routes();

//Route::get('/home', 'DashboardController@index');
//Route::resource('/dashboard', 'DashboardController');
Route::group(['middleware' => 'revalidate'],function(){
    Route::get('{path}',"DashboardController@index")->where('path', '([A-z\/_.\d-]+)?' );
});
