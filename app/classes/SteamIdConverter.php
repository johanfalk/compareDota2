<?php

/**
 * Convert 64bit IDs to 32bit or the other way around. 
 */
class SteamIdConverter
{
	/**
	 * @param int $id
	 * @return string 
	 */
	public static function convert($id)
	{
	    if (strlen($id) === 17)
	    {
	        $converted = substr($id, 3) - 61197960265728;
	    }
	    else
	    {
	        $converted = '765'.($id + 61197960265728);
	    }
	 
	    return (string) $converted;
	}
}