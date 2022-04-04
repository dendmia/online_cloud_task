<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//TODO: объединяем вызовы одного контроллера через group
Route::post('/upload', 'FilesController@upload');
Route::post('/delete', 'FilesController@delete');
Route::post('/rename', 'FilesController@rename');

//TODO prefix
Route::get('/myprofile', 'MyProfileController@show');
Route::post('/myprofile/edit', 'MyProfileController@edit');