<?php

class StatsController extends BaseController {

	public function showPlayerStats()
	{
		//return Response::json(SteamApi::getMatchDetails('828388121'));
	
		return Response::json(SteamApi::getMatchHistory('23654985'));
	}
}
