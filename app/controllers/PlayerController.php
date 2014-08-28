<?php

use Dota\Services\DotaService;

class PlayerController extends BaseController {

	private $dotaService;

	function __construct(DotaService $dotaService)
	{
		$this->dotaService = $dotaService;
	}

	/**
	 * Show player matches and is profile.
	 * 
	 * @param  int $steamID 
	 */
	public function showPlayerSummeries($steamID)
	{
		if($playerSummeries = $this->dotaService->getPlayerSummeries($steamID))
		{
			return View::make('match.all', array('playerSummeries', $playerSummeries));
		}
		return Redirect::to('/')->with('message', 'Invalid Steam ID');
	}

	/**
	 * Http Request from front-end.
	 * 
	 * @param  int $steamID 
	 * @return json
	 */
	public function loadPlayerSummeries($steamID)
	{
	 	if($playerSummeries = $this->dotaService->getPlayerSummeries($steamID))
		{
			return Response::json('Success');
		}
		return Response::json('Failed');
	}

	public function showComparedStats($steamID1, $steamID2)
	{
		if($playerOne = $this->dotaService->getPlayerSummeries() && $playerTwo = $this->dotaService->getPlayerSummeries())
		{

		}
		return View::make('player.compare');
	}
}