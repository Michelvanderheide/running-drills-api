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

}