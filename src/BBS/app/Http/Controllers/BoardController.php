<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Board;
use App\User;
use App\Http\Requests;

class BoardController extends Controller
{
	
	public function __construct(){
		$this->middleware('auth');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$boards = Board::all();
		
		return view('boardList', ['boards' => $boards]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

	public function create(){
		return view('newPost');
		
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
		$board = $request->user()->boards()->create([
			'title' => $request->title,
			'text' => $request->text
		]);
		
		return redirect()->action('BoardController@show', [$board->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
		$board = Board::findOrFail($id);
		$user = User::findOrFail($board->user_id);
		return view('boardDetail', [
			'board' => $board,
			'user' => $user
		]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
		$board = Board::findOrFail($id);
		$this->authorize('destroy', $board);
		$board->delete();
		
		return redirect('/');
    }
}
