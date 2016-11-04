<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Board;
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
		$boards = Board::orderBy('updated_at', 'desc')->paginate(3);
		
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
		$this->validate($request, [
			'title' => 'required|max:50',
			'text' => 'required|max:255',
		]);
		$board = $request->user()->boards()->create([
			'title' => $request->title,
			'text' => $request->text
		]);
		

		return redirect()->action('TagController@index', [
			'tag' => $request->tag,
			'board_id' => $board->id
		]);
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
		return view('boardDetailA', [
			'board' => $board,
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
		
		$board = Board::findOrFail($id);
		
		return view('boardEdit', [
			'board' => $board,
		]);
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
		$this->validate($request, [
			'title' => 'required|max:50',
			'text' => 'required|max:255',
		]);
		$board = Board::findOrFail($id);
		$this->authorize('update', $board);
		$board->update([
			'title' => $request->title,
			'text' => $request->text
		]);
		
		return redirect()->action('TagController@index', [
			'tag' => $request->tag,
			'board_id' => $board->id
		]);
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
