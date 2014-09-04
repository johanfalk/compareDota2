<?php namespace Dota\Entities;

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

		$this->getInfo();
	}

	private function getInfo($value='')
	{
		# code...
	}
}