<?php

// content type
header ('Content-Type: application/json');

// CORS
header("Access-Control-Allow-Origin: *");
 
error_reporting(E_ALL);
ini_set('display_errors', 'On');


if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}



require_once 'vendor/autoload.php';
require_once 'config.php';
require_once 'generated-conf/config.php';
require_once 'ocr/OcrHandler.php';
require_once 'ocr/TextParser.php';
require_once 'Middleware/AuthMiddleware.php';
require_once 'common/common.php';
require_once 'common/DrillHandler.php';
require_once 'common/ApiHandler.php';
require_once 'common/GoogleClient.php';


$handler = new DrillHandler();
//exit("hier"); 
$handler-> logger -> addInfo("server:".print_r($_SERVER,true));

//print_r($_SERVER);
//exit("oke");


// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	$handler-> logger -> addInfo("options 1");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
		$handler-> logger -> addInfo("options 2");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
    }
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
		$handler-> logger -> addInfo("options 2");
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    }
}


setlocale(LC_ALL, $apiConfig['language']);

use Propel\Runtime\Propel;

use Slim\Log;

//test();



$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);
$app->add(new AuthMiddleware());
//$app -> config("debug", true);

//$app->error(function (\Exception $e) use ($app) {
//    $app->render('error.php');
//});



// Product
  
$app->get('/trainingsessions/', '\ApiHandler:getTrainingSessions');

$app->get('/sessiondrills/', '\ApiHandler:getSessionDrills');
$app->get('/sessiongroups/', '\ApiHandler:getSessionGroups');
$app->get('/assets/{id}', '\ApiHandler:getAsset');


$app->get('/drillsforcategory/{id}', '\ApiHandler:getDrillsForCategory');
$app->get('/drills/', '\ApiHandler:getDrills');
$app->get('/tags/', '\ApiHandler:getTags');
$app->get('/groups/', '\ApiHandler:getRungroups');
$app->post('/groups/', '\ApiHandler:saveRungroups');

$app->put('/drills/{id}', '\ApiHandler:saveDrill');
$app->post('/drill/', '\ApiHandler:createDrill');
$app->post('/drills/{id}', '\ApiHandler:saveDrillAssets');
$app->delete('/drills/{id}', '\ApiHandler:deleteDrill');

$app->post('/session/', '\ApiHandler:saveTrainingSession');


$app->get('/athletetimes/', '\ApiHandler:getAthleteTimes');
$app->get('/intervaltimes/', '\ApiHandler:getIntervalTimes');


$app->get('/import', '\ApiHandler:importSessionDrills');
$app->get('/events', '\ApiHandler:getEvents');

$app->get('/content', '\ApiHandler:getRemoteContent');

$app->post('/drilltag', '\ApiHandler:saveDrillTag');

$app->post('/login', '\ApiHandler:getAccount');
$app->post('/register', '\ApiHandler:createAccount');


$app -> run();

