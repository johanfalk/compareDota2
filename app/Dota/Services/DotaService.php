<?php namespace Dota\Services;

use Session;
use Cache;
use Dota\Api\DotaApi;
use Dota\Handlers\DotaMatchHandler;
use Dota\SteamIDConverter;
use Dota\Player;

/**
* Service for the Steam api.
*/
class DotaService
{
	private $dotaApi;

	private $dotaMatchHandler;

	function __construct(DotaApi $dotaApi, DotaMatchHandler $dotaMatchHandler)
	{
		$this->dotaApi = $dotaApi;
	
		$this->dotaMatchHandler = $dotaMatchHandler;
	}

	/**
	 * Return true if storing matches was successful.
	 * 
	 * @param  int $steamID
	 * @return boolean
	 */
	public function getPlayerMatches($steamID)
	{
		$matchIDs = $this->dotaApi->getMatchIDs($steamID);

		$matchesToCallApi = $this->dotaMatchHandler->getMatchesToCallApi($matchIDs);

		$matchesFromApi = $this->dotaApi->getMatchesFromApi($matchesToCallApi);

		$this->dotaMatchHandler->storeMatchesInDatabase($matchesFromApi);

		return $this->dotaMatchHandler->getMatchesFromDatabase($matchIDs);
	}

	/**
	 * Get a steam profile from the dotaApi.
	 * 
	 * @param  int $steamID Steam ID
	 * @return void 
	 */
	public function getSteamProfile($steamID)
	{
		$steamIDs = $this->getSteamIDs(); 

		if(Session::has($steamIDs->profile))
		{
			return Session::get($steamIDs->profile);
		}
		if($profile = $this->dotaApi->oneProfile($steamID))
		{
			Session::put($steamIDs->profile, $profile);

			return $profile;
		}

		return false;
	}

	public function getSteamIDs($steamID)
	{
		return new SteamIDConverter($steamID);
	}

	/**
	 * Get player summeries and store it within a new ojbect.
	 * 
	 * @param  int $steamID
	 * @return T          		False or object
	 */
	public function getPlayerSummeries($steamID)
	{
		if($profile = $this->getSteamProfile($steamID)) 
		{
			$matches = $this->getPlayerMatches($steamID);

			$player = new PLayer($steamID, $profile, $matches);
		
			Cache::put($steamID, $player, 20);

			return $player; 
		}
	
		return false;
	}
}