<?php namespace Dota;

use stdClass;

/**
* Store the summeries for one player.
*/
class Player 
{
	public $id;

	public $profile;

	public $matches;

	public $stats;

	function __construct($id, $profile, $matches)
	{
		$this->id = $id;

		$this->profile = $profile;

		$this->matches = $matches;

		$this->setAverageStats($matches);
	}

	private function setAverageStats($matches)
	{
		$stats = $this->calculateAverageStats($matches);

		$this->stats = $stats;
	}

	private function calculateAverageStats($matches)
	{
		$matchCount = count($matches);

		$stats = new stdClass();

		return $stats;
	}
}