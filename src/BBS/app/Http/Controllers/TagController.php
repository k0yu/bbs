<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Tag;
use App\Board;

class TagController extends Controller
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
        //
		$this->validate($request, [
			'tag' => 'required|max:20',
		]);
		
		if(!Tag::where('name', $request->tag)->exists()){
			$tag = new Tag;
			$tag->name = $request->tag;
			$tag->save();
		}else{
			$tag = Tag::where('name', $request->tag)->first();
		}
		
		$board = Board::find($request->board_id);
		$tagList = $board->getTagListAttribute();
		
		if(!array_search($tag->id, $tagList)){
			$tagList[] = $tag->id;
		}

		$board->tags()->sync($tagList);
		
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
		$tag = Tag::find($id);
		$boards = $tag->boards()->paginate(3);
		return view('boardList', [
			"tag" => $tag,
			"boards" => $boards
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
		$board = Board::find($request->board_id);
		$board->tags()->detach($id);
		
		return redirect()->action('BoardController@show', [$board->id]);
		
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
		
    }
}
