<?php

class ApiHandler {

	//  http://garantieapp.local/api/assets/EB6BC0CB-6972-4F17-8F6F-EAD790E66E4B.FB6C749B-CCDA-40B0-8345-143048161B35.7.r
	public static function getAsset($request, $response, $args)   {
		global $apiConfig;
		$params = $request -> getParsedBody();
		$handler = new DrillHandler();
		//print_r($args);exit;
		$handler -> logger -> addInfo("getAsset - start:".print_r($params,true));

		if (isset($args['id'])) {
			$assetPath = $apiConfig['assetsPath'].'/'.$args['id'].'.jpg';
			if ($assetPath) {
				$type = 'image/png';
				header('Content-Type:'.$type);
				header('Content-Length: ' . filesize($assetPath));
				readfile($assetPath);
				exit;
			} 
		}

		echo "Failed";
	}

	public static function getTrainingSessions($request, $response, $args) {
		global $handler,  $apiConfig;

		$handler -> logger -> addInfo("getTrainingSessions - start");
		
		$params = $request -> getParsedBody();

		if (($trainingsSessions = $handler -> getTrainingSessions()) == false) {
			$result['data'] = array();
			$result ["status"] = false;
			$result ["message"] = $handler -> getErrorMessage();
		} else {
			$result['data'] = array_values($trainingsSessions);
			$result['status'] = true;
			$result ["message"] = '';
		}

		$handler -> logger -> addInfo("getTrainingSessions - done");
		echo json_encode($result);
	}

	public static function getSessionGroups($request, $response, $args) {
		global $handler,  $apiConfig;

		$handler -> logger -> addInfo("getSessionGroups - start");
		
		$params = $request -> getParsedBody();

		if (!isset($params['sessionId']) && ($trainingsSessions = $handler -> getSessionGroups($params['sessionId']) == false)) {
			$result['data'] = array();
			$result ["status"] = false;
			$result ["message"] = $handler -> getErrorMessage();
		} else {
			$result['data'] = $trainingsSessions;
			$result['status'] = true;
			$result ["message"] = '';
		}

		$handler -> logger -> addInfo("getSessionGroups - done");
		echo json_encode($result);
	}

	public static function getSessionDrills($request, $response, $args) {
		global $handler,  $apiConfig;

		$handler -> logger -> addInfo("getSessionDrills - start");
		
		$params = $request -> getParsedBody();
		try {
			if (($trainingsSessions = $handler -> getSessionDrills()) == false) {
				$result['data'] = array();
				$result ["status"] = false;
				$result ["message"] = $handler -> getErrorMessage();
			} else {
				$result['data'] = $trainingsSessions;
				$result['status'] = true;
				$result ["message"] = '';
			}
		} catch (Exception $e) {
			print_r($e -> getMessage());exit;
		}

		$handler -> logger -> addInfo("getSessionDrills - done");
		echo json_encode($result);
	}

	public static function getDrills($request, $response, $args) {
		global $handler,  $apiConfig;

		$handler -> logger -> addInfo("getDrills - start");
		
		$params = $request -> getParsedBody();
		try {

			if (($drills = $handler -> getDrillsForSessionDrills(1)) == false) {
				$result['data'] = array();
				$result ["status"] = false;
				$result ["message"] = $handler -> getErrorMessage();
			} else {
				$result['data'] = $drills;
				$result['status'] = true;
				$result ["message"] = '';
			}
		} catch (Exception $e) {
			print_r($e);exit;
		}

		$handler -> logger -> addInfo("getSessionDrills - done");
		echo json_encode($result);
	}	

	public static function getDrillsForCategory($request, $response, $args)   {
		global $apiConfig, $handler;
		$handler -> logger -> addInfo("getDrillsForCategory - start");
		
		$params = $request -> getParsedBody();
		$categoryPk = 0;
		if (@isset($args['id'])) {
			$categoryPk = $args['id'];
		}
		try {

			if (($drillsForSession = $handler -> getDrillsForSessionDrills(1, $categoryPk)) == false) {
				$result['data'] = array();
				$result ["status"] = false;
				$result ["message"] = $handler -> getErrorMessage();
			} else {
				$result['data'] = $drillsForSession;
				$result['status'] = true;
				$result ["message"] = '';
			}
		} catch (Exception $e) {
			print_r($e);exit;
		}

		$handler -> logger -> addInfo("getDrillsForCategory - done");
		echo json_encode($result);
	}


	public static function getTags($request, $response, $args) {
		global $handler,  $apiConfig;

		$handler -> logger -> addInfo("getTags - start");
		
		$params = $request -> getParsedBody();
		try {

			if (($tags = $handler -> getTags()) == false) {
				$result['data'] = array();
				$result ["status"] = false;
				$result ["message"] = $handler -> getErrorMessage();
			} else {
				$result['data'] = $tags;
				$result['status'] = true;
				$result ["message"] = '';
			}
		} catch (Exception $e) {
			print_r($e);exit;
		}

		$handler -> logger -> addInfo("getTags - done");
		echo json_encode($result);
	}

	public static function getRungroups($request, $response, $args) {
		global $handler,  $apiConfig;
		ApiHandler::authenticate($request);
		$handler -> logger -> addInfo("getRungroups - start");
		
		$params = $request -> getParsedBody();
		try {

			if (($tags = $handler -> getRungroups()) == false) {
				$result['data'] = array();
				$result ["status"] = false;
				$result ["message"] = $handler -> getErrorMessage();
			} else {
				$result['data'] = $tags;
				$result['status'] = true;
				$result ["message"] = '';
			}
		} catch (Exception $e) {
			print_r($e);exit;
		}

		$handler -> logger -> addInfo("getRungroups - done");
		echo json_encode($result);
	}

	public static function saveRungroups($request, $response, $args) {
		global $handler,  $apiConfig;
		ApiHandler::authenticate($request);
		$handler -> logger -> addInfo("getRungroups - start");
		
		$params = $request -> getParsedBody();
		try {

			if (($tags = $handler -> saveRungroups($params)) == false) {
				$result['data'] = array();
				$result ["status"] = false;
				$result ["message"] = $handler -> getErrorMessage();
			} else {
				$result['data'] = array();
				$result['status'] = true;
				$result ["message"] = '';
			}
		} catch (Exception $e) {
			print_r($e);exit;
		}

		$handler -> logger -> addInfo("getRungroups - done");
		echo json_encode($result);
	}	

	public static function getIntervalTimes($request, $response, $args) {
		global $handler,  $apiConfig;

		$handler -> logger -> addInfo("getIntervalTimes - start");
		
		$params = $request -> getParsedBody();
		try {

			if (($intervalTimes = $handler -> getIntervalTimes()) == false) {
				$result['data'] = array();
				$result ["status"] = false;
				$result ["message"] = $handler -> getErrorMessage();
			} else {
				$result['data'] = $intervalTimes;
				$result['status'] = true;
				$result ["message"] = '';
			}
		} catch (Exception $e) {
			print_r($e);exit;
		}

		$handler -> logger -> addInfo("getIntervalTimes - done");
		echo json_encode($result);
	}	


	public static function getAthleteTimes($request, $response, $args) {
		global $handler,  $apiConfig;

		$handler -> logger -> addInfo("getAthleteTimes - start");
		
		$params = $request -> getParsedBody();
		try {

			if (($athleteTimes = $handler -> getAthleteTimes()) == false) {
				$result['data'] = array();
				$result ["status"] = false;
				$result ["message"] = $handler -> getErrorMessage();
			} else {
				$result['data'] = $athleteTimes;
				$result['status'] = true;
				$result ["message"] = '';
			}
		} catch (Exception $e) {
			print_r($e);exit;
		}

		$handler -> logger -> addInfo("getAthleteTimes - done");
		echo json_encode($result);
	}	

	public static function saveDrill($request, $response, $args)   {
		global $apiConfig;
		$params = $request -> getParsedBody();
		$handler = new DrillHandler();
		//print_r($args);exit;
		$handler -> logger -> addInfo("saveDrill - start:".print_r($args,true));
		$handler -> logger -> addInfo("saveDrill - params:".print_r($params,true));

		if (isset($args['id'])) {
			try {
				if (($drill = $handler -> saveDrill($params)) == false) {
					$result['data'] = array();
					$result ["status"] = false;
					$result ["message"] = $handler -> getErrorMessage();
				} else {
					$result['data'] = $drill;
					$result['status'] = true;
					$result ["message"] = '';
				}
			} catch (Exception $e) {
				print_r($e);exit;
			}				
		}
		echo json_encode($result);
	}

	public static function deleteDrill($request, $response, $args)   {
		global $apiConfig;
		$params = $request -> getParsedBody();
		$handler = new DrillHandler();
		//print_r($args);exit;
		$handler -> logger -> addInfo("deleteDrill - start:".print_r($args,true));
		$handler -> logger -> addInfo("deleteDrill - params:".print_r($params,true));

		if (isset($args['id'])) {
			try {
				if ($handler -> deleteDrillByPk($args['id'])== false) {
					$result['data'] = array();
					$result ["status"] = false;
					$result ["message"] = $handler -> getErrorMessage();
				} else {
					$result['data'] = $args['id'];
					$result['status'] = true;
					$result ["message"] = '';
				}
			} catch (Exception $e) {
				print_r($e);exit;
			}				
		}
		echo json_encode($result);
	}	

	public static function saveDrillAssets($request, $response, $args)   {
		global $apiConfig;
		$params = $request -> getParsedBody();
		$handler = new DrillHandler();
		//print_r($args);exit;
		$handler -> logger -> addInfo("saveDrillAssets - start:".print_r($args,true));
		$handler -> logger -> addInfo("saveDrillAssets - params:".print_r($_FILES,true));

		if (isset($args['id'])) {
			try {
				if (($data = $handler -> saveDrillAssets($args['id'], $_FILES)) == false) {
					$result['data'] = array();
					$result ["status"] = false;
					$result ["message"] = $handler -> getErrorMessage();
				} else {
					$result['data'] = $data;
					$result['status'] = true;
					$result ["message"] = '';
				}
			} catch (Exception $e) {
				print_r($e);exit;
			}		
		}
		echo json_encode($result);
	}	

	public static function createDrill($request, $response, $args)   {
		global $apiConfig;
		$params = $request -> getParsedBody();
		$handler = new DrillHandler();
		$handler -> logger -> addInfo("createDrill - start:".print_r($args,true));
		$handler -> logger -> addInfo("createDrill - params:".print_r($params,true));

		try {
			if (($drill = $handler -> createDrill($params)) == false) {
				$result['data'] = array();
				$result ["status"] = false;
				$result ["message"] = $handler -> getErrorMessage();
			} else {
				$result['data'] = $drill;
				$result['status'] = true;
				$result ["message"] = '';
			}
		} catch (Exception $e) {
			print_r($e);exit;
		}	
		echo json_encode($result);	
	}

	public static function createAccount($request, $response, $args)   {
		global $apiConfig;
		$params = $request -> getParsedBody();
		$handler = new DrillHandler();
		$handler -> logger -> addInfo("createAccount - start:".print_r($args,true));
		$handler -> logger -> addInfo("createAccount - params:".print_r($params,true));

		try {
			if (($account = $handler -> createAccount($params)) == false) {
				$result['data'] = array();
				$result ["status"] = false;
				$result ["message"] = $handler -> getErrorMessage();
			} else {
				$result['data'] = $account;
				$result['status'] = true;
				$result ["message"] = '';
			}
		} catch (Exception $e) {
			print_r($e);exit;
		}	
		echo json_encode($result);	
	}	


	public static function getAccount($request, $response, $args)   {
		global $apiConfig;
		$params = $request -> getParsedBody();
		$handler = new DrillHandler();
		$handler -> logger -> addInfo("getAccount - start:".print_r($args,true));
		$handler -> logger -> addInfo("getAccount - params:".print_r($params,true));

		try {
			if (($account = $handler -> getAccounts($params)) == false) {
				$result['data'] = array();
				$result ["status"] = false;
				$result ["message"] = $handler -> getErrorMessage();
			} else {
				$result['data'] = $account[0];
				$result['status'] = true;
				$result ["message"] = '';
			}
		} catch (Exception $e) {
			print_r($e);exit;
		}	
		echo json_encode($result);	
	}	

	public static function saveDrillTag($request, $response, $args)   {
		global $apiConfig;
		$params = $request -> getParsedBody();
		$handler = new DrillHandler();
		$handler -> logger -> addInfo("saveDrillTag - start:".print_r($args,true));
		$handler -> logger -> addInfo("saveDrillTag - params:".print_r($params,true));

		try {
			if (($drill = $handler -> saveDrillTag($params)) == false) {
				$result['data'] = array();
				$result ["status"] = false;
				$result ["message"] = $handler -> getErrorMessage();
			} else {
				$result['data'] = $drill;
				$result['status'] = true;
				$result ["message"] = '';
			}
		} catch (Exception $e) {
			print_r($e);exit;
		}	
		echo json_encode($result);	
	}

	public static function getEvents($request, $response, $args) {
		global $handler,  $apiConfig;

		$handler -> logger -> addInfo("getEvents - start");
		
		$params = $request -> getParsedBody();
		try {

			if (($events = $handler -> getEvents()) == false) {
				$result['data'] = array();
				$result ["status"] = false;
				$result ["message"] = $handler -> getErrorMessage();
			} else {
				$result['data'] = $events;
				$result['status'] = true;
				$result ["message"] = '';
			}
		} catch (Exception $e) {
			print_r($e);exit;
		}

		$handler -> logger -> addInfo("getEvents - done");
		echo json_encode($result);
	}

	public static function getRemoteContent() {
		// Recognizing with English language to rtf
		// You can use combination of languages like ?language=english,russian or
		// ?language=english,french,dutch
		// For details, see API reference for processImage method
		$url = 'http://www.kettinglopers.nl/index.php/training/24-04-2018/';

		// Send HTTP POST request and ret xml response
		$curlHandle = curl_init();
		curl_setopt($curlHandle, CURLOPT_URL, $url);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlHandle, CURLOPT_FAILONERROR, true);
		$response = curl_exec($curlHandle);
		if ($response == FALSE) {
			$result['data'] = array();
			$result ["status"] = false;
			$result ["message"] = curl_error($curlHandle);
		} else {
			$xml = simplexml_load_string($response);
			$result['data'] = $xml;
			$result ["status"] = true;
			$result ["message"] = curl_error($curlHandle);		
		}
		$httpCode = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
		curl_close($curlHandle);

/*		// Parse xml response
		$xml = simplexml_load_string($response);
		if($httpCode != 200) {
		if(property_exists($xml, "message")) {
		die($xml->message);
		}
		die("unexpected response ".$response);
		}*/

	}

	private static function authenticate($request) {
		global $handler;

		$guid = $request->getHeader('GUID');
		if (is_array($guid) && count($guid)>0){
			$handler -> setToken($guid[0]);
		}

	}

}