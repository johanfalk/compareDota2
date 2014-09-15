<?php namespace Dota\Repositories;

use DB;
use PlayerDetail;
use Dota\Entities\Stats;

class PlayerDetailRepository
{
	private $playerDetail;

	function __construct(PlayerDetail $playerDetail)
	{
		$this->playerDetail = $playerDetail;
	}

	/**
	 * Get paginator for player recent matches
	 * 
	 * @param  int  Steam 32 bit ID
	 * @return object
	 */
	public function getPaginator($ID)
	{
		return $this->playerDetail
		    ->with('matchDetail')
		    ->with('hero')
		    ->where('id', '=', $ID)
		    ->paginate(10);
	}

	/**
	 * Put players stats for a game in database.
	 */
	public function putPlayersDetails($players, $matchID)
	{
		foreach($players as $data) {

			$match = new PlayerDetail();

			$match->id = $data->account_id;
			$match->match_detail_id = $matchID;
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

	public function getStats($ID)
	{
		return new Stats($this->getStatsFromDatabase($ID));
	}

	public function getStatsFromDatabase($ID)
	{
		$stats = DB::table('player_detail')
			->join('match_detail', 'player_detail.match_detail_id', '=', 'match_detail.id')
		    ->select(DB::raw(
		    	'avg(player_detail.gold_per_min) as gpm, 
		    	avg(player_detail.xp_per_min) as xpm,
		    	avg(player_detail.kills) as kills,
		    	avg(player_detail.deaths) as deaths,
		    	avg(player_detail.assists) as assists,
		    	avg(player_detail.tower_damage) as towerDmg,
		    	avg(player_detail.hero_damage) as heroDmg,
		    	avg(player_detail.hero_healing) as heroHealing,
		    	count(match_detail.duration) as totalMatches,
		    	(max(match_detail.duration) * count(match_detail.duration)) as totalGameTime'
		    ))
		    ->where('player_detail.id', '=', $ID)
		    ->get();

		return $stats[0];
	}
}