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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/','HomeController@home');

// Route::group(['middleware' => ['web']], function () {
// 	// here you should put your routes
// 	Route::post('login','RegisterController@processLogin');
// 	Route::get('logout', 'RegisterController@logout');
// });
Auth::routes();

Route::get('/', 'Auth\AdminController@showLoginForm');
Route::post('/login', 'Auth\AdminController@login')->name('login.submit');
Route::post('/register', 'Auth\AdminController@register');

Route::get('/logout', function() {
        auth()->logout();
         return redirect('/');
    });


Route::group(['prefix' => 'admin'], function(){
    Route::get('dashboard','HomeController@dashboard');
    Route::get('adduser','HomeController@adduser');
    Route::post('adduser','AdminController@adduser');
    Route::get('userlist','HomeController@userlist');
    Route::get('edituser/{id}','HomeController@edituser');
    Route::post('edituser','AdminController@edituser');
    Route::get('deleteuser/{id}','HomeController@deleteuser');
    Route::get('viewuser/{id}','HomeController@viewuser');


    Route::get('addcategory','HomeController@addcategory');
    Route::post('addcategory','AdminController@addcategory');
    Route::get('categorylist','HomeController@categorylist');
    Route::get('editcategory/{id}','HomeController@editcategory');
    Route::get('deletecategory/{id}','HomeController@deletecategory');
    Route::get('viewcategory/{id}','HomeController@viewcategory');

    Route::get('addvideo','HomeController@addvideo');
    Route::post('addvideo','AdminController@addvideo');
    Route::get('videolist','HomeController@videolist');
    Route::get('viewvideo/{id}','HomeController@viewvideo');


    Route::get('bannercategory','HomeController@bannercategory');
    Route::post('addbannercategory','AdminController@addbannercategory');
    Route::get('editbanner/{id}','AdminController@editbanner');
    Route::get('deletbanner/{id}','AdminController@deletbanner');

    Route::get('imagegallery/{id}','HomeController@imagegallery');
    Route::post('addimage','AdminController@addimage');
    Route::get('videoadd/{id}','HomeController@videoadd');
    Route::post('videoadd','AdminController@videoadd');
    Route::get('editvideo/{id}','HomeController@editvideo');
    Route::get('editvideo/{id}','HomeController@editvideo');
    Route::get('deletevideo/{id}','HomeController@deletevideo');


    Route::get('banners','HomeController@banners');
    Route::post('addbanners','AdminController@addbanners');
    Route::get('bannerlist','HomeController@bannerlist');
    Route::get('banneredit/{id}','AdminController@banneredit');
    Route::get('bannerdelete/{id}','AdminController@bannerdelete');


    Route::get('videogallery/{id}','HomeController@videogallery');
    Route::post('uploadgallery/{id}','AdminController@uploadgallery');
    Route::get('gallerylist/{id}','HomeController@gallerylist');
    Route::post('deleteimages','AdminController@deleteimages');
    Route::post('deletevideolist','AdminController@deletevideolist');


});
