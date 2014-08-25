<?php namespace Dota\Api;

class DotaApi
{
	protected $apiKey = '74A251B8EE2BED515308DCA521E4B6B9';

	public function oneProfile($id)
	{
		$url = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=' . $this->apiKey . '&steamids=' . $id;
		
		$data = $this->makeCall($url);
		
		return array_shift($data->response->players);
		
	}

	public function getMatchIDs($steamid)
	{
		$url = 'https://api.steampowered.com/IDOTA2Match_570/GetMatchHistory/V001/?key=' . $this->apiKey . '&account_id=' . $steamid;
		
		return $this->makeCall($url);
	}

	private function makeCall($url)
	{
		return json_decode(file_get_contents($url));
	}
}
/*
	public function heroes()
	{
		$url = 'https://api.steampowered.com/IEconDOTA2_570/GetHeroes/v0001/?language=en&key=' . $this->apiKey;
		
		$this->makeCall();
		return $this;
	}*/
/*	public function matchDetails($id, $params = '')
	{
		$this->$urls['matchDetail'] = 'https://api.steampowered.com/IDOTA2Match_570/GetMatchDetails/v001/?key=' . $this->apiKey . '&format=json&match_id=' . $id . $params;
		return $this;
	}
*/
/*	public function multipleProfiles($id)
	{
		$this->urls['multipleProfiles'] = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=' . $this->apiKey . '&steamids=' . explode(',', $id);
		return $this;
	}*/
