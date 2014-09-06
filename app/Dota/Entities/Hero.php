<?php namespace Dota\Entities;

use Dota\Repositories\HeroRepository;

class Hero
{
	public $name;

	public $iconPath;

	public $type;

	public $abilities;

	private $heroRepository;

	function __construct($attributes)
	{
		$this->setAttributes($attributes);
	}

	private function setAttributes($attributes)
	{
		# code...
	}
}