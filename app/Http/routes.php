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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/tasks', 'TaskController@index');
Route::post('/task' , 'TaskController@store');
Route::delete('/task/{task}' , 'TaskController@destroy');

Route::get('/AccountOptions', 'AccountController@index');
Route::post('/AccountOptions/update', 'AccountController@updateAccount');

/* AccountController
TODO: rename api/AccountOptiosAng to just api/Account,
TODO: rename AccountOptionsAng to Account/Options
*/
Route::resource('api/AccountOptionsAng', 'AccountController');
Route::get('AccountOptionsAng',[
    'middleware' => 'permission:update.account',
    'uses' => 'AccountController@app']);
Route::post('AccountOptionsAng/update', 'AccountController@update');

/* ImageController */
Route::resource('api/image', 'ImageController');
Route::get('image/{image}', [
    'middleware' => 'level:1',
    'uses' => 'ImageController@imageIndex'
]);
Route::post('image/store', [
    'uses' => 'ImageController@store'
]);
Route::delete('image/delete/{image}', [
    'middleware' => 'permission:destroy.image',
    'uses' => 'ImageController@destroy'
]);

/* COmmentController */
Route::resource('api/comment', 'CommentController');
Route::post('comment/store/{comment_id}',[
    'middleware' => 'level:1',
    'uses' => 'CommentController@store'
]);
Route::get('comment/{comment}',[
    'middleware' => 'level:1',
    'uses' => 'CommentController@index'
]);
Route::delete('comment/delete/{comment}',[
    'uses' => 'CommentController@destroy'
]);



/*
Route::get('comment/user/{username}',[
    'middleware' => 'level:1',
    'uses' => 'CommentController@index'
]);
*/
