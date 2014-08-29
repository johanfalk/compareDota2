<?php namespace Dota\Handlers;

use DB;
use MatchDetailsGlobal;
use MatchDetailsPlayer;

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
		$matchesIDsToCallApi = array();

		foreach($matchIDs as $key => $value)
		{
			if(!in_array($value, $matchesNotToCall))
			{
				$matchesIDsToCallApi[] = $value;
			}
		}
		return $matchesIDsToCallApi;
	}

	/**
	 * @param  array $matches List of match ids
	 */
	public function storeMatchesInDatabase($matches)
	{	
		foreach($matches as $match)
		{
			$this->putGlobalDetailsData($match->result);
			$this->putPlayerDetailsData($match->result->players, $match->result->match_id);
		}
	}

	/**
	 * Get matches related to steam ID
	 * 
	 * @param  int $steamIDs
	 * @return array
	 */
	public function getMatchesFromDatabase($steamIDs)
	{
		return DB::table('match_detail_global')
			->join('match_detail_players', 'match_detail_global.match_id', '=', 'match_detail_players.match_id')
			->where('id_32', '=', $steamIDs->steam32ID)
			->get();
	}

	/**
	 * Put global stats for a game in database.
	 * 
	 * @param  object $data match specific data
	 */
	private function putGlobalDetailsData($data)
	{
		$match = new MatchDetailsGlobal();

		$match->match_id = $data->match_id;
		$match->radiant_win = $data->radiant_win;
		$match->duration = $data->duration;
		$match->start_time = $data->start_time;
		$match->match_seq_num = $data->match_seq_num;
		$match->first_blood_time = $data->first_blood_time;
		$match->lobby_type = $data->lobby_type;
		$match->game_mode = $data->game_mode;

		$match->save();
	}

	/**
	 * Put players stats for a game in database.
	 * 
	 * @param  [type] $players [description]
	 * @param  [type] $matchID [description]
	 * @return [type]          [description]
	 */
	private function putPlayerDetailsData($players, $matchID)
	{
		foreach($players as $data) {

			$match = new MatchDetailsPlayer();

			$match->match_id = $matchID;
			$match->id_32 = $data->account_id;
			$match->player_slot = $data->player_slot;
			$match->hero_id = $data->hero_id;
			$match->item_0 = $data->item_0;
			$match->item_1 = $data->item_1;
			$match->item_2 = $data->item_2;
			$match->item_3 = $data->item_3;
			$match->item_4 = $data->item_4;
			$match->item_5 = $data->item_5;
			$match->kills = $data->kills;
			$match->deaths = $data->deaths;
			$match->assists = $data->assists;
			$match->leaver_status = $data->leaver_status;
			$match->gold = $data->gold;
			$match->last_hits = $data->last_hits;
			$match->denies = $data->denies;
			$match->gold_per_min = $data->gold_per_min;
			$match->xp_per_min = $data->xp_per_min;
			$match->gold_spent = $data->gold_spent;
			$match->hero_damage = $data->hero_damage;
			$match->tower_damage = $data->tower_damage;
			$match->hero_healing = $data->hero_healing;
			$match->level = $data->level;

			$match->save();
		}
	}
}