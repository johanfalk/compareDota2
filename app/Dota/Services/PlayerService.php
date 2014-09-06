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

	private $IDService;

	private $statsHandler;

	private $playerDetailRepository;

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
	 */
	public function loadMatches()
	{
		$ID = $this->IDService->getAll();

		if(!$this->matchHandler->matchesAreLoaded($ID->matchID))
		{
			var_dump($this->matchHandler->matchesAreLoaded($ID->steam64ID));
			$matchIDs = $this->api->getMatchIDs($ID->steam64ID);

			$matchesToCallApi = $this->matchHandler->getMatchesToCallApi($matchIDs);

			$matchesFromApi = $this->api->getMatchesFromApi($matchesToCallApi);

			$this->matchHandler->storeMatchesInDatabase($matchesFromApi);

			$this->matchHandler->setSession($ID->matchID);
		}
	}

	/**
	 * Get a steam profile from the dotaApi.
	 * 
	 * @return void 
	 */
	public function getSteamProfile()
	{
		if($IDs = $this->IDService->getAll())
		{
			if(Session::has($IDs->profileID))
			{
				return Session::get($IDs->profileID);
			}
			if($profile = $this->api->oneProfile($IDs->steam64ID))
			{
				$profile = $this->IDService->mergeIDsWithProfile($IDs, $profile);

				Session::put($IDs->profileID, $profile);

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
	public function getPlayer()
	{
		if($profile = $this->getSteamProfile())
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
	public function loadPlayer()
	{
		$player = $this->getPlayer(); 
		
		if(isset($player))
		{
			$this->loadMatches();
			
			return true;
		}

		return false;
	}

	public function getPaginator()
	{
		$ID = $this->IDService->get('steam32ID');

		return $this->playerDetailRepository->getPaginatorWithMatchDetails($ID);
	}

	public function saveID($steamID)
	{
		return $this->IDService->save($steamID);
	}
}