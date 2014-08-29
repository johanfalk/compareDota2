<?php namespace Dota\Api;

use Dota\Match;

class DotaApi
{
	protected $apiKey = '74A251B8EE2BED515308DCA521E4B6B9';

	/**
	 * @param int $id 
	 * @return array steam profile
	 */
	public function oneProfile($id)
	{
		$url = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=' . $this->apiKey . '&steamids=' . $id;
		
		$data = $this->makeCall($url);
		
		return array_shift($data->response->players);
	}

	/**
	 * Get all matches played by steam id.
	 * 
	 * @param  int $steamid
	 * @return array
	 */
	public function getMatchIDs($steamid)
	{
		$url = 'https://api.steampowered.com/IDOTA2Match_570/GetMatchHistory/V001/?key=' . $this->apiKey . '&matches_requested=100&account_id=' . $steamid;

		$data = $this->makeCall($url);

		return $this->getMatchIDsFromArray($data->result->matches);
	}

	/**
	 * Use this to sort out match data that I don't want from the api.
	 * 
	 * @param  array $matches data from the "getMatchIDs" api call
	 * @return array
	 */
	private function getMatchIDsFromArray($matches)
	{
		foreach($matches as $match) 
		{
			$matchIDs[] = $match->match_id;
		}
		
		return $matchIDs;
	}

	/**
	 * Make the call to api.
	 * 
	 * @param  string $url
	 * @return T
	 */
	private function makeCall($url)
	{
		return json_decode(file_get_contents($url));
	}

	/**
	 * @param  array $matchIDs list of match ids
	 * @return array<Match>    match details
	 */
	public function getMatchesFromApi($matchIDs)
	{
		$matches = array();
		
		foreach($matchIDs as $matchID)
		{
			$matches[] = $this->getMatchDetails($matchID);
		}

		return $matches;
	}

	/**
	 * Get match by match ID.
	 * 
	 * @param  int $id match ID
	 * @return array
	 */
	public function getMatchDetails($id)
	{
		$url = 'https://api.steampowered.com/IDOTA2Match_570/GetMatchDetails/v001/?key=' . $this->apiKey . '&format=json&match_id=' . $id;
		
		return $this->makeCall($url);
	}
}

/*	public function multipleProfiles($id)
	{
		$this->urls['multipleProfiles'] = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=' . $this->apiKey . '&steamids=' . explode(',', $id);
		return $this;
	}*/
