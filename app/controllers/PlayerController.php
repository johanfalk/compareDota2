<?php

use Dota\Dota;

class PlayerController extends BaseController {

	private $dota;

	function __construct(Dota $dota)
	{
		$this->dota = $dota;
	}

	/**
	 * Show player matches, profile and stats.
	 * 
	 * @param  int $steamID 
	 */
	public function showPlayerSummeries($steamID)
	{
		$this->dota->saveID($steamID);

		if($this->dota->loadPlayer())
		{
			$player = $this->dota->getPlayerSummeries();

			$matches = $this->dota->getPaginatorForPlayer();

			return View::make('player.summeries')
		 	    ->with('player', $player)
		 	    ->with('matches', $matches);
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
		$this->dota->saveID(Input::get('steamID'));

	 	if($this->dota->loadPlayer())
		{
			return Response::json('Success');
		}
		return Response::json('Failed');
	}
}