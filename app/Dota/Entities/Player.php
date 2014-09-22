<?php namespace Dota\Entities;

/**
* Store summeries for one player.
*/
class Player
{
	public $communityvisibilitystate;
	public $profilestate;
	public $name;
	public $lastLogOff;
	public $profileUrl;
	public $avatar;
	public $avatarMedium;
	public $avatarFull;
	public $state;
	public $primaryClanID;
	public $timeCreated;
	public $stateFlags;
	public $IDs;
	public $stats;

	function __construct($profile, $stats)
	{
		$this->communityvisibilitystate = $profile->communityvisibilitystate;
		$this->name = $profile->personaname;
		$this->lastLogOff = $profile->lastlogoff;
		$this->profileUrl = $profile->profileurl;
		$this->avatar = $profile->avatar;
		$this->avatarMedium = $profile->avatarmedium;
		$this->avatarFull = $profile->avatarfull;
		$this->state = $profile->personastate;
		$this->primaryClanID = $profile->primaryclanid;
		$this->timeCreated = date($profile->timecreated);
		$this->stateFlags = $profile->personastateflags;
		$this->IDs = $profile->IDs;
		$this->stats = $stats;
	}
}