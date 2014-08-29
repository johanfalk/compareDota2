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
			return View::make('player.summeries')->with('player', $playerSummeries);
		}
		return Redirect::to('/')->with('message', 'Invalid Steam ID');
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

	 	if($playerSummeries = $this->dotaService->getPlayerSummeries($steamID))
		{
			return Response::json('Success');
		}
		return Response::json('Failed');
	}

/*	public function showComparedStats($steamID1, $steamID2)
	{
		if($profiles = $dotaService->getMultiplePlayerProfiles())
		{
			$playerOne = $this->dotaService->getPlayerMatches($steamID));
		}
	}*/
}