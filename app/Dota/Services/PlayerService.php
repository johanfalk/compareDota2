<?php namespace Dota\Services;

use Session;
use Cache;
use Dota\Api\Api;
use Dota\Handlers\MatchHandler;
use Dota\Handlers\IDHandler;
use Dota\Entities\Player;

/**
* Service for the Steam api.
*/
class PlayerService
{
	private $api;

	private $matchHandler;

	public $IDHandler;

	function __construct(Api $api, MatchHandler $matchHandler, IDHandler $IDHandler)
	{
		$this->api = $api;
	
		$this->matchHandler = $matchHandler;

		$this->IDHandler = $IDHandler;
	}

	/**
	 * @param  int $steamID
	 */
	public function loadPlayerMatches($steamID)
	{
		$matchIDs = $this->api->getMatchIDs($steamID);

		$matchesToCallApi = $this->matchHandler->getMatchesToCallApi($matchIDs);
		
		$matchesFromApi = $this->api->getMatchesFromApi($matchesToCallApi);
		
		$this->matchHandler->storeMatchesInDatabase($matchesFromApi);
	}

	/**
	 * Get a steam profile from the dotaApi.
	 * 
	 * @param  int $steamID Steam ID
	 * @return void 
	 */
	public function getSteamProfile($steamID)
	{
		if($steamIDs = $this->IDHandler->getPlayerIDs($steamID))
		{
			if(Session::has($steamIDs->profileID))
			{
				return Session::get($steamIDs->profileID);
			}
			if($profile = $this->api->oneProfile($steamIDs->steam64ID))
			{
				$profile = $this->IDHandler->mergeProfileWithIDs($steamIDs, $profile);

				Session::put($steamIDs->profileID, $profile);

				return $profile;
			}
		}

		return false;
	}

	/**
	 * Get player summeries and store it within a new ojbect.
	 * 
	 * @param  int $steamID
	 * @return T          		false / object
	 */
	public function getPlayer($steamID)
	{
		if($profile = $this->getSteamProfile($steamID))
		{
			return Cache::remember($profile->steam64ID, 20, function() use ($profile)
			{
				$player = new Player($profile);

				return $player;
			});
		}

		return false;
	}

	/**
	 * [loadPlayer description]
	 * 
	 * @param  [type] $steamID [description]
	 * @return [type]     [description]
	 */
	public function loadPlayer($steamID)
	{
		$playerSymmeries = $this->getPlayerSummeries($steamID); 
		
		if(isset($playerSymmeries))
		{
			$this->loadPlayerMatches($playerSymmeries->profile->steam64ID);

			return true;
		}

		return false;
	}
}