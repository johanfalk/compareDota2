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

/*Route::get('/add', function(){
	$heroes = json_decode(file_get_contents('https://api.steampowered.com/IEconDOTA2_570/GetHeroes/v0001/?language=en&key=74A251B8EE2BED515308DCA521E4B6B9'));

	$heroes = $heroes->result->heroes;

	foreach ($heroes as $npc) {
		$hero = new Hero();

		$hero->id = $npc->id;
		$hero->name = $npc->localized_name;
		$hero->machine_name = $npc->name;

		$hero->save();
	}
});*/

/**
 * HomeController
 */
Route::get('/', 'HomeController@showHomePage');

/**
 * PlayerController
 */
Route::get('player/{steamID}', 'PlayerController@showPlayerSummeries');
Route::get('player/{steamID1}/vs/{steamID2}', 'PlayerController@showComparedStats');

Route::post('load-player', 'PlayerController@loadPlayerSummeriesByAjax');

/**
 * MatchController
 */
Route::get('match/{matchID}', 'MatchController@showMatchDetails');
