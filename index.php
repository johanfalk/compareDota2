<?php
session_start();

header('content-type: application/json');

if(!isset($_SESSION['test'])) {
	$_SESSION['test'] = file_get_contents("https://api.steampowered.com/IEconDOTA2_570/GetHeroes/v0001/?language=en&key=74A251B8EE2BED515308DCA521E4B6B9");
}

print_r($_SESSION['test']);