<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Board;
use App\Comment;

class SearchController extends Controller
{
    //
	public function __construct(){
		$this->middleware('auth');
	}
	
	public function search(Request $request){
		$pageNum = 3;
		$target = $request->target;
		$keyword = $request->keyword;
		
		if($target == "board"){
			if ($keyword) {
				$boards = Board::where('title', 'LIKE', "%{$keyword}%")->orWhere('text', 'LIKE', "%{$keyword}%")->paginate($pageNum);
			}else{
				$boards = Board::paginate($pageNum);
			}
			return view('searchResult', ['boards' => $boards]);
		}elseif($target == "comment"){
			if ($keyword) {
				$comments = Comment::where('text', 'LIKE', "%{$keyword}%")->paginate($pageNum);
			}else{
				$comments = Comment::paginate($pageNum);
			}
			return view('commentList', ['comments' => $comments]);
		}elseif($target == "user"){
			if ($keyword) {
				$users = User::where('name', 'LIKE', "%{$keyword}%")->paginate($pageNum);
			}else{
				$users = User::paginate($pageNum);
			}
			return view('searchResult', ['users' => $users]);
		}
	}
}
