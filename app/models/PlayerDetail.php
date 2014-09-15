<?php

class PlayerDetail extends Eloquent 
{
	public $timestamps = false;	

	public $increments = false;

	protected $table = 'player_detail';

	public function matchDetail()
	{
		return $this->belongsTo('MatchDetail');
	}

	public function hero()
	{
		return $this->belongsTo('Hero');
	}
}
