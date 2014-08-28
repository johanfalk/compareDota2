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
		if($steamIDs = $this->getSteamIDs($steamID))
		{
			if(Session::has($steamIDs->profileID))
			{
				return Session::get($steamIDs->profileID);
			}
			if($profile = $this->dotaApi->oneProfile($steamIDs->steam64ID))
			{
				Session::put($steamIDs->profileID, $profile);

				return $profile;
			}
		}

		return false;
	}

	/**
	 * Convert one ID to different kinds of ID.
	 * 
	 * @param  int $steamID
	 * @return T				false / object 
	 */
	public function getSteamIDs($steamID)
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
	 * Get player summeries and store it within a new ojbect.
	 * 
	 * @param  int $steamID
	 * @return T          		false / object
	 */
	public function getPlayerSummeries($steamID)
	{
		if($steamIDs = $this->getSteamIDs($steamID))
		{
			if(Cache::has($steamIDs->steam64ID))
			{
				return Cache::get($steamIDs->steam64ID);
			}
			else if($profile = $this->getSteamProfile($steamIDs->steam64ID)) 
			{
				$matches = $this->getPlayerMatches($steamIDs->steam64ID);

				$player = new PLayer($steamIDs, $profile, $matches);
			
				Cache::put($steamIDs->$steam64ID, $player, 20);

				return $player; 
			}			
		}
	
		return false;
	}
}