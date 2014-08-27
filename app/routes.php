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
 * HomeController
 */
Route::get('/', 'HomeController@showHomePage');

/**
 * PlayerController
 */
Route::get('player/{steamid}', 'PlayerController@showPlayerSummeries');
Route::post('load-player/{steamid}', 'PlayerController@loadPlayerSummeries');

/**
 * MatchController
 */
Route::get('match/{matchID}', 'MatchController@showMatchDetails');
Route::get('match/{steamID1}/compare/{steamID2}', 'MatchController@showComparedMatches');