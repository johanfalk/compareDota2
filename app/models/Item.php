<?php

class Item extends Eloquent
{
	public $timestamps = false;	

	public $increments = false;

	protected $table = 'items';
}