<?php

class Match extends Eloquent {

	public $match_id;

	function __construct($match_idq)
	{
		$this->match_id = $match_id;
	}

	public function getDetails()
	{
		if($details = $this->matchStoredInDatabase())
		{	
			$details->players = DB::table('match_detail_players')->where('match_id', '=', $this->match_id)->get();
			
			return $details;	
		}
		else
		{
			$steamApi = new SteamApi();

			$details = $steamApi->getMatchDetails($this->match_id);

			$this->storeMatchInDatabase($details);

			return $details;
		}
	}

	private function matchStoredInDatabase()
	{
		return DB::table('match_detail_global')->where('match_id', $this->match_id)->first();
	}

	private function storeMatchInDatabase($details)
	{
		// if match store in database
	}
}
