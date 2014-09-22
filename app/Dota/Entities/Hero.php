<?php namespace Dota\Entities;

class Hero
{
	public $id;
	public $name;
	public $imagePath;
	public $type;
	public $role;
	public $team;
	public $heroGlowColor;
	public $abilities;

	function __construct($attributes)
	{
		// Set attributes.
	}
}