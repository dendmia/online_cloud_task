<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class FilesController extends Controller
{
	private function validate()
	{
		$input = Input::all();
		$validation = Validator::make($input, [
			'newfilename' => 'regex: /^[a-zA-Z0-9]+$/'
		]);
		if ($validation->fails())
		{
			dd('Валидация не прошла');
		}
	}

	public function upload(Request $request)
	{
		if (Auth::check()) {
			$user_id = Auth::user()->id;
			$file = $request->file('photo');
			$filename = 'users/' . $user_id . '/' . $file->getClientOriginalName();
			$path = $file->storeAs('public', $filename);
			return redirect('home');
		}
	}

	public function rename(Request $request)
	{
		$this->validate();
		if (Auth::check()) {
			$user_id = Auth::user()->id;
			$filename_to_rename = $request->input('filename');
			$new_filename = $request->input('newfilename');

			if (!empty($new_filename))
			{
				Storage::move('public/users/'. $user_id .'/' . $filename_to_rename, 'public/users/'. $user_id .'/' . $new_filename);
			}
		}
		return redirect('home');
	}

	public function delete(Request $request)
	{
		if (Auth::check()) {
			$user_id = Auth::user()->id;
			$filename_to_delete = $request->input('filename');
			Storage::delete('public/users/'. $user_id .'/' . $filename_to_delete);
		}
		return redirect('home');
	}
}