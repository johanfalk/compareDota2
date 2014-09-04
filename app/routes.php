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
Route::post('player/{steamID}/load', 'PlayerController@loadPlayerSummeriesByAjax');

/**
 * MatchController
 */
Route::get('match/{matchID}', 'MatchController@showMatchDetails');

/**
 * Tests
 */

Route::get('test', function() 
{

});

/*Event::listen('illuminate.query', function($sql, $bindings, $time){
    echo $sql;          // select * from my_table where id=? 
    print_r($bindings); // Array ( [0] => 4 )
    echo $time;         // 0.58 

    // To get the full sql query with bindings inserted
    $sql = str_replace(array('%', '?'), array('%%', '%s'), $sql);
    $full_sql = vsprintf($sql, $bindings);
});*/