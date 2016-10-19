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
	
	public function user(){
		return $this->belongTo('App\User');
	}
}
