<?php namespace Dota;

use Dota\Repositories\HeroRepository;

class Hero
{
	public $name;

	public $iconPath;

	public $type;

	public $abilities;

	private $heroRepository;	

	function __construct(HeroRepository $heroRepository)
	{
		$this->heroRepository = $heroRepository;

		$this->getHeroInformation();
	}

	private function getHeroInformation($value='')
	{
		# code...
	}
}