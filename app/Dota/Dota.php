<?php namespace Dota;

use Cache;
use Dota\Api\Api;
use Dota\Entities\Player;
use Dota\Services\MatchService;
use Dota\Services\PlayerService;
use Dota\Services\IDService;

/**
* Service for the Steam api.
*/
class Dota
{
	private $api;

	private $matchService;

	private $IDService;

	private $playerService;

	function __construct(
		Api $api, 
		MatchService $matchService, 
		IDService $IDService,
		PlayerService $playerService)
	{
		$this->api = $api;
	
		$this->matchService = $matchService;

		$this->IDService = $IDService;

		$this->playerService = $playerService;
	}

	/**
	 * Get the recent matches by player and store it in database
	 */
	public function loadMatches()
	{
		if($IDs = $this->IDService->getAll())
		{
			if(!$status = $this->matchService->matchesAreLoaded($IDs->matchID))
			{
				$matchIDs = $this->api->getMatchIDs($IDs->steam64ID);

				$matchesToCallApi = $this->matchService->getMatchesToCallApi($matchIDs);

				$matchesFromApi = $this->api->getMatchesFromApi($matchesToCallApi);

				$this->matchService->putMatchesInDatabase($matchesFromApi);

				$this->matchService->cacheLoadStatus($IDs->matchID);
			}

			return $status;
		}
		
		return false;
	}

	/**
	 * Get a steam profile from the dotaApi.
	 * 
	 * @return void 
	 */
	public function getSteamProfile()
	{
		if(!$IDs = $this->IDService->getAll())
		{
			return false;
		}

		if(Cache::has($IDs->profileID))
		{
			return Cache::get($IDs->profileID);
		}
		else if($profile = $this->api->oneProfile($IDs->steam64ID))
		{
			$profile->IDs = $IDs;

			Cache::put($IDs->profileID, $profile, 20);

			return $profile;
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
			$stats = $this->playerService->getStats($profile->IDs);
			
			$player = new Player($profile, $stats);
			
			return $player;
		}
		return false;
	}

	/**
	 * Get multiple profiles.
	 * 
	 * @param  array $IDs
	 * @return array      List of profile object
	 */
	public function getMultiplePlayerSummeries($IDs)
	{
		# code...
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
		if($ID = $this->IDService->get('steam32ID'))
		{
			return $this->playerService->getPaginator($ID);
		}
		return false;
	}

	/**
	 * Save ID in session to access it all over the application
	 * 
	 * @param  int $steamID
	 * @return boolean
	 */
	public function saveID($steamID)
	{
		return $this->IDService->save($steamID);
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