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
    return view('welcome');
});

Auth::routes(['verify'=>'email']);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/file-upload', 'FileUploadController@index')->name('file_upload_view');
Route::post('/file-upload', 'FileUploadController@fileUpload')->name('file_upload');


Route::get('/check-image', 'FileUploadController@checkImageScale')->name('check_image_scale');




Route::get('/list-user', 'UserController@ListUser')->name('list_user');