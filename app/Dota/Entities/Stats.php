<?php namespace Dota\Entities;

class Stats
{
	public $gpm;
	
	public $xpm;

	public $kills;
	
	public $deaths;

	public $assists;
	
	public $KD;

	public $KDA;

	public $totalGameTime;

	public $totalMatches;

	function __construct($stats)
	{
		$this->gpm = intval($stats->gpm);

		$this->xpm = intval($stats->xpm);

		$this->kills = intval($stats->kills);

		$this->deaths = intval($stats->deaths);

		$this->assists = intval($stats->assists);

		$this->KD = $this->kills / $this->deaths;

		$this->KDA = ($this->kills + $this->assists) / $this->deaths;

		$this->totalGameTime = date($stats->totalGameTime);

		$this->totalMatches = $stats->totalMatches;
	}
}