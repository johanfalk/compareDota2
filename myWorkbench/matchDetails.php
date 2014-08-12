<?php

class MatchDetails 
{
	private $id;

	/**
	 * Expects match ID.
	 * @param int $id
	 */
	function __construct($id)
	{
		$this->id = $id;

		if(!$this->matchDetailsAlreadyStored())
		{
			$data = $this->callApiForMatchDetails();

			$this->storeGlobalMatchDetails();
			
			$this->storePlayersMatchDetails();

			return $data;
		}
		else
		{
			return $this->getMatchFromDatabase();
		}
	}

	/**
	 * Check if match details already have been stored.
	 * @return boolean
	 */
	private function matchDetailsAlreadyStored()
	{
		// Check if match already have been stored in database.
	}

	private function callApiForMatchDetails()
	{
		// Store new global match details to database.
	}	

	private function storeGlobalMatchDetails()
	{
		// Store new global match details to database.
	}

	private function storePlayersMatchDetails()
	{
		// Store players match details to database.
	}
}