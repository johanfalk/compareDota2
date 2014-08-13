<?php

class SteamApi
{
	private $key;

	private $baseUrl;

	function __construct()
	{
		$this->key = '74A251B8EE2BED515308DCA521E4B6B9'; 

		$this->baseUrl = 'https://api.steampowered.com/';
	}

	public function getPlayerSummaries($steamID, $option = 'all')
	{
		if(isset($steamID) && $option == 'all')
		{
			$data =  json_decode(file_get_contents($this->baseUrl . 'ISteamUser/GetPlayerSummaries/v0002/?key=' . $this->key . '&steamids=' . $steamID));

			return $data->response->players;
		}
		else if(isset($steamID) && is_int($option))
		{
			$data =  json_decode(file_get_contents($this->baseUrl . 'ISteamUser/GetPlayerSummaries/v0002/?key=' . $this->key . '&steamids=' . $steamID));

			return array_shift($data->response->players);
		}
	}

	public function getMatchDetails($matchID)
	{

		if(isset($matchID))
		{
			return json_decode(file_get_contents($this->baseUrl . 'IDOTA2Match_570/GetMatchDetails/v001/?key=' . $this->key . '&format=json&match_id=' . $matchID));
		}
	}

	public function getMatchHistory($steamID)
	{
		if(isset($steamID))
		{
			return json_decode(file_get_contents($this->baseUrl . 'IDOTA2Match_570/GetMatchHistory/V001/?key=' . $this->key . '&account_id=51170241' . $steamID));
		}
	}
}