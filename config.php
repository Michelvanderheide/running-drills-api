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
	$apiConfig['baseUrl'] = "http://api.kettinglopers.nl";
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




$athleteTimes['Nico van Putten'] = '45:03';
$athleteTimes['Henk Dijkhuis'] = '48:33';
$athleteTimes['Bernd Waanders'] = '40:00';
$athleteTimes['Monique grievink'] = '56:49';
$athleteTimes['Merian Burggraaf'] = '65:00';
$athleteTimes['Remco Geerdink'] = '44:17';
$athleteTimes['Annemarie Kelder'] = '57:01';
$athleteTimes['Peter Scheeren'] = '43:29';
$athleteTimes['Theo Kosters'] = '51:57';
$athleteTimes['Gerben Heimerink'] = '41:35';
$athleteTimes['Michel van de Heide'] = '37:00';
$athleteTimes['Elisabeth Freriksen'] = '63:15';
$athleteTimes['Mieke Prins'] = '44:04';
$athleteTimes['Aschwin Kruders'] = '47:00';
$athleteTimes['Robert Schreurs'] = '38:12';
$athleteTimes['Jeroen Jansen'] = '47:13';
$athleteTimes['Saskia Kruse'] = '46:50';
$athleteTimes['Erik Wesselink'] = '51:03';
$athleteTimes['Herman ten Hove'] = '46:36';
$athleteTimes['Vincent Heering'] = '50:19';
$athleteTimes['Jan Boink'] = '51:53';
$athleteTimes['Ilse ten Doeschate'] = '59:16';
$athleteTimes['Evelyne ad Stegge'] = '58:21';
$athleteTimes['Erwin Middelhuis'] = '58:56';
$athleteTimes['Joost Meyers'] = '43:56';
$athleteTimes['Caroline Meyers'] = '58:56';
$athleteTimes['Marloes Boink'] = '58:45';
$athleteTimes['John Veltrop'] = '63:27';
$athleteTimes['Margo Versteeg'] = '61:23';
$athleteTimes['Manon Havekate'] = '61:21';
$athleteTimes['Esther Hartgerink'] = '69:54';
$athleteTimes['Annelies vd kolk'] = '51:30';
$athleteTimes['Andre Blumink'] = '40:26';
$athleteTimes['Kimberley Kranenburg'] = '46:20';
$athleteTimes['Brian Morsinkhof'] = '44:13';
$athleteTimes['Jorien Wegdam'] = '59:16';
$athleteTimes['Linda Slaat'] = '44:13';




//print_r($apiConfig);