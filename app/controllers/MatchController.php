<?php

use Dota\Api\DotaService;

class MatchController extends BaseController {

	private $dotaService;

	function __construct(DotaService $dotaService)
	{
		$this->dotaService = $dotaService;
	}

	/**
	 * Store matches related to steam id by ajax request.
	 * 
	 * @param  int $steamid 
	 * @return boolean
	 */
	public function storeMatchesBySteamID($steamid)
	{
		if(Session::get('steamid') === $steamid)
		{
			return $this->dotaService->storeMatches($steamid);

		}else if($this->dotaService->getSteamProfile($steamid))
		{
			return $this->dotaService->storeMatches($steamid);
		}
		return 'false';
	}
}