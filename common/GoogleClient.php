
<?php

define('APPLICATION_NAME', 'Kettinglopers');
define('CREDENTIALS_PATH', __DIR__ . '/calendar-php-quickstart.json');
define('CLIENT_SECRET_PATH', __DIR__ . '/client_secret.json');

define('SERVICE_ACCOUNT_PATH',__DIR__ . '/service-account.json');
define('API_KEY', 'AIzaSyC825Vks1pwx2DW4Iv4o3I6C1q7EoxJDVY');
putenv('GOOGLE_APPLICATION_CREDENTIALS='.__DIR__ . '/service-account.json');
// If modifying these scopes, delete your previously saved credentials
// at ~/.credentials/calendar-php-quickstart.json
define('SCOPES', implode(' ', array(
  Google_Service_Calendar::CALENDAR_READONLY)
));

//if (php_sapi_name() != 'cli') {
//  throw new Exception('This application must be run on the command line.');
//}

class GoogleClient {
	var $client;

	function __construct() {
		$this -> client = $this -> getClient();
	}

	/**
	 * Returns an authorized API client.
	 * @return Google_Client the authorized client object
	 */
	function _getClient() {
	  $client = new Google_Client();
	  $client->setApplicationName(APPLICATION_NAME);
	  $client->setScopes(SCOPES);
	  $client->setAuthConfig(CLIENT_SECRET_PATH);
	  $client->setAccessType('offline');

	  

	  // Load previously authorized credentials from a file.
	  $credentialsPath = $this -> expandHomeDirectory(CREDENTIALS_PATH);
	  if (file_exists($credentialsPath)) {
	    $accessToken = json_decode(file_get_contents($credentialsPath), true);
	  } else {
	    // Request authorization from the user.
	    $authUrl = $client->createAuthUrl();
	    printf("Open the following link in your browser:\n%s\n", $authUrl);
	    print 'Enter verification code: ';
	    $authCode = trim(fgets(STDIN));

	    // Exchange authorization code for an access token.
	    $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);

	    // Store the credentials to disk.
	    if(!file_exists(dirname($credentialsPath))) {
	      mkdir(dirname($credentialsPath), 0700, true);
	    }
	    file_put_contents($credentialsPath, json_encode($accessToken));
	    printf("Credentials saved to %s\n", $credentialsPath);
	  }
	  $client->setAccessToken($accessToken);

	  // Refresh the token if it's expired.
	  if ($client->isAccessTokenExpired()) {
	    $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
	    file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
	  }
	  //$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php');
	  return $client;
	}

	function getClient() {
	  $client = new Google_Client();
	  $client->setApplicationName(APPLICATION_NAME);
	  $client->setScopes(SCOPES);
	  $client->setAuthConfig(SERVICE_ACCOUNT_PATH);
	  //$client->setAccessType('offline');
	  //$client -> setAccessToken(API_KEY);

	  //$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php');
	  return $client;
	}

	function __getClient() {
		$client = new Google_Client();
		$client -> setAccessToken(API_KEY);

		return $client;
	}	

	/**
	 * Expands the home directory alias '~' to the full path.
	 * @param string $path the path to expand.
	 * @return string the expanded path.
	 */
	function expandHomeDirectory($path) {
	  $homeDirectory = getenv('HOME');
	  if (empty($homeDirectory)) {
	    $homeDirectory = getenv('HOMEDRIVE') . getenv('HOMEPATH');
	  }
	  return str_replace('~', realpath($homeDirectory), $path);
	}

	function test() {

		$service = new Google_Service_Calendar($this -> client);

		// Print the next 10 events on the user's calendar.
		$calendarId = 'primary';
		$optParams = array(
		  'maxResults' => 10,
		  'orderBy' => 'startTime',
		  'singleEvents' => TRUE,
		  'timeMin' => date('c'),
		);
		$results = $service->events->listEvents($calendarId, $optParams);
exit("etst");
		if (count($results->getItems()) == 0) {
		  print "No upcoming events found.\n";
		} else {
		  print "Upcoming events:\n";
		  foreach ($results->getItems() as $event) {
		    $start = $event->start->dateTime;
		    if (empty($start)) {
		      $start = $event->start->date;
		    }
		    printf("%s (%s)\n", $event->getSummary(), $start);
		  }
		}
	}
}
