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

Route::group(
    [
        'namespace' => 'Api\Auth'
    ],
    function(){
        Route::post('/register', 'RegisterController@index');
        Route::post('/login', 'LoginController@login');
        Route::post('/login/refresh', 'LoginController@refresh');
    }
); 

Route::group(
    [
        'namespace' => 'Api',
        'prefix'    =>  'users'
    ],
    function(){
        Route::get('/', 'UserController@index');
        Route::get('/{id}', 'UserController@show')->middleware('auth:api','auth.isowner:user');
        Route::put('/', 'UserController@store')->middleware('auth:api','auth.isadmin');
        Route::post('/{id}', 'UserController@update')->middleware('auth:api','auth.isowner:user');
        Route::delete('/{id}', 'UserController@destroy')->middleware('auth:api','auth.isowner:user');
    }
); 

Route::group(
    [
        'namespace' => 'Api',
        'prefix'    =>  'usergroups'
    ],
    function(){
        Route::get('/', 'UserGroupController@index')->middleware('auth:api');
        Route::get('/{id}', 'UserGroupController@show')->middleware('auth:api');
        Route::put('/', 'UserGroupController@store')->middleware('auth:api');
        Route::post('/{id}', 'UserGroupController@update')->middleware('auth:api');
        Route::delete('/{id}', 'UserGroupController@destroy')->middleware('auth:api');
    }
);

Route::group(
    [
        'namespace' => 'Api',
        'prefix'    =>  'articles'
    ],
    function(){
        Route::get('/', 'ArticleController@index');
        Route::get('/{id}', 'ArticleController@show');
        Route::put('/', 'ArticleController@store')->middleware('auth:api');
        Route::post('/{id}', 'ArticleController@update')->middleware('auth:api','auth.isowner:article');
        Route::delete('/{id}', 'ArticleController@destroy')->middleware('auth:api','auth.isowner:article');
    }
); 

Route::group(
    [
        'namespace' => 'Api',
        'prefix'    =>  'categories'
    ],
    function(){
        Route::get('/', 'CategoryController@index');
        Route::get('/{id}', 'CategoryController@show');
        Route::put('/', 'CategoryController@store')->middleware('auth:api','auth.isadmin');
        Route::post('/{id}', 'CategoryController@update')->middleware('auth:api','auth.isadmin');
        Route::delete('/{id}', 'CategoryController@destroy')->middleware('auth:api','auth.isadmin');
    }
);

Route::group(
    [
        'namespace' => 'Api',
        'prefix'    =>  'tags'
    ],
    function(){
        Route::get('/', 'TagController@index');
        Route::get('/{id}', 'TagController@show');
        Route::put('/', 'TagController@store')->middleware('auth:api');
        Route::post('/{id}', 'TagController@update')->middleware('auth:api','auth.isadmin');
        Route::delete('/{id}', 'TagController@destroy')->middleware('auth:api','auth.isadmin');
    }
);
