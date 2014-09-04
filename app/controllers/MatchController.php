<?php

use Dota\Services\PlayerService;

class MatchController extends BaseController {

	private $playerService;

	function __construct(PlayerService $playerService)
	{
		$this->playerService = $playerService;
	}

	/**
	 * Show details for one match.
	 * 
	 * @param  int $matchID
	 */
	public function showMatchDetails($matchID)
	{
		if($match = $this->playerService->getMatchDetails($matchID))
		{
			return View::make('match.detail')->with('match', $match);
		}
		return Redirect::to('/')->with('message', 'Invalid match ID');
	}
}