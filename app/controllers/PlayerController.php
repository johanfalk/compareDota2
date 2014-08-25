<?php

use Dota\Api\DotaService;

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
		if($profile = $this->dotaService->getSteamProfile($steamID)) 
		{
			return View::make('match.all', array(
				'profile' => $profile,
				'matches' => $this->dotaService->getPlayerMatches($steamID)
			));
		}
		return Redirect::to('/')->with('message', 'Retarded f*ck...');
	}
}
