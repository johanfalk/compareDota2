<?php namespace Dota;

use Cache;
use Dota\Api\Api;
use Dota\Entities\Player;
use Dota\Services\MatchService;
use Dota\Services\PlayerService;
use Dota\Tools\SteamIDConverter;

/**
* Service for the Steam api.
*/
class Dota
{
	private $api;

	private $matchService;

	private $playerService;

	private $IDs;

	function __construct(Api $api, MatchService $matchService, PlayerService $playerService)
	{
		$this->api = $api;
	
		$this->matchService = $matchService;

		$this->playerService = $playerService;
	}

	/**
	 * Get the recent matches by player and store it in database
	 */
	public function loadMatches()
	{
		if(!$this->IDs->isValid)
		{
			return false;
		}

		if(!$status = $this->matchService->matchesAreLoaded($this->IDs->matchID))
		{
			$matchIDs = $this->api->getMatchIDs($this->IDs->steam64ID);

			$matchesToCallApi = $this->matchService->getMatchesToCallApi($matchIDs);

			$matchesFromApi = $this->api->getMatchesFromApi($matchesToCallApi);

			$this->matchService->putMatchesInDatabase($matchesFromApi);

			$this->matchService->cacheLoadStatus($this->IDs->matchID);
		}
		
		return true;
	}

	/**
	 * Get a steam profile from the dotaApi.
	 * 
	 * @return void 
	 */
	public function getSteamProfile()
	{
		if($this->IDs->isValid)
		{
			if(Cache::has($this->IDs->steam64ID))
			{
				return Cache::get($this->IDs->steam64ID);
			}
			else if($profile = $this->api->oneProfile($this->IDs->steam64ID))
			{
				$profile->IDs = $this->IDs;

				Cache::put($this->IDs->steam64ID, $profile, 20);

				return $profile;
			}
		}
		return false;
	}

	/**
	 * Get player summeries and store it within a new ojbect.
	 * 
	 * @return T          		false / object
	 */
	public function getPlayerSummeries()
	{
		if($profile = $this->getSteamProfile())
		{
			return new Player($profile, $this->playerService->getStats($this->IDs));
		}
		return false;
	}

	/**
	 *	Load player matches and profile.
	 * 
	 * @param  int $steamID
	 * @return boolean
	 */
	public function loadPlayer()
	{
		if($profile = $this->getSteamProfile())
		{
			return $this->loadMatches();
		}
		return false;
	}

	/**
	 * Get paginator for player.
	 * 
	 * @return object
	 */
	public function getPaginatorForPlayer()
	{
		if($this->IDs->isValid)
		{
			return $this->playerService->getPaginator($this->IDs->steam32ID);
		}
		return false;
	}

	/**
	 * Save ID in session to access it all over the application
	 * 
	 * @param  int $ID
	 * @return boolean
	 */
	public function setUser($ID)
	{
		$this->IDs = new SteamIDConverter($ID);
	}

	/**
	 * Get on match and its details.
	 * 
	 * @param  int $matchID
	 * @return object
	 */
	public function getMatch($matchID)
	{
		if($match = $this->matchService->getMatch($matchID))
		{
			return $match;
		}

		$match = $this->api->getMatch($matchID);

		if($match)
		{
			$this->putMatchesInDatabase(array($match));
			
			return $this->matchService->getMatch($matchID);
		}

		return false;
	}
}