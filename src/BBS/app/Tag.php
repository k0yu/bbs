<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
	protected $fillable = [
		'name'
	];
	
	public function boards(){
		return $this->belongsToMany('App\Board');
	}
}
