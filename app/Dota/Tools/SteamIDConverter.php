<?php namespace Dota\Tools;

class SteamIDConverter
{
	public $steam64ID;

	public $steam32ID;

	public $profileID;

	public $matchID;

	public $isValid = false;

	/**
	 * Convert one ID and set every other IDs that are needed.
	 * 
	 * @param int $id
	 */
	function __construct($id)
	{
		
		if($this->setSteamBitIDs($id))
		{
			$this->profileID = $this->steam64ID . '-profileID';

			$this->matchID = $this->steam64ID . '-matchID';

			$this->isValid = true;
		}
	}
	
	/**
	 * Set steam 64 and 32 bit IDs.
	 * 
	 * @param int $id
	 */
	private function setSteamBitIDs($id)
	{
	    if (strlen($id) === 17)
	    {
	    	$this->steam64ID = $id;

	        $this->steam32ID = substr($id, 3) - 61197960265728;

	        return true;
	    
	    }else if(strlen($id) === 8)
	    {
	    	$this->steam32ID = $id;

	        $this->steam64ID = '765'.($id + 61197960265728);

	        return true;
	    }

	    return false;
	}
}