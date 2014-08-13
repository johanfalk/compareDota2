<?php

class MatchController extends BaseController {

	public function showMatchDetail()
	{
		$match_id = 828388121;

		$match = new Match($match_id);

		$details = $match->getDetails($match_id);

		return View::make('match')->with('details', $details);
	}
}