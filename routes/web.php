<?php
use Illuminate\Http\Request;
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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/upload', 'FilesController@upload');
Route::post('/delete', 'FilesController@delete');
Route::post('/rename', 'FilesController@rename');
Route::get('/myprofile', 'MyProfileController@show');
Route::post('/myprofile/edit', 'MyProfileController@edit');