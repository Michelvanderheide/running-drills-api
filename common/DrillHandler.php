<?php

use Propel\Runtime\ActiveQuery\Criteria;


/*


		$this -> drills[1] = array(	
			id => 1,
			title => "Beenzwaai op plaats, met hang naar voren",
			description => "Zwaaibeweging been op de plaats. Evenwicht houden. Daarna stilhangen lichaam naar voren 1 been achter",
			tags => array( "warming up", "core stability" ),
			locations => array( "circle"),
			musclegroups=> array( "rug", "quadricepts") ) ;

		$this -> drills[2] = array(	
			id => 2,
			title => 'Lage Skipping',
			description => "Lage Kniehef, landen op voorvoet, hoge frequentie, armen meebewegen. Lopen alsof je op hete kolen loopt.",
			tags => array( "warming up" ),
			locations => array( "square"),
			musclegroups=> array( ) ) ;

		$this -> drills[3] = array(	
			id => 3,
			title => 'Tripplings op de plaats',
			description => "Tripplings op de plaats.",
			tags => array( "warming up", "loopscholing" ),
			locations => array( "circle"),
			musclegroups=> array( ) ) ;

		$this -> drills[4] = array(	
			id => 4,
			title => 'Tripplings met kniehef(vasthouden)',
			description => "Tripplings op de plaats met kniehef, kniehef paar sec. vasthouden.",
			tags => array( "warming up", "loopscholing" ),
			locations => array( "circle"),
			musclegroups=> array( ) ) ;

		$this -> trainingSessions['20160914']['description'] = "Veel kort werk vanavond. Extra aandacht voor core stability";
		$this -> trainingSessions['20160914']['date'] = "2016-09-14";
		$this -> trainingSessions['20160914']['groups'][0]["warming up"] = array (1);
		$this -> trainingSessions['20160914']['groups'][1]["circle"] = array (2, 3);		

drill
{
	id: 1,
	title: "Beenzwaai op plaats, met hang naar voren",
	description: "Zwaaibeweging been op de plaats. Evenwicht houden. Daarna stilhangen lichaam naar voren 1 been achter",
	tags: [ "warming up", "core" ],
	locations: [ "circle" ],
	media: [ 'beenzwaai-1.jpg', 'picture1.jpg'],
	musclegroups: [ "rug", "quadricepts"],
}


training
{
	id: 1,
	title: "Woensdagavond training - loopgroep",
	description: "Veel kort werk vanavond. Extra aandacht voor core stability",
	date: "2016-09-26",
	drills: [ 1, 2 ]
}

media:

/media/drill/1/xxx.jpg
/media/drill/1/xxx.media

*/

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sessionId = 'TS-2016-09-14';



use Monolog\Logger;
use Monolog\Handler\StreamHandler;


/**
 * This API classes
 */
class DrillHandler {
	var $errorMessage;
	var $token;
	var $authenticated = false;
	var $drills, $trainingSessions;

	/**
	 * Constructor
	 */
	public function __construct() {	
		global $apiConfig;
// /print_r($apiConfig);exit;

		$this -> errorMessage = "";
		$this -> logger = new Logger('DrillHandler');
		$this -> logger -> pushHandler(new StreamHandler( $apiConfig['logpath'].'/RunningDrills.log', Logger::INFO));
		$this -> logger -> addInfo("Starting DrillHandler...");

		//$this -> readCsvData();
		//$this -> readCsvSessionData();
		$this -> getSessionDrills();
	}


	/**
	 * get a list of products in a dossier
	 * @param filter: array the dossierFK
	 * @param includestore boolean with or whithou the store name (??)
	 
	 * @return array
	 */
	public function getTrainingSessions() {
		global  $apiConfig;
		$result = array();
		$this -> logger -> addInfo("getTrainingSessions:".print_r($this -> trainingSessions,true));
		return $this -> trainingSessions;
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

	public function getIntervalTimes() {
		global $intervalPauzes;
		return array('intervalPauzes' => $intervalPauzes, 'athleteTimes' => $this -> getAthleteTimes());
	}

	public function getAthleteTimes() {
		global $athleteTimes;

		$roundedTimes = array();
		foreach($athleteTimes as $name => $time) {

			$arr = explode(':', $time);
			$minutes = intval($arr[0]);
			$seconds = intval($arr[0]);
			if ($seconds < 15) {
				$seconds = 0;
			} else if ($seconds < 45) {
				$minutes++;
				$seconds = 0;
			} else {
				$seconds = 30;
			}

			$roundedTimes[$name] = sprintf("%02d:%02d", $minutes, $seconds);;
		}
		return $roundedTimes;
		
	}

	/**
	 * get a list of products in a dossier
	 * @param filter: array the dossierFK
	 * @param includestore boolean with or whithou the store name (??)
	 
	 * @return array
	 */
	public function getSessionDrills($filter=array()) {

		$query = SessionQuery::create();


		$query -> join('Session.SessionRungroup');
		$query -> join('SessionRungroup.Rungroup');
		$query -> orderBySessionPk();
		$sessions = $query -> find() -> toArray();
		//print_r($sessions);
		foreach($sessions as $session) {
			if ($session['SessionPk']>1) {
				$arrResult[] = $this -> getDrillsForSessionDrills($session['SessionPk']);
			}
		}

		$this -> trainingSessions = $arrResult;
		return $this -> trainingSessions;
	}

	public function getDrillTags() {

		$result = array();
		$query = DrillTagQuery::create();

		$query -> join('DrillTag.Tag');
		$query -> withColumn('Tag.TagName', 'TagName');

		$drillTags = $query -> find() -> toArray();	
		foreach($drillTags as $drillTag) {
			$result[$drillTag['DrillFk']][] = $drillTag['TagName'];
		}
		return $result;

	}

	public function saveDrill($drill) {

		$this -> logger -> addInfo(__FUNCTION__."drill:".print_r($drill,true));
		$result = array();
		

		$query = new DrillQuery();
		$drillObject = $query->findPK($drill['id']);
		$drillObject -> setDrillTitle($drill['title']);
		$drillObject -> setDrillDescription($drill['description']);
		$drillObject -> save();


		$query = DrillTagQuery::create();
		$query -> join('DrillTag.Tag');
		$query -> withColumn('Tag.TagName', 'TagName');
		$query -> where('DrillTag.DrillFk = ?', $drill['id']);
		$query -> find() -> delete();

		$allTags = (new TagQuery()) -> find() -> toArray();
		$this -> logger -> addInfo("all tags:".print_r($allTags,true));

		$tags = $drill['tags'];
		$this -> logger -> addInfo("new tags:".print_r($tags,true));


		foreach($tags as $tag) {
			$drillTag = new DrillTag();
			$drillTag -> setDrillFk(intval($drill['id']));
			$drillTag -> setTagFk(intval($tag['TagPk']));
			$drillTag -> save();
		}
		return $this -> getDrillByPk($drill['id']);

	}

	public function saveDrillAssets($drillId, $files) {
		global $apiConfig;

		$query = new DrillQuery();
		$drillObject = $query->findPK($drillId);


		$ext = pathinfo($files['file']['name'], PATHINFO_EXTENSION);
		if ($ext == 'png') {
			$uploadFile = $apiConfig['imagedir'] . $drillId. '-1.' . $ext;
			$drillObject -> setDrillImage($apiConfig['imageUrl'].$drillId. '-1.' . $ext);
		} else if ($ext == 'mp4') {
			$uploadFile = $apiConfig['videodir'] . $drillId. '.' . $ext;
			$drillObject -> setDrillVideo($apiConfig['videoUrl'].$drillId. '.'. $ext);
		}
		$this -> logger -> addInfo("saveDrillAssets.files(".$uploadFile."):".print_r($files,true));

		if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
		    $this -> logger -> addInfo( "File is valid, and was successfully uploaded.");
			$drillObject -> save();
		} else {
		    $this -> logger -> addInfo("Possible file upload attack!");
		}
		return "Done";
	}
	
	public function createDrill($drill) {

		$this -> logger -> addInfo("createDrill.drill:".print_r($drill,true));

		$drillObject = new Drill();
		$result = array();

		$this -> logger -> addInfo("drillObject:".print_r($drillObject,true));
		$drillObject -> setDrillTitle($drill['title']);
		$this -> logger -> addInfo("drillObject: 1");
		$drillObject -> setDrillDescription($drill['description']);
		$this -> logger -> addInfo("drillObject: 2");

		$drillObject -> setCategoryFk(8);	
		$drillObject -> save();

		$drillPk = $drillObject  -> getDrillPk();
		$this -> logger -> addInfo("drillObject: 3:".$drillPk);

		$tags = $drill['tags'];
		$this -> logger -> addInfo("new tags:".print_r($tags,true));

		foreach($tags as $tag) {
			$drillTag = new DrillTag();
			$drillTag -> setDrillFk(intval($drillPk));
			$drillTag -> setTagFk(intval($tag['TagPk']));
			$drillTag -> save();

			if ($tag['TagPk'] < 8) {
				$drillObject -> setCategoryFk($tag['TagPk']);	
							
			}
		}
		$drillObject -> setId($drillPk);
		$drillObject -> save();	

		$this -> logger -> addInfo("createDrill.drill result:".$drillPk);	

		$sessionDrill = new SessionDrill();
		$sessionDrill -> setSessionFk(1);
		$sessionDrill -> setDrillFk($drillPk);
		$sessionDrill -> setSortOrder($drillPk);
		$sessionDrill -> save();

		return $this -> getDrillByPk($drillPk);
		
	}

	public function getDrillByPk($drillPk) {
		//return (new DrillQuery()) ->findPK($drillPk) -> toArray();
		return $this -> getDrillsForSessionDrills(1, false, $drillPk);
	}

	public function deleteDrillByPk($drillPk) {
		$drill = (new DrillQuery()) ->findPK($drillPk);
		$drill -> delete();
		return true;
	}	

	public function getDrillsForSessionDrills($sessionPk, $categoryPk=false, $drillPk=false) {		
		global  $apiConfig;
		$result = array();
		//$this -> logger -> addInfo("getSessionDrills:".print_r($this -> trainingSessions,true));

		//extract($filter);
		$drillTags = $this -> getDrillTags();

		$query = DrillQuery::create();

		$query -> join('Drill.Category');
		$query -> Join('Drill.SessionDrill');
		$query -> join('SessionDrill.Session');
		$query -> join('Drill.Category');
		$query -> join('Session.SessionRungroup');
		if ($sessionPk !== false) {
			$query -> where('Session.SessionPk = ?', $sessionPk);
		}
		if ($categoryPk !== false) {
			$query -> where('Drill.CategoryFk = ?', $categoryPk);
		}
		if ($drillPk !== false) {
			$query -> where('Drill.DrillPk = ?', $drillPk);
		}


		$query -> join('SessionRungroup.Rungroup');
		$query -> withColumn('Session.SessionPk', 'SessionPk');
		$query -> withColumn('Session.SessionName', 'SessionName');
		$query -> withColumn('Session.SessionDescription', 'SessionDescription');
		$query -> withColumn('Session.SessionDescriptionHtml', 'SessionDescriptionHtml');
		$query -> withColumn('Session.SessionDate', 'SessionDate');
		$query -> withColumn('Rungroup.RungroupPk', 'RungroupPk');
		$query -> withColumn('Rungroup.RungroupName', 'RungroupName');
		$query -> withColumn('Category.CategoryPk', 'CategoryPk');
		$query -> withColumn('Category.CategoryName', 'CategoryName');
		$query -> withColumn('SessionDrill.SessionDrillPk', 'SessionDrillPk');
		$query -> withColumn('SessionDrill.SortOrder', 'SortOrder');
		$query -> withColumn('Drill.Id', 'DrillId');
		$query -> withColumn('Drill.DrillTitle', 'DrillTitle');
		$query -> withColumn('Drill.DrillDescription', 'DrillDescription');
		$query -> withColumn('Drill.DrillDescriptionHtml', 'DrillDescriptionHtml');
		$query -> withColumn('Drill.DrillDescriptionHtml', 'DrillDescriptionHtml');
		$query -> withColumn('Drill.DrillIntervals', 'DrillIntervals');
		$query -> withColumn('Drill.DrillImage', 'DrillImage');
		$query -> withColumn('Drill.DrillVideo', 'DrillVideo');

		$query -> orderBySessionPk();
		$query -> orderBySortOrder();
		$query -> distinct();

		$sessionDrills = $query -> find() -> toArray(); //-> toString();
		//print_r($sessionDrills);
		$arrResult = array();
		$idx = 0;


		$categoryName = false;
		$sessionName = false;
		$categoryIdx = -1;
		//$sessionIdx = -1;
		$groups = array();
		foreach ($sessionDrills as $i => $values) {
			//$sessionIdx = $values['SessionPk'];
			//print("\nSessionidx:".$sessionIdx);
			if ($sessionName !== $values['SessionName']) {
				$categoryIdx = -1;
				//$sessionIdx++;
				
				$sessionName = $values['SessionName'];

				$prefix = '';
				if ($values['SessionDate'] && strlen($values['SessionDate']) == 10) {
					//date_default_timezone_set ('Europe/Amsterdam');
					//setlocale(LC_TIME, 'NL_nl');
					//$prefix = $this -> toNLDate(strftime('%e %B %Y', $values['SessionDate'])). ' - ';
					$prefix = $this -> toNLDate(strftime('%A %d-%m-%Y', mktime(0,0,0,substr($values['SessionDate'],5,2),intval(substr($values['SessionDate'],8,2)),intval(substr($values['SessionDate'],0,4)))));

			//exit(substr($values['SessionDate'],8,2).",".intval(substr($values['SessionDate'],5,2)).",".intval(substr($values['SessionDate'],0,4)));
					//2017-02-22 $prefix = substr($values['SessionDate'],8,2) . '-' . substr($values['SessionDate'],5,2) . '-'. substr($values['SessionDate'],0,4) . ' - ';

				}
				$arrResult['sessionDate'] = $prefix;
				$arrResult['name'] = $values['SessionName'];
				$arrResult['description'] = $values['SessionDescription'];
				$arrResult['descriptionHtml'] = $values['SessionDescriptionHtml'];
				if (file_exists($apiConfig['imagedir'].'session-'.$values['SessionPk'].'.png')) {
					$arrResult['image'] = $apiConfig['imagedir'].'session-'.$values['SessionPk'].'.png';
				}
				if ($categoryPk !== false) {
					$arrResult['name'] = $arrResult['description'] = $arrResult['descriptionHtml'] = $values['CategoryName'];
				}
				$arrResult['drills'] = array();
				$arrResult['groups'] = array();
				$arrResult['id'] = $values['SessionPk'];
				//$arrResult['show'] = true;
				$arrResult['userGroupName'] = $values['RungroupName'];
			}
			if ($categoryName !== $values['CategoryName']) {
				$categoryIdx++;
				$categoryName = $values['CategoryName'];
			}

			$drillIdx = count($arrResult['drills']);
			$drill['title'] = $values['DrillTitle'];
			$drill['description'] = $values['DrillDescription'];
			$drill['descriptionHtml'] = $this -> toHTML($values['DrillDescription']);
			$drill['drillIdx'] = $drillIdx+1;
			$drill['group'] = $values['CategoryName'];
			$drill['id'] = $values['DrillPk'];

			$drill['imgUrl'] = '';
			$filename = strtolower($drill['id'].'.png');

			//$this -> logger -> addInfo("imageUrl-path:".$apiConfig['imageUrl'] . $filename);
			$i = 1;
			$filename = strtolower($drill['id'].'-'.$i.'.png');

			$drill['imgUrls'] = array();
			//$this -> logger -> addInfo("Check if File exists:".$apiConfig['imagedir'].$filename);
			$drill['imgUrl'] = ""; //$apiConfig['imageUrl'].'kettinglopers.png';

			//print_r($apiConfig['imagedir'].$filename);exit;
			while (file_exists($apiConfig['imagedir'].$filename)) {
				//$this -> logger -> addInfo("File exists!");
				$drill['imgUrls'][] = $drill['imgUrl'] = $apiConfig['imageUrl'].$filename;
				$i++;
				$filename = strtolower($drill['id'].'-'.$i.'.png');
			}

			$drill['videoUrl'] = '';
			$drill['hasVideo'] = false;
			$drill['hasYoutubeVideo'] = false;
			if ($values['DrillVideo']) {
				$drill['videoUrl'] = $values['DrillVideo'];
				$drill['hasVideo'] = true;
				if (stristr($drill['videoUrl'], "youtube")) {
					$drill['hasYoutubeVideo'] = true;
				}
			}

			$drill['tags'] = array();
			if (@isset($drillTags[$drill['id']])){
				$drill['tags'] = $drillTags[$drill['id']];
			}

			$arrResult['drills'][$drillIdx] = $drill;
			$arrResult['groups'][$categoryIdx]['drills'][] = $drill;
			$arrResult['groups'][$categoryIdx]['groupName'] = $categoryName;
		}
		
		return $arrResult;
	}

	private function toNLDate($dateStr, $useShort=true) {
		$lang = array();
		$lang['en'] = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday','january','februari','march','april','may','june','july','august','september','october','november','december'];
		$lang['nl'] = ['maandag','dinsdag','woensdag','donderdag','vrijdag','zaterdag','zondag','januari','februari','maart','april','mei','juni','juli','augustus','september','oktober','november','december'];

		$formattedDate = ucfirst(str_replace($lang['en'], $lang['nl'], strtolower($dateStr)));
		
		if ($useShort) {
			$langShort['en'] = ['mon','tue','wed','thu','fri','sat','sun','jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec'];
			$langShort['nl'] = ['maa','din','woe','don','vrij','zat','zon','jan','feb','maa','apr','mei','jun','jul','aug','sep','okt','nov','dec'];
			$formattedDate = ucfirst(str_replace($langShort['en'], $langShort['nl'], strtolower($formattedDate)));
		}

		return $formattedDate;
	}

	/**
	 * get a list of products in a dossier
	 * @param filter: array the dossierFK
	 * @param includestore boolean with or whithou the store name (??)
	 
	 * @return array
	 */
	public function getSessionGroups($sessionId) {
		global  $apiConfig;
		$result = array();

		return $result;
	}

	public function getRungroups() {
		$query = RungroupQuery::create();

		//$query -> orderByTagPk();
		return $query -> find() -> toArray();
	}

	/**
	 * get a list of tags
	 
	 * @return array
	 */
	public function getTags() {
		$query = TagQuery::create();

		$query -> orderByTagPk();
		return $sessions = $query -> find() -> toArray();
	}	




	private function toHTML($text) {
		$result = nl2br($text);
		return $result;
	}






}