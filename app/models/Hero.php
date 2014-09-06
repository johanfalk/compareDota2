<?php

class Hero extends Eloquent
{
	public $incrementing = false;

	public $timestamps = false;	

	protected $table = 'heroes';
}