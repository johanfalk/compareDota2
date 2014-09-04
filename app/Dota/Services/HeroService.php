<?php namespace Dota\Services;

use Dota\Repositories\HeroRepository;

class HeroService
{
	private $heroRepository;
	
	function __construct(HeroRepository $$heroRepository)
	{
		$this->heroRepository = $heroRepository; 
	}
}