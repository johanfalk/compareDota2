<?php

class SteamApi
{

	public static function getPlayerSummaries($steamID)
	{
		if(isset($steamID))
		{
			return json_decode(file_get_contents('https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=74A251B8EE2BED515308DCA521E4B6B9&steamids=' . $steamID));
		}
	}

	public static function getMatchDetails($matchID)
	{

		if(isset($matchID))
		{
			return json_decode(file_get_contents('https://api.steampowered.com/IDOTA2Match_570/GetMatchDetails/v001/?key=74A251B8EE2BED515308DCA521E4B6B9&format=json&match_id=' . $matchID));
		}
	}

	public static function getMatchHistory($steamID)
	{
		if(isset($steamID))
		{
			return json_decode(file_get_contents('https://api.steampowered.com/IDOTA2Match_570/GetMatchHistory/V001/?key=74A251B8EE2BED515308DCA521E4B6B9&account_id=51170241' . $steamID));
		}
	}
}