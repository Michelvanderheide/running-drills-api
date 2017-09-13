<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

const OCR_TASK_STATUS_QUEUED=1;
const OCR_TASK_STATUS_PENDING=2;
const OCR_TASK_STATUS_FINISHED=3;
const OCR_TASK_STATUS_CANCELLED=4;
const OCR_TASK_STATUS_FAILED=5;

//TASK_STATUS_PENDING, TASK_STATUS_FINISHED, TASK_STATUS_CANCELLED, TASK_STATUS_FAILED


/**
 * This OCR API classes
 */
class OcrHandler {
	var $errorMessage;
	var $ocrTask;

	/**
	 * Constructor
	 */
	public function __construct() {	
		global $apiConfig;
		$this -> errorMessage = "";
		$this -> logger = new Logger('OcrHandler');
		$this -> logger -> pushHandler(new StreamHandler( $apiConfig['logpath'].'/OcrHandler.log', Logger::INFO));
		$this -> logger -> addInfo("Starting OcrHandler...");
	}

	public function setErrorMessage($prefix=false, $message) {
		$this -> errorMessage = $message;
		if ($prefix) {
			$this -> errorMessage = $prefix . ': ' . $message;
		}

		// todo log
		$this -> logger -> addError($this -> errorMessage);
	}

	public function getErrorMessage() {
		return $this -> errorMessage;
	}

	public function handleTask($waitUntilFinished=false) {
		global $apiConfig;

		$filePath = $this -> ocrTask -> getSourceFilePath();
		echo($apiConfig['ocrsdk']['applicationId'].':'.$apiConfig['ocrsdk']['password']);

		if(!file_exists($filePath)) {
			$this -> setErrorMessage('File not found.',$filePath);
			return false;
		}
		if(!is_readable($filePath) ) {
			$this -> setErrorMessage('Access to file denied.',$filePath);
			return false;
		}


		// Recognizing with English language to rtf
		// You can use combination of languages like ?language=english,russian or
		// ?language=english,french,dutch
		// For details, see API reference for processImage method
		$url = 'http://cloud.ocrsdk.com/processImage?language=dutch&exportFormat=txt';

		// Send HTTP POST request and ret xml response
		$curlHandle = curl_init();
		curl_setopt($curlHandle, CURLOPT_URL, $url);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlHandle, CURLOPT_USERPWD, $apiConfig['ocrsdk']['applicationId'].':'.$apiConfig['ocrsdk']['password']);
		curl_setopt($curlHandle, CURLOPT_POST, 1);
		curl_setopt($curlHandle, CURLOPT_USERAGENT, "PHP Cloud OCR SDK Sample");
		curl_setopt($curlHandle, CURLOPT_FAILONERROR, true);
		
		$post_array = array();
		if((version_compare(PHP_VERSION, '5.5') >= 0)) {
			$post_array["my_file"] = new CURLFile($filePath);
		} else {
			$post_array["my_file"] = "@".$filePath;
		}
		curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $post_array); 
		$response = curl_exec($curlHandle);
		if($response == FALSE) {
			$errorText = curl_error($curlHandle);
			curl_close($curlHandle);
			$this -> setErrorMessage('handleFile failed response', $errorText);
			return false;
		}
		$httpCode = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
		curl_close($curlHandle);

		// Parse xml response
		$xml = simplexml_load_string($response);
		if($httpCode != 200) {
			if(property_exists($xml, "message")) {
				$this -> setErrorMessage('No 200 response('.$httpCode.')', $xml->message);
				return false;
			}
			$this -> setErrorMessage('unexpected response ', $response);
			return false;
		}

		$arr = $xml->task[0]->attributes();
		$taskStatus = $arr["status"];
		if($taskStatus != "Queued") {
			$this -> setErrorMessage('Unexpected task status', $taskStatus);
			return false;
		}

		// Task id
		$taskid = $arr["id"];  
		print_r($arr);

		$this -> ocrTask -> setOcrTaskStatusFk(OCR_TASK_STATUS_PENDING);
		$this -> ocrTask -> setTaskId($taskid);
		$this -> ocrTask -> save();

		print("Taskid(".$taskid."):".$this -> ocrTask -> getTaskId());

		if (!$waitUntilFinished) {
			return $taskid;
		}

		return $this -> handleTaskStatus(true);
	}

	public function handleTaskStatus($waitUntilFinished=true) {
		global $apiConfig;


		$taskId = $this -> ocrTask -> getTaskId();

		// 4. Get task information in a loop until task processing finishes
		// 5. If response contains "Completed" staus - extract url with result
		// 6. Download recognition result (text) and display it

		$url = 'http://cloud.ocrsdk.com/getTaskStatus';
		$qry_str = "?taskid=$taskId";

		print ("Url:".$url.$qry_str);

		// Check task status in a loop until it is finished

		// Note: it's recommended that your application waits
		// at least 2 seconds before making the first getTaskStatus request
		// and also between such requests for the same task.
		// Making requests more often will not improve your application performance.
		// Note: if your application queues several files and waits for them
		// it's recommended that you use listFinishedTasks instead (which is described
		// at http://ocrsdk.com/documentation/apireference/listFinishedTasks/).
		while(true) {
			echo "loop...";
			sleep(5);
			$curlHandle = curl_init();
			curl_setopt($curlHandle, CURLOPT_URL, $url.$qry_str);
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curlHandle, CURLOPT_USERPWD, $apiConfig['ocrsdk']['applicationId'].":".$apiConfig['ocrsdk']['password']);
			curl_setopt($curlHandle, CURLOPT_USERAGENT, "PHP Cloud OCR SDK Sample");
			curl_setopt($curlHandle, CURLOPT_FAILONERROR, true);
			$response = curl_exec($curlHandle);
			$httpCode = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
			curl_close($curlHandle);

			// parse xml
			$xml = simplexml_load_string($response);
			if($httpCode != 200) {
				if(property_exists($xml, "message")) {
					$this -> setErrorMessage('', $xml->message);
					return false;
				}
				$this -> setErrorMessage('Unexpected response(http code $httpCode)', $response);
				return false;
			}
			$arr = $xml->task[0]->attributes();
			$taskStatus = $arr["status"];
			if($taskStatus == "Queued" || $taskStatus == "InProgress") {

				if (!$waitUntilFinished) {
					break;
				}
			  // continue waiting
			  continue;
			}
			if($taskStatus == "Completed") {
			  // exit this loop and proceed to handling the result
				break;
			}
			if($taskStatus == "ProcessingFailed") {
				$this -> setErrorMessage('Task processing failed:'. $arr["error"]);
				return false;
			}
			$this -> setErrorMessage('Unexpected task status:'.$taskStatus);
			return false;
		}

		// read the file contents as a string
		//print_r($arr);
		$url = $arr["resultUrl"];   
		$result = file_get_contents($url);


		$this -> logger -> addInfo("Get result from url:".$url);
		$this -> logger -> addInfo("Result:".$result);
		$this -> ocrTask -> setParsedText($result);
		$this -> ocrTask -> setOcrTaskStatusFk(OCR_TASK_STATUS_FINISHED);
		$this -> ocrTask -> save();

		return $result;
	}

	// todo handle ocr queue functions

	// queue OCR Task
	public function saveOcrTask($params) {

		extract($params);

		try {
			if (isset($OcrTaskPk)) {
				$ocrTask = $this -> getOcrById($OcrTaskPk);
			} else {
				$ocrTask = new OcrTask();
			}
			if (isset($SourceFilePath)) {
				$ocrTask -> setSourceFilePath($SourceFilePath);
			}
			if (isset($TaskId)) {
				$ocrTask -> setTaskId($TaskId);
			}

			if (isset($StoreFk)) {
				$ocrTask -> setStoreFk($StoreFk);
			}

			if (isset($CreationDate)) {
				$ocrTask -> setCreationDate($CreationDate);
			}

			if (isset($OcrTaskStatus)) {
				$ocrTask -> setOcrTaskStatusFk($OcrTaskStatus);
			}
			
			$ocrTask -> save();

			return $ocrTask;
		} catch (Exception $e) {
			$this -> setErrorMessage('saveOcrTask', $e -> getMessage());
			return false;
		}

	}

	public function startOcrTask($product, $sourceFilePath, $waitUntilFinished=true) {


		$this -> ocrTask = new OcrTask();
		$this -> ocrTask -> setSourceFilePath($sourceFilePath);
		$this -> ocrTask -> setProductFk($product -> getProductPk());
		$this -> ocrTask -> save();

$this -> logger -> addInfo("Created task:");
		if (($result = $this -> handleTask($waitUntilFinished)) === false) {
$this -> logger -> addInfo("Failed handleTask:".$this -> getErrorMessage());
			$this -> ocrTask -> setOcrTaskStatusFk(OCR_TASK_STATUS_FAILED);
			$this -> ocrTask -> setStatusMessage($this -> getErrorMessage());
			$this -> ocrTask -> save();
		} else {
$this -> logger -> addInfo("Comleted handleTask:");
			if (!$waitUntilFinished) {
				return $result;
			} else {
$this -> logger -> addInfo("Start parseOcrText");
				if (!$this -> parseOcrText($product)) {
$this -> logger -> addInfo("Failed parseOcrText");
					$this -> ocrTask -> setOcrTaskStatusFk(OCR_TASK_STATUS_FAILED);
					$this -> ocrTask -> setStatusMessage($this -> getErrorMessage());
					$this -> ocrTask -> save();
				} else {
$this -> logger -> addInfo("Completed parseOcrText");
					return true;
				}
			}
		}
		return false;

	}
/*
	function checkOcrTaskStatus() {
		$ocrTaskQuery = OcrTaskQuery::create();
		$ocrTaskQuery->filterByOcrStatusFk(OCR_TASK_STATUS_PENDING);
		$ocrTasks = $ocrTaskQuery->find();
		while (!$ocrTasks -> isEmpty()) {
			$this -> ocrTask = $ocrTasks -> pop();
			if (!$this -> handleTaskStatus(false)) {
				$this -> ocrTask -> setOcrTaskStatusFk(OCR_TASK_STATUS_FAILED);
				$this -> ocrTask -> setStatusMessage($this -> getErrorMessage());
				$this -> ocrTask -> save();
			} else {
				if (!$this -> parseOcrText($product)) {
				}
			}
		}
	}
*/
	public function getOcrTaskById($id) {
		return OcrTaskQuery::create()->findOneByOcrTaskPk($id);
	}

	public function parseOcrText($product) {
		global $apiConfig;

		$storePk = $product -> getStoreFk();
		$text = $this -> ocrTask -> getParsedText();

		if (!$text) {
			$this -> setErrorMessage("parseOcrText", 'parseOcrText: Empty text');
			return false;
		}


		$textParserClass = "TextParser";
		if (isset($apiConfig['TextParserClass'][$storePk])) {
			$textParserClass = $apiConfig['TextParserClass'][$storePk];
		}

		$textParser = new $textParserClass();
		if (($parsedResult = $textParser -> parseText($text)) !== false) {

			if (isset($parsedResult['price'])) {
				$this -> logger -> addInfo("Save price:".$parsedResult['price']);

				$product -> setPrice($parsedResult['price']);
				$product -> save();
				return $product;
			} else  {
				$this -> setErrorMessage("parseOcrText", 'parseOcrText: Key fields (price) not found');
				return false;
			}
		} else {
			$this -> setErrorMessage("parseOcrText", $textParser -> getErrorMessage());

		}
		return false;
	}

}
