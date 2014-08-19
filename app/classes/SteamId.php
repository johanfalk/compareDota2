<?php

/**
 * Convert 64bit IDs to 32bit or the other way around. 
 */
class SteamId
{

	public $sixtyFour;

	public $thirtyFour;

	/**
	 * @param int $id
	 * @return string 
	 */
	function __construct($id)
	{
	    if (strlen($id) === 17)
	    {
	    	$this->sixtyFour = $id;

	        $this->thirtyFour = substr($id, 3) - 61197960265728;
	    }
	    else if(strlen($id) === 8)
	    {
	    	$this->thirtyFour = $id;

	        $sixtyFour = '765'.($id + 61197960265728);
	    }

	    return $this->sixtyFour;
	}
}