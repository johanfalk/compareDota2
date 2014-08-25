<?php namespace Dota\Api;

use Session;

/**
* Service for the Steam api.
*/
class DotaService
{
	private $dotaApi;

	function __construct(DotaApi $dotaApi)
	{
		$this->dotaApi = $dotaApi;
	}

	/**
	 * Return true if storing matches was successful.
	 * 
	 * @param  int $steamid
	 * @return boolean
	 */
	public function storeMatches($steamid)
	{
		$matchIDs = $this->dotaApi->getMatchIDs($steamid);

		$storedMatches = $this->getMatchesFromDatabase($matchIDs);
	}

	private function getMatchesFromDatabase($matchIDs)
	{
		var_dump($matchIDs);
		die;
	}

	/**
	 * Get steam profile from the dotaApi.
	 * 
	 * @param  int $steamid Steam ID
	 * @return void 
	 */
	public function getSteamProfile($steamid)
	{
		if(Session::get('steamid') === $steamid && Session::has('steamProfile'))
		{
			return Session::get('steamProfile');
		}
		
		if($profile = $this->dotaApi->oneProfile($steamid))
		{
			Session::put('steamProfile', $profile);

			Session::put('steamid', $steamid);

			return $profile;
		}
		return false;
	}
}