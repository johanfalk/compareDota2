<?php namespace Dota\Handlers;

use Session;
use Dota\Repositories\MatchDetailRepository;
use Dota\Repositories\PlayerDetailRepository;

class MatchHandler
{
	private $matchDetailRepository;

	function __construct(MatchDetailRepository $matchDetailRepository, PlayerDetailRepository $playerDetailRepository)
	{
		$this->matchDetailRepository = $matchDetailRepository;

		$this->playerDetailRepository = $playerDetailRepository;
	}

	/**
	 * get the matches that need to call the Api.
	 * 
	 * @param  array $matchIDs
	 * @return array
	 */
	public function getMatchesToCallApi($matchIDs)
	{
		$matchesNotToCallApi = $this->matchDetailRepository->getStoredMatchIDs($matchIDs);
		
		return $this->sortOutMatchIDsToCall($matchesNotToCallApi, $matchIDs);
	}

	/**
	 * sort out match IDs that were not stored in database.
	 * 
	 * @param  array $matchesNotToCall Matches that were stored in database.
	 * @param  array $matchIDs         All match IDs.
	 * @return aray                    Match IDs to call the api
	 */
	private function sortOutMatchIDsToCall($matchesNotToCallApi, $matchIDs)
	{
		$matchIDsToCallApi = array();

		foreach($matchIDs as $key => $value)
		{
			if(!in_array($value, $matchesNotToCallApi))
			{
				$matchIDsToCallApi[] = $value;
			}
		}
		
		return $matchIDsToCallApi;
	}

	/**
	 * @param  array $matches List of match ids
	 */
	public function storeMatchesInDatabase($matches)
	{	
		foreach($matches as $match)
		{
			$this->matchDetailRepository->putMatchDetails($match->result);
			$this->playerDetailRepository->putPlayersDetails($match->result->players, $match->result->match_id);
		}
	}

	/**
	 * Check if matches for a player is already loaded.
	 * 
	 * @return boolean
	 */
	public function matchesAreLoaded($ID)
	{
		if(Session::has($ID))
		{
			return true;
		}

		return false;
	}

	/**
	 * Set session wtih player ID to know if matches were loaded
	 */
	public function setSession($ID)
	{
		if(isset($ID))
		{
			Session::put('test', 'Matches are loaded!');
		}
	}
}