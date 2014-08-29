<?php namespace Dota\Handlers;

use Dota\SteamIDConverter;

class DotaIDHandler
{
	/**
	 * Convert one ID to different kinds of steam IDs.
	 * 
	 * @param  int $steamID
	 * @return T				false / object 
	 */
	public function getPlayerIDs($steamID)
	{
		if(isset($steamID))
		{
			$steamIDs = new SteamIDConverter($steamID);

			if($steamIDs->isValid)
				return $steamIDs;
		}

		return false;
	}

	/**
	 * Validate an array of IDs
	 * 
	 * @param  array $steamIDs
	 * @return boolean     
	 */
	public function validateIDs($steamIDs)
	{
		foreach($steamIDs as $ID)
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
	 * @param  array $steamIDs
	 * @return array     		Containing SteamIDConverter objects
	 */
	public function getMultiplePlayerIDs($steamIDs)
	{
		$playerIDs = array();

		foreach($steamIDs as $ID)
		{
			if($ID = $this->getPlayerIDs($ID))
			{
				if(!in_array($ID, $playerIDs))
				{
					$playerIDs[] = $ID;					
				}
			}
		}

		return $playerIDs;
	}
}