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
	public function convertID($ID)
	{
		if(isset($ID))
		{
			$IDs = new SteamIDConverter($ID);

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
			if(!$this->convertID($ID))
			{
				return false;
			}
		}

		return true;
	}

	/**
	 * Merge all IDs inside an object.
	 * 
	 * @param  array/object $IDs
	 * @param  object $object
	 * @return object
	 */
	public function mergeIDsWithObject($IDs, $object)
	{
		if($this->hasIDs())
		{
			foreach($IDs as $key => $value)
			{
				$object->$key = $value;
			}			
		}

		return $object;
	}

	/**
	 * Save current IDs in session.
	 * 
	 * @param  int $ID
	 * @return Boolean
	 */
	public function save($ID)
	{
		if($IDs = $this->convertID($ID))
		{
			$this->setSession($IDs);

			return true;
		}
		return false;
	}

	/**
	 * Set session for current ID in the application
	 * 
	 * @param object $IDs 
	 */
	private function setSession($IDs)
	{
		Session::put('SteamIDs', $IDs);
	}

	/**
	 * Get one ID from the session.
	 * 
	 * @param  string $ID type of the ID
	 * @return int
	 */
	public function get($ID = 'steam64ID')
	{
		if($IDs = $this->getAll())
		{
			return $IDs->$ID;
		}

		return false;
	}

	/**
	 * Check if the application has IDs stored in session.
	 * 
	 * @return boolean
	 */
	public function hasIDs()
	{
		return Session::has('SteamIDs');
	}

	/**
	 * return all IDs
	 * 
	 * @return object
	 */
	public function getAll()
	{
		if($this->hasIDs())
		{
			return Session::get('SteamIDs');
		}

		return false;
	}
}