<?php namespace Dota\Handlers;

/**
* 
*/
class DotaIDHandler
{
	public $steam32;

	public $steam64;

	public function setIDs($id)
	{
	    if (strlen($id) === 17)
	    {
	    	$this->steam64 = $id;

	        $this->steam32 = substr($id, 3) - 61197960265728;

	        return;
	    }
	    else if(strlen($id) === 8)
	    {
	    	$this->thirtyTwo = $id;

	        $this->steam64 = '765'.($id + 61197960265728);

	        return;
	    }

	    $this->steam64 = false;
	    $this->steam32 = false;
	}

	public function getSteam64ID($id)
	{
		$this->setIDs($id);

		return $this->steam64;
	}

	public function getSteam32ID($id)
	{
		$this->setIDs($id);

		return $this->steam32;
	}

	public function getProfileID($id = null)
	{
		if(!is_null($id))
		{
			return $steam . '-profile';
		}
		return false;
	}
}