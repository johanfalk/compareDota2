<?php namespace Dota\Services;

use Session;
use Cache;
use Dota\Api\DotaApi;
use Dota\Handlers\DotaMatchHandler;
use Dota\Handlers\DotaIDHandler;
use Dota\Player;

/**
* Service for the Steam api.
*/
class DotaService
{
	private $dotaApi;

	private $dotaMatchHandler;

	public $dotaIDHandler;

	function __construct(DotaApi $dotaApi, DotaMatchHandler $dotaMatchHandler, DotaIDHandler $dotaIDHandler)
	{
		$this->dotaApi = $dotaApi;
	
		$this->dotaMatchHandler = $dotaMatchHandler;

		$this->dotaIDHandler = $dotaIDHandler;
	}

	/**
	 * Return true if storing matches was successful.
	 * 
	 * @param  int $steamID
	 * @return boolean
	 */
	public function getPlayerMatches($steamIDs)
	{
		$matchIDs = $this->dotaApi->getMatchIDs($steamIDs->steam64ID);

		$matchesToCallApi = $this->dotaMatchHandler->getMatchesToCallApi($matchIDs);
		
		$matchesFromApi = $this->dotaApi->getMatchesFromApi($matchesToCallApi);
		
		$this->dotaMatchHandler->storeMatchesInDatabase($matchesFromApi);

		return $this->dotaMatchHandler->getMatchesFromDatabase($steamIDs);
	}

	/**
	 * Get a steam profile from the dotaApi.
	 * 
	 * @param  int $steamID Steam ID
	 * @return void 
	 */
	public function getSteamProfile($steamID)
	{
		if($steamIDs = $this->dotaIDHandler->getPlayerIDs($steamID))
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
	 * Get player summeries and store it within a new ojbect.
	 * 
	 * @param  int $steamID
	 * @return T          		false / object
	 */
	public function getPlayerSummeries($steamID)
	{
		if($steamIDs = $this->dotaIDHandler->getPlayerIDs($steamID))
		{
			if(Cache::has($steamIDs->steam64ID))
			{
				return Cache::get($steamIDs->steam64ID);
			}
			else if($profile = $this->getSteamProfile($steamIDs->steam64ID)) 
			{
				$matches = $this->getPlayerMatches($steamIDs);

				$player = new Player($steamIDs, $profile, $matches);

				Cache::put($steamIDs->steam64ID, $player, 20);

				return $player; 
			}
		}
	
		return false;
	}

	public function getMultiplePlayerProfiles($steamIDs)
	{
		# code...
	}
}