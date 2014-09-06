<?php namespace Dota\Repositories;

use Hero;

class HeroRepository
{
	function __construct(Hero $hero)
	{
		$this->hero = $hero;
	}

	public function getHeroes()
	{
		return Cache::remember('heroes', 20 function() 
		{
			return $this->hero->all();
		});
	}

	public function getHero($id)
	{
		return $this->hero->hasMany('attributes')->find($id);
	}
}