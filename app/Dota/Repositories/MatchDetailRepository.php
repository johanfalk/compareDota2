<?php namespace Dota\Repositories;

use MatchDetail;

class MatchDetailRepository
{
	private $matchDetail;

	function __construct(MatchDetail $matchDetail)
	{
		$this->matchDetail = $matchDetail;
	}

	/**
	 * To know which matches that are already stored
	 * 
	 * @param  array $matchIDs 
	 * @return array
	 */
	public function getStoredMatchIDs($matchIDs)
	{
		return $this->matchDetail->whereIn('id', $matchIDs)->lists('id');
	}


	/**
	 * Put global stats for a game in database.
	 * 
	 * @param  object $data match specific data
	 */
	public function putMatchDetails($data)
	{
		$match = new MatchDetail();

		$match->id = $data->match_id;
		$match->radiant_win = $data->radiant_win;
		$match->duration = $data->duration;
		$match->start_time = $data->start_time;
		$match->match_seq_num = $data->match_seq_num;
		$match->first_blood_time = $data->first_blood_time;
		$match->lobby_type = $data->lobby_type;
		$match->game_mode = $data->game_mode;

		$match->save();
	}
}