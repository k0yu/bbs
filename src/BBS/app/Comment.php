<?php

namespace App;

use App\User;
use App\Board;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
	protected $fillable = [
        'text', 'board_id'
    ];
	
	public function userC(){
		return $this->belongsTo('App\User');
	}
	
	public function board(){
		return $this->belongsTo('App\Board');
	}
}
