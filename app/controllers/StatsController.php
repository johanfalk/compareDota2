<?php

class StatsController extends BaseController {

	public function showPlayerStats()
	{
		$steamApi = new SteamApi();

		return Response::json($steamApi->getMatchDetails('828388121'));
	}
}
