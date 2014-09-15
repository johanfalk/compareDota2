<?php

use Dota\Dota;

class MatchController extends BaseController {

	private $dota;

	function __construct(DotaService $dota)
	{
		$this->dota = $dota;
	}

	/**
	 * Show details for one match.
	 * 
	 * @param  int $matchID
	 */
	public function showMatchDetails($matchID)
	{
		if($match = $this->dota->getMatch($matchID))
		{
			return View::make('match.detail')->with('match', $match);
		}
		return Redirect::to('/')->with('message', 'Invalid match ID');
	}
}