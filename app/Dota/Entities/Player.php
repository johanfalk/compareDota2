<?php namespace Dota\Entities;

use Dota\Handlers\StatsHandler;

/**
* Store the summeries for one player.
*/
class Player
{
	public $profile;

	public $stats;

	function __construct($profile, $stats)
	{
		$this->profile = $profile;

		$this->stats = $stats;
	}
}