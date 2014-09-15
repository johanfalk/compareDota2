<?php

class MatchDetail extends Eloquent 
{
	public $timestamps = false;	

	protected $table = 'match_detail';

	public function playerDetails()
	{
		return $this->hasMany('PlayerDetail')->with('Hero');
	}
}
