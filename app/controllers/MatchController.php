<?php

use Dota\Services\DotaService;

class MatchController extends BaseController {

	private $dotaService;

	function __construct(DotaService $dotaService)
	{
		$this->dotaService = $dotaService;
	}

	/**
	 * Show details for one match.
	 * 
	 * @param  int $matchID
	 */
	public function showMatchDetails($matchID)
	{
		if($match = $this->dotaService->getMatchDetails($matchID))
		{
			return View::make('match.detail')->with('match', $match);
		}
		return Redirect::to('/')->with('message', 'Invalid match ID');
	}
}