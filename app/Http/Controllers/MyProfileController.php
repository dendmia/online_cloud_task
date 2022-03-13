<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class MyProfileController extends \Illuminate\Routing\Controller
{
	private function validate()
	{
		$input = Input::all();
		$validation = Validator::make($input, [
			'first_name' => 'string|max:255',
			'last_name' => 'string|max:255',
			'email' => 'required|string|email|max:255',
			'phone_number' => 'string|max:21'
		]);

		if ($validation->fails())
		{
			dd($validation->errors()->toArray());
		}
	}

	public function show()
	{
		if (Auth::check()) {
			$user_id = Auth::user()->id;
			$user = DB::table('users')->whereId($user_id)->first();
			$first_name = $user->firstname;
			$last_name = $user->lastname;
			$email = $user->email;
			$phone_number = $user->phonenumber;
		}

		return view('myprofile')->with([
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email' => $email,
			'phone_number' => $phone_number
			]);
	}

	public function edit(Request $request)
	{
		$this->validate();
		if (Auth::check()) {
			$user_id = Auth::user()->id;
			$first_name = $request->input('first_name');
			$last_name = $request->input('last_name');
			$email = $request->input('email');
			$phone_number = $request->input('phone_number');

			DB::table('users')
				->where('id', '=', $user_id)
				->update([
					'firstname' => $first_name,
					'lastname' => $last_name,
					'email' => $email,
					'phonenumber' => $phone_number,
				]);

			return redirect('myprofile');
		}
	}
}