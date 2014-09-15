<?php namespace Dota\Entities;

/**
* Store summeries for one player.
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