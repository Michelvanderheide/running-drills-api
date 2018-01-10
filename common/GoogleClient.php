<?php

define('APPLICATION_NAME', 'Kettinglopers');
define('CREDENTIALS_PATH', __DIR__ . '/google-client-credentials.json');
define('CLIENT_SECRET_PATH', __DIR__ . '/client_secret.json');

define('SERVICE_ACCOUNT_PATH',__DIR__ . '/service-account.json');
define('API_KEY', 'AIzaSyC825Vks1pwx2DW4Iv4o3I6C1q7EoxJDVY');
putenv('GOOGLE_APPLICATION_CREDENTIALS='.__DIR__ . '/service-account.json');
define('CALENDAR_ID','02jrau6tj30j6uf2iftqs6v9s8@group.calendar.google.com'); //Kettinglopers
// If modifying these scopes, delete your previously saved credentials
// at ~/.credentials/calendar-php-quickstart.json
define('SCOPES', implode(' ', array(
  Google_Service_Calendar::CALENDAR_READONLY)
));

//if (php_sapi_name() != 'cli') {
//  throw new Exception('This application must be run on the command line.');
//}

class GoogleClient {
	var $client, $calendarService;

	function __construct() {
		$this -> client = $this -> getClient();
		$this -> calendarService = new Google_Service_Calendar($this -> client);
	}

	/**
	 * Returns an authorized API client.
	 * @return Google_Client the authorized client object
	 */
	function getClient() {
	  $client = new Google_Client();
	  $client->setApplicationName(APPLICATION_NAME);
	  $client->setScopes(SCOPES);
	  $client->setAuthConfig(CLIENT_SECRET_PATH);
	  $client->setAccessType('offline');
	  $accessToken = json_decode(file_get_contents(CREDENTIALS_PATH), true);
	  $client->setAccessToken($accessToken);
	  return $client;
	}

	function getUpcomingEvents() {
		$optParams = array(
		  'maxResults' => 10,
		  'orderBy' => 'startTime',
		  'singleEvents' => TRUE,
		  'timeMin' => date('c'),
		);

		$results = $this -> calendarService -> events->listEvents(CALENDAR_ID, $optParams);

		return $results->getItems();
	}


	function test() {

		//$service = new Google_Service_Calendar($this -> client);

		// Print the next 10 events on the user's calendar.
		$calendarId = CALENDAR_ID;
		$optParams = array(
		  'maxResults' => 10,
		  'orderBy' => 'startTime',
		  'singleEvents' => TRUE,
		  'timeMin' => date('c'),
		);

		$results = $this -> calendarService -> events->listEvents($calendarId, $optParams);
		if (count($results->getItems()) == 0) {
		  print "No upcoming events found.\n";
		} else {
		  print "Upcoming events:\n";
		  foreach ($results->getItems() as $event) {
		    $start = $event->start->dateTime;
		    if (empty($start)) {
		      $start = $event->start->date;
		    }
		    print_r($event -> start -> dateTime);
		    printf("%s (%s)\n", $event->getSummary(), $start);
		  }
		}
		exit;
	}
}
