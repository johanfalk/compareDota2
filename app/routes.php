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
Route::get('player/{steamID}', 'PlayerController@showPlayerSummeries');
Route::get('player/{steamID1}/vs/{steamID2}', 'PlayerController@showComparedStats');

Route::post('load-player/{steamID}', 'PlayerController@loadPlayerSummeries');

/**
 * MatchController
 */
Route::get('match/{matchID}', 'MatchController@showMatchDetails');