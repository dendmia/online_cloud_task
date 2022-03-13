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

Route::post('/upload', function (Request $request) {
	if (Auth::check()) {
		$user_id = Auth::user()->id;
		$file = $request->file('photo');
		$filename = 'users/' . $user_id . '/' . $file->getClientOriginalName();
		$path = $file->storeAs('public', $filename);
		return redirect('home');
	}
});

Route::post('/delete', function (Request $request) {
	if (Auth::check()) {
		$user_id = Auth::user()->id;
		$filename_to_delete = $request->input('filename');
		Storage::delete('public/users/'. $user_id .'/' . $filename_to_delete);
	}
	return redirect('home');
});

Route::post('/rename', function (Request $request) {
	if (Auth::check()) {
		$user_id = Auth::user()->id;
		$filename_to_rename = $request->input('filename');
		$new_filename = $request->input('newfilename');
		Storage::move('public/users/'. $user_id .'/' . $filename_to_rename, 'public/users/'. $user_id .'/' . $new_filename);
	}
	return redirect('home');
});