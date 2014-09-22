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
	return PlayerDetail::with('matchDetail')
	    ->with('hero')
	    ->where('id', '=', 51170241)
	    ->orderBy('match_detail_id', 'desc')
	    ->paginate(10);
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