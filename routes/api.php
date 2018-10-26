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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', 'api\UserController@register');
Route::post('login', 'api\UserController@login');
Route::get('details', 'api\UserController@details');                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
Route::get('getcategory', 'api\UserController@getcategory');
Route::post('categorybyid', 'api\UserController@categorybyid');
Route::get('getvideo', 'api\UserController@getvideo');
Route::post('videobyid', 'api\UserController@videobyid');
Route::post('videobycategory', 'api\UserController@videobycategory');

Route::post('categorybyparent', 'api\UserController@categorybyparent');






Route::group(['middleware' => 'auth:api'], function(){
// Route::post('login', 'api\UserController@login');
});