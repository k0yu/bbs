<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;
use App\Board;
use App\Http\Requests;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$request->user()->comments()->create([
			'board_id' => $request->board_id,
			'text' => $request->text
		]);
		
		
		return redirect()->action('BoardController@show', [$request->board_id]);
		
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
		$json = $board->comments()->paginate(2);
		//jsonA = json_decode($json); nullになる
		$array = array(
			'view' => view('commentDetail')->with('json', $json)->render(),
			'next_page_url' => $json->nextPageUrl()
		);
		
		return json_encode($array);
		//return json_encode(view('commentDetail')->with('json', $json)->render());
		//dd($jsonA);

		
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
		$comment = Comment::findOrFail($id);
		return view('commentEdit', [
			'comment' => $comment,
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
		$comment = Comment::findOrFail($id);
		$this->authorize('update', $comment);
		$comment->update([
			'text' => $request->text
		]);
		
		return redirect()->action('BoardController@show', [$comment->board_id]);
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
		$comment = Comment::findOrFail($id);
		$board_id = $comment->board_id;
		$this->authorize('destroy', $comment);
		$comment->delete();
		
		return redirect()->action('BoardController@show', [$board_id]);
    }
}
