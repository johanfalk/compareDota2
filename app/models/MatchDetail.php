<?php

class MatchDetail extends Eloquent {

	public $timestamps = false;	

	protected $table = 'match_detail';

	public function playerDetail()
	{
		return $this->hasMany('PlayerDetail');
	}
}
