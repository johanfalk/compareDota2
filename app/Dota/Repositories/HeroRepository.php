<?php namespace Dota\Repositories;

use Hero;

class HeroRepository
{
	function __construct(Hero $hero)
	{
		$this->hero = $hero;
	}

	public function getHeros()
	{
		return Cache::remember('heroes', 20 function() 
		{
			return $this->hero->all();
		});
	}

	public function getHeroInfoByID($id)
	{
		return $thid->hero->find($id);
	}
}