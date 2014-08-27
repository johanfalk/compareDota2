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
	 * Store matches related to steam id by ajax request.
	 * 
	 * @param  int $steamID 
	 * @return boolean
	 */
	public function loadPlayerSummeries($steamID)
	{
	 	if($playerSummeries = $this->dotaService->getPlayerSummeries($steamID))
		{
			return Response::json('Success');
		}
		return Response::json('Failed');
	}

	public function isValidID($id)
	{
		return true;
	}
}