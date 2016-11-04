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
		$boards = $user->boards()->orderBy('updated_at', 'desc')->paginate(3);
        return view('homeBoard', [
			"user" => $user,
			"boards" => $boards
		]);
    }
	
	public function userHome($id)
    {
		$user = User::find($id);
		$boards = $user->boards()->orderBy('updated_at', 'desc')->paginate(3);
        return view('homeBoard', [
			"user" => $user,
			"boards" => $boards
		]);
    }
	
	public function myHomeComment(){
		$user = \Auth::user();
		$comments = $user->comments()->orderBy('updated_at', 'desc')->paginate(3);
        return view('homeComment', [
			"user" => $user,
			"comments" => $comments
		]);

	}
	
	public function userHomeComment($id){
		$user = User::find($id);
		$comments = $user->comments()->orderBy('updated_at', 'desc')->paginate(3);
        return view('homeComment', [
			"user" => $user,
			"comments" => $comments
		]);
	}
	
	public function edit(){
		$user = \Auth::user();
		return view('nameUpdate', ["user" => $user,]);
	}
	
	public function update(Request $request){
        $this->validate($request, [
			'name' => 'required|max:255',
		]);
		
		$user = \Auth::user();
		$user->update(['name' => $request->name]);
		
		return redirect()->action('HomeController@myHome');
    }
}
