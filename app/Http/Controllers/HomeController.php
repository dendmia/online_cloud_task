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
		if (Auth::check()) {
			$user_id = Auth::user()->id;
			$is_autorized = true;
			$files = Storage::files('/photos/users/' . $user_id);
		}

        return view('home')->with([
			'is_autorized' => $is_autorized,
			'files' => $files
		]);
    }
}
