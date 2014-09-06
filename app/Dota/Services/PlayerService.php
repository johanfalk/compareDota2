<?php namespace Dota\Services;

use Session;
use Cache;
use Dota\Api\Api;
use Dota\Handlers\MatchHandler;
use Dota\Handlers\StatsHandler;
use Dota\Services\IDService;
use Dota\Entities\Player;
use Dota\Repositories\PlayerDetailRepository;

/**
* Service for the Steam api.
*/
class PlayerService
{
	private $api;

	private $matchHandler;

	public $IDService;

	function __construct(Api $api, MatchHandler $matchHandler, StatsHandler $statsHandler, IDService $IDService, PlayerDetailRepository $playerDetailRepository)
	{
		$this->api = $api;
	
		$this->matchHandler = $matchHandler;

		$this->IDService = $IDService;

		$this->statsHandler = $statsHandler;

		$this->playerDetailRepository = $playerDetailRepository;
	}

	/**
	 * This function always expect a steam 64 bit ID.
	 * 
	 * @param  int $steam64ID
	 */
	public function loadMatches($steamID)
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
		if($steamIDs = $this->IDService->getPlayerIDs($steamID))
		{
			if(Session::has($steamIDs->profileID))
			{
				return Session::get($steamIDs->profileID);
			}
			if($profile = $this->api->oneProfile($steamIDs->steam64ID))
			{
				$profile = $this->IDService->mergeProfileWithIDs($steamIDs, $profile);

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
				$stats = $this->statsHandler->getPlayerStats($profile);

				$player = new Player($profile, $stats);

				return $player;
			});
		}

		return false;
	}

	/**
	 *	Load player matches and profile.
	 * 
	 * @param  int $steamID
	 * @return boolean
	 */
	public function loadPlayer($steamID)
	{
		$player = $this->getPlayer($steamID); 
		
		if(isset($player))
		{
			$this->loadMatches($player->profile->steam64ID);
			
			return true;
		}

		return false;
	}

	public function getPaginator($id)
	{
		return $this->playerDetailRepository->getPaginatorWithMatchDetails($id);
	}
}