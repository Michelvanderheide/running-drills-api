<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;


/**
 * This OCR API classes
 */
class TextParser {
	var $errorMessage, $text;

	/**
	 * Constructor
	 */
	public function __construct() {	
		global $apiConfig;
		$this -> errorMessage = "";
		$this -> logger = new Logger('TextParser');
		$this -> logger -> pushHandler(new StreamHandler( $apiConfig['logpath'].'/OcrHandler.log', Logger::INFO));
		$this -> logger -> addInfo("Starting TextParser...");
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

/*

detect:
- Store
- Products
	- filter out dummy products (e.g. thuiskopie heffing is not a real product)
	- product name
	- price
- Total amount
- Due date (or default store due date?)

*/
	public function parseText($text) {
		$this -> text = $text;
		$this -> logger -> addInfo("Parse text:".$text);
		$text = preg_replace('/[^\da-z ,\.]/i', '', $text);

		$result = false;
		$price = false;
		if (preg_match_all('/[a-z0-9,\.]+/i', $text, $matches)) {
			
			// Price is first currency value after the text "Totaal" string
			$totaalStrFound = false;
			foreach($matches[0] as $i => $value) {

				$value = trim(strtolower($value));
				//print("\n".$value);
				if (!$totaalStrFound && preg_match('/^[ti\1][o0][ti\1]aa[l\1i]/', $value)) {
					$totaalStrFound = true;
					//exit("found totaal");
					continue;
				}
				if ($totaalStrFound && !$price) {
					if (preg_match('/\d+\.?\d*/', str_replace(",",".",$value), $moneyMatches)) {
						$result['price'] = $moneyMatches[0];

						// not more elements, so return;
						return $result;
					}
				}
			}
		}

		$this -> setErrorMessage("parseText", "Not all matched words found in text");
		return $result;
	}

	public function getStoreInfo() {
		$config;
	}


}
?>
