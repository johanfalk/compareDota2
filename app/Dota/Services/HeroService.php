<?php namespace Dota\Services;

use Dota\Entities\Hero;
use Dota\Repositories\HeroRepository;

class HeroService
{
	private $heroRepository;
	
	function __construct(HeroRepository $heroRepository, Hero $hero)
	{
		$this->heroRepository = $heroRepository; 
	}

	public function getHero($id)
	{
		return new Hero($this->heroRepository->getHero($id));
	}

	public function getHeroes()
	{
		return $this->heroRepository->getHeroes();
	}
}