<?php namespace Dota;

/**
* Store the summeries for one player.
*/
class Player 
{
	public $id;

	public $profile;

	public $matches;

	public $goldPerMin;

	public $expPerMin;

	public $healPerMin;

	function __construct($id, $profile, $matches)
	{
		$this->id = $id;

		$this->profile = $profile;

		$this->matches = $matches;

		$this->calculateAverageStats($matches);
	}

	private function calculateAverageStats($matches)
	{
		var_dump('calculateAverageStats');
		return true;
	}
}