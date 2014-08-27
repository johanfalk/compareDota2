<?php namespace Dota\Handlers;

use DB;

class DotaMatchHandler
{
	/**
	 * get the matches that need to call the Api.
	 * @param  array $matchIDs
	 * @return array
	 */
	public function getMatchesToCallApi($matchIDs)
	{
		$matchesNotToCall = DB::table('match_detail_global')->whereIn('match_id', $matchIDs)->lists('match_id');

		return $this->sortOutMatchIDsToCall($matchesNotToCall, $matchIDs);
	}

	/**
	 * sort out match IDs that were not stored in database.
	 * 
	 * @param  array $matchesNotToCall Matches that were stored in database.
	 * @param  array $matchIDs         All match IDs.
	 * @return aray                    Match IDs to call the api
	 */
	private function sortOutMatchIDsToCall($matchesNotToCall, $matchIDs)
	{
		foreach($matchIDs as $key => $value)
		{
			if(!in_array($value, $matchesNotToCall))
			{
				$matchesIDsToCallApi[] = $value;
			}
		}
		return $matchesIDsToCallApi;
	}

	public function storeMatchesInDatabase($matches)
	{	
		var_dump('storeMatchesInDatabase');
		return true;
	}

	public function getMatchesFromDatabase($matchIDs)
	{
		var_dump('getMatchesFromDatabase, Cache matches');
		return true;
	}
}