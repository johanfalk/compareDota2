<?php

use Dota\Services\PlayerService;
use Dota\Repositories\PlayerDetailRepository;

class PlayerController extends BaseController {

	private $playerService;

	private $playerDetailRepository;

	function __construct(PlayerService $playerService, PlayerDetailRepository $playerDetailRepository)
	{
		$this->playerService = $playerService;

		$this->playerDetailRepository = $playerDetailRepository;
	}

	/**
	 * Show player matches, profile and stats.
	 * 
	 * @param  int $steamID 
	 */
	public function showPlayerSummeries($steamID)
	{
		$player = $this->playerService->getPlayer($steamID);

		if(!isset($player))
		{
			return Redirect::to('/')->with('message', 'Invalid Steam ID');
		}

		$this->playerService->loadPlayerMatches($player->profile->steam64ID);

		$matchDetails = $this->playerDetailRepository->getPaginatorWithMatchDetail($player->profile->steam32ID);

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
		$steamID = Input::get('steamID');

	 	if($this->playerService->loadPlayer($steamID))
		{
			return Response::json('Success');
		}
		return Response::json('Failed');
	}
}