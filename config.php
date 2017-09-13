<?php


define('COL_ID', 'ID');
define('COL_TITLE', 'Korte omschrijving');
define('COL_INTERVALS', 'Intervals');
define('COL_OMSCHRIJVING', 'Extra info');
define('COL_KRING', 'Kring');
define('COL_BAAN', '400m Baan');
define('COL_WARMING_UP', 'Warming up');
define('COL_CORE_STABILITY', 'Core stability');
define('COL_LOOPSCHOLING', 'Loopscholing');
define('COL_TUSSENPROGRAMMA', 'Tussenprogramma');
define('COL_HOOFDPROGRAMMA', 'Hoofdprogramma');
define('COL_COOLING_DOWN', 'Cooling down');
define('COL_YOUTUBE_ID', 'Youtube Id');
define('COL_ALT_DESCRIPTION', 'Alt. Omschrijving');
define('COL_VIDEO', 'Video');

$apiConfig = array();
$apiConfig['titles']['IL'] = 'Inleiding';
$apiConfig['titles']['AL'] = 'Algemeen';
$apiConfig['titles']['WU'] = 'Warming Up';
$apiConfig['titles']['CS'] = 'Core stability';
$apiConfig['titles']['KR'] = 'Kring';
$apiConfig['titles']['VK'] = 'Vierkant';
$apiConfig['titles']['OV'] = 'Overig';
$apiConfig['titles']['4B'] = '400m Baan';
$apiConfig['titles']['SB'] = 'Sprint Baan';
$apiConfig['titles']['LS'] = 'Loopscholing';
$apiConfig['titles']['HP'] = 'Hoofdprogramma';
$apiConfig['titles']['CD'] = 'Cooling down';
$apiConfig['titles']['TP'] = 'Tussenprogramma';


//$apiConfig['env'] = getenv('appenv') ? getenv('appenv') : 'prod';

$apiConfig['env'] = strstr($_SERVER['HTTP_HOST'], 'runningdrillsapi.local') ? 'dev' : 'prod';

// api directory
$apiConfig['basedir'] = str_replace('www\api','', str_replace ('www/api','', __DIR__) );

// URL
if ($apiConfig['env'] == "dev") {
	//$apiConfig['baseUrl'] = "localhost";
	$apiConfig['baseUrl'] = "http://runningdrillsapi.local";
	$apiConfig['imagedir'] = $apiConfig['basedir'] . '/images/';
	$apiConfig['imageUrl'] = $apiConfig['baseUrl'] . '/images/';
	$apiConfig['videodir'] = $apiConfig['basedir'] . '/videos/';
	$apiConfig['videoUrl'] = $apiConfig['baseUrl'] . '/videos/';
} else {
	$apiConfig['baseUrl'] = "http://app.kettinglopers.nl";
	$apiConfig['imagedir'] = $apiConfig['basedir'] . '/images/';
	$apiConfig['imageUrl'] = $apiConfig['baseUrl'] . '/images/';
	$apiConfig['videodir'] = $apiConfig['basedir'] . '/videos/';
	$apiConfig['videoUrl'] = $apiConfig['baseUrl'] . '/videos/';
}

// basedir
$apiConfig['logpath'] = $apiConfig['basedir']  . '/logs/';
$apiConfig['assetsPath'] = $apiConfig['basedir'] .'/assets/';


$apiConfig['csvfile'] = $apiConfig['assetsPath'].'trainingsvormen.csv';
$apiConfig['csvsessionsfile'] = $apiConfig['assetsPath'].'sessies.csv';


$apiConfig['demoToken'] = '1234';

$apiConfig['userGroups']['mpm'] = 'MPM - Hengelo';
$apiConfig['userGroups']['clinic-5k'] = 'Clinic - 5km groep';
$apiConfig['userGroups']['clinic-10k'] = 'Clinic - 10km groep';
$apiConfig['userGroups']['avgoor'] = 'AV Goor';

$apiConfig['tagCategoryMapping']["Warming up"] = 1;
$apiConfig['tagCategoryMapping']["Core stability"] = 2;
$apiConfig['tagCategoryMapping']["Loopscholing"] = 3;
$apiConfig['tagCategoryMapping']["Kern"] = 4;
$apiConfig['tagCategoryMapping']["Cooling down"] = 5;









//print_r($apiConfig);