<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;

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
    public function myHome()
    {
		$user = \Auth::user();
		$boards = $user->boards;
        return view('home', [
			"user" => $user,
			"boards" => $boards
		]);
    }
	
	public function userHome($id)
    {
		$user = User::find($id);
		$boards = $user->boards;
        return view('home', [
			"user" => $user,
			"boards" => $boards
		]);
    }
}
