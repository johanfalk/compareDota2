<?php

use Dota\Services\DotaService;

class MatchController extends BaseController {

	private $dotaService;

	function __construct(DotaService $dotaService)
	{
		$this->dotaService = $dotaService;
	}

	public function showMatchDetails($matchID)
	{
		if($match = 10) // $match = $this->dotaService->getMatchDetails($matchID)
		{
			return View::make('match.detail')->with('match', $match);
		}
		return Redirect::to('/')->with('message', 'Invalid match ID');
	}

	public function showComparedMatches($steamID1, $steamID2)
	{
		if($this->dotaService->isValidID($steamID1, $steamID2))
		{
			return 
		}
	}
}