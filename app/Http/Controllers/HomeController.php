<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$is_autorized = false;
		$file_names = [];
		$path = '';
		if (Auth::check()) {
			$user_id = Auth::user()->id;
			$is_autorized = true;
			$files = Storage::files('/public/users/' . $user_id);
			$file_names = [];
			if (!empty($files)) {
				foreach ($files as $file) {
					$file_names[] = array_last(explode('/', $file));
				}
			}
			$path = "/storage/users/{$user_id}/";
		}

        return view('home')->with([
			'is_autorized' => $is_autorized,
			'file_names' => $file_names,
			'path' => $path
		]);
    }
}
