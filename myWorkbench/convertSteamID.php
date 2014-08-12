<?php
 
/**
 * Convert 64bit IDs to 32bit or the other way around. 
 */
function convert_id($id)
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