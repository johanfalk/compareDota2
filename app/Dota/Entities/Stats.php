<?php namespace Dota\Entities;

class Stats
{
	public $avgGpm;
	public $avgXpm;
	public $avgKills;
	public $avgDeaths;
	public $avgAssists;
	public $avgTowerDmg;
	public $avgHeroDmg;
	public $avgHeroHealing;
	public $avgCreepKills;
	public $avgCreepDenies;
	
	public $KD;
	public $KDA;

	public $maxGpm;
	public $maxXpm;
	public $maxKills;
	public $maxDeaths;
	public $maxAssists;
	public $maxTowerDmg;
	public $maxHeroDmg;
	public $maxHeroHealing;
	public $maxCreepKills;
	public $maxCreepDenies;

	public $totalGameTime;
	public $totalMatches;

	function __construct($stats)
	{
		$this->avgGpm = intval($stats->avgGpm);
		$this->avgXpm = intval($stats->avgXpm);
		$this->avgKills = intval($stats->avgKills);
		$this->avgDeaths = intval($stats->avgDeaths);
		$this->avgAssists = intval($stats->avgAssists);
		$this->avgTowerDmg = intval($stats->avgTowerDmg);
		$this->avgHeroDmg = intval($stats->avgHeroDmg);
		$this->avgHeroHealing = intval($stats->avgHeroHealing);
		$this->avgCreepKills = intval($stats->avgCreepKills);
		$this->avgCreepDenies = intval($stats->avgCreepDenies);

		$this->KD = $this->avgKills / $this->avgDeaths;
		$this->KDA = ($this->avgKills + $this->avgAssists) / $this->avgDeaths;

		$this->maxGpm = $stats->maxGpm;
		$this->maxXpm = $stats->maxXpm;
		$this->maxKills = $stats->maxKills;
		$this->maxDeaths = $stats->maxDeaths;
		$this->maxAssists = $stats->maxAssists;
		$this->maxTowerDmg = $stats->maxTowerDmg;
		$this->maxHeroDmg = $stats->maxHeroDmg;
		$this->maxHeroHealing = $stats->maxHeroHealing;
		$this->maxCreepKills = $stats->maxCreepKills;
		$this->maxCreepDenies = $stats->maxCreepDenies;

		$this->totalGameTime = date('H:i:s', $stats->totalGameTime);
		$this->totalMatches = $stats->totalMatches;
	}
}
