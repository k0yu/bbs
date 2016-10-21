<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    //
	protected $fillable = [
		'title', 'text'
	];
	
	public function userB(){
		return $this->belongsTo('App\User');
	}
	
	public function comments(){
		return $this->hasMany('App\Comment');
	}
}
