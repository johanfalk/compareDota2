<?php

use Dota\Services\PlayerService;

class PlayerController extends BaseController {

	private $playerService;

	function __construct(PlayerService $playerService)
	{
		$this->playerService = $playerService;
	}

	/**
	 * Show player matches, profile and stats.
	 * 
	 * @param  int $steamID 
	 */
	public function showPlayerSummeries($steamID)
	{
		$this->playerService->saveID($steamID);

		if(!$player = $this->playerService->getPlayer())
		{
			return Redirect::to('/')->with('message', 'Invalid Steam ID');
		}

		$this->playerService->loadMatches();

		$matchDetails = $this->playerService->getPaginator();

		return View::make('player.summeries')
	 	    ->with('player', $player)
	 	    ->with('matchDetails', $matchDetails);
	}

	/**
	 * Http Request from front-end.
	 * 
	 * @param  int $steamID 
	 * @return json
	 */
	public function loadPlayerSummeriesByAjax()
	{
		$this->playerService->saveID(Input::get('steamID'));

	 	if($this->playerService->loadPlayer())
		{
			return Response::json('Success');
		}
		return Response::json('Failed');
	}
}