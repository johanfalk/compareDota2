<?php namespace Dota;

class SteamIDConverter
{
	public $steam64ID;

	public $steam32ID;

	public $profileID;

	public $matchID;

	function __construct($id)
	{
		if($this->setSteamBitIDs($id))
		{
			$this->profileID = $this->steam64ID . '-profileID';

			$this->matchID = $this->steam64ID . '-matchID';

			return true;	
		}

		return false;
	}

	private function setSteam64($id)
	{
	    if (strlen($id) === 17)
	    {
	    	$this->steam64 = $id;

	        $this->steam32 = substr($id, 3) - 61197960265728;

	        return true;
	    
	    }else if(strlen($id) === 8)
	    {
	    	$this->thirtyTwo = $id;

	        $this->steam64 = '765'.($id + 61197960265728);

	        return true;
	    }

	    return false;
	}
}