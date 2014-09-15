<?php namespace Dota\Services;

use Cache;
use Dota\Repositories\PlayerDetailRepository;

class PlayerService
{
	private $playerDetailRepository;

	function __construct(PlayerDetailRepository $playerDetailRepository)
	{
		$this->playerDetailRepository = $playerDetailRepository;
	}

	/**
	 * Get player stats.
	 * 
	 * @param  object $IDs
	 * @return object
	 */
	public function getStats($IDs)
	{
		return Cache::remember($IDs->steam64ID, 20, function() use ($IDs)
		{
			return $this->playerDetailRepository->getStats($IDs->steam32ID);
		});
	}

	/**
	 * Return player paginator from the player repository class.
	 * 
	 * @param  object $IDs
	 * @return object
	 */
	public function getPaginator($ID)
	{
		return $this->playerDetailRepository->getPaginator($ID);
	}
}