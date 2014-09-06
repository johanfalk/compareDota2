<?php namespace Dota\Services;

use Session;
use Dota\Tools\SteamIDConverter;

class IDService
{
	/**
	 * Convert one ID to different kinds of steam IDs.
	 * 
	 * @param  int $IDs
	 * @return T				false / object 
	 */
	private function convertID($IDs)
	{
		if(isset($IDs))
		{
			$IDs = new SteamIDConverter($IDs);

			if($IDs->isValid)
				return $IDs;
		}

		return false;
	}

	/**
	 * Validate an array of IDs
	 * 
	 * @param  array $IDs
	 * @return boolean     
	 */
	public function validateIDs($IDs)
	{
		foreach($IDs as $ID)
		{
			if(!$this->getPlayerIDs($ID))
			{
				return false;
			}
		}

		return true;
	}

	/**
	 * Returns all IDs that was valid throught getPlayerIDs()
	 * 
	 * @param  array $IDs
	 * @return array     		Containing SteamIDConverter objects
	 */
	public function getMultiplePlayerIDs($IDs)
	{
		$playerIDs = array();

		foreach($IDs as $ID)
		{
			if($ID = $this->convertID($ID))
			{
				if(!in_array($ID, $playerIDs))
				{
					$playerIDs[] = $ID;					
				}
			}
		}

		return $playerIDs;
	}

	public function mergeIDsWithProfile($IDs, $profile)
	{
		if($this->hasIDs())
		{
			foreach($IDs as $key => $value)
			{
				$profile->$key = $value;
			}			
		}

		return $profile;
	}

	public function save($ID)
	{
		if($IDs = $this->convertID($ID))
		{
			$this->setSession($IDs);

			return true;
		}
		return false;
	}

	private function setSession($IDs)
	{
		Session::put('SteamIDs', $IDs);
	}

	public function get($ID = 'steam64ID')
	{
		if($IDs = $this->getAll())
		{
			return $IDs->$ID;
		}

		return false;
	}

	public function hasIDs()
	{
		return Session::has('SteamIDs');
	}

	public function getAll()
	{
		if($this->hasIDs())
		{
			return Session::get('SteamIDs');
		}

		return $this->getPlayerIDs();
	}
}