<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * Home page
 */
Route::get('/', 'HomeController@showHomePage');

/**
 * Show player summeries.
 */
Route::get(

	'player/{steamID}', 

	'PlayerController@showPlayerSummeries'

);

/**
 * Show stats compared between players.
 */
Route::get(

	'player/{steamID1}/vs/{steamID2}', 

	'PlayerController@showComparedStats'

);

/**
 * Load the player with an ajax request.
 */
Route::post(

	'player/{steamID}/load', 

	'PlayerController@loadPlayerSummeriesByAjax'

);

/**
 * Show details for one match.
 */
Route::get(

	'match/{matchID}', 

	'MatchController@showMatchDetails'

);

/**
 * Use this to test stuff like queries.
 */
Route::get('test', function() 
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
	    ->where('player_detail.id', '=', 51170241)
	    ->get();

	    return Response::json(array_shift($stats));
});

/**
 * Log queries done by Laravel.
 */
/*Event::listen('illuminate.query', function($sql, $bindings, $time){
    echo $sql;          // select * from my_table where id=? 
    print_r($bindings); // Array ( [0] => 4 )
    echo $time;         // 0.58 

    // To get the full sql query with bindings inserted
    $sql = str_replace(array('%', '?'), array('%%', '%s'), $sql);
    $full_sql = vsprintf($sql, $bindings);
});*/