<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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
     * @return Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
		//Заменить на CamelCase
		$is_autorized = false;
		$file_names = [];
		$path = '';
		//TODO: middleware, проверка на авторизацию лишняя
		if (Auth::check()) {
			$user_id = Auth::user()->id;
			$is_autorized = true;
			$files = Storage::files('/public/users/' . $user_id) ?? [];
			$file_names = [];
			if (!empty($files)) {
				foreach ($files as $file) {
					$file_names[] = array_last(explode('/', $file));
				}
			}
			$path = "/storage/users/{$user_id}/";
		}
//compact('is_autorized', 'file_names')
        return view('home')->with([
			'is_autorized' => $is_autorized,
			'file_names' => $file_names,
			'path' => $path
		]);
    }
}
