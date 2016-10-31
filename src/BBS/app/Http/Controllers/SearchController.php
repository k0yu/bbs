<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Board;
use App\Comment;
use App\Tag;

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
		$request->flash();
		
		if($target == "board"){
			if ($keyword) {
				$boards = Board::where('title', 'LIKE', "%{$keyword}%")->orWhere('text', 'LIKE', "%{$keyword}%")->orderBy('updated_at', 'desc')->paginate($pageNum);
			}else{
				$boards = Board::orderBy('updated_at', 'desc')->paginate($pageNum);
			}
			return view('searchResult', ['boards' => $boards]);
		}elseif($target == "comment"){
			if ($keyword) {
				$comments = Comment::where('text', 'LIKE', "%{$keyword}%")->orderBy('updated_at', 'desc')->paginate($pageNum);
			}else{
				$comments = Comment::orderBy('updated_at', 'desc')->paginate($pageNum);
			}
			return view('commentList', ['comments' => $comments]);
		}elseif($target == "user"){
			if ($keyword) {
				$users = User::where('name', 'LIKE', "%{$keyword}%")->orderBy('updated_at', 'desc')->paginate($pageNum);
			}else{
				$users = User::orderBy('updated_at', 'desc')->paginate($pageNum);
			}
			return view('userList', ['users' => $users]);
		}elseif($target == "tag"){
			if ($keyword) {
				$tags = Tag::where('name', 'LIKE', "%{$keyword}%")->orderBy('updated_at', 'desc')->paginate($pageNum);
			}else{
				$tags = Tag::orderBy('updated_at', 'desc')->paginate($pageNum);
			}
			return view('tagList', ['tags' => $tags]);
		}
		
	}
}
