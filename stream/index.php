<?php
set_include_path('../');

require_once 'vendor/autoload.php';
require_once 'config.php';
require_once 'generated-conf/config.php';
require_once 'common/DrillHandler.php';
require_once 'common/GoogleClient.php';


//echo "Streaming..".__DIR__;exit;
include_once('../common/VideoStream.php');

//print_r(dirToArray(__DIR__.'/../videos'));
$imagedir = realpath(__DIR__.'/../images/');
$videodir = realpath(__DIR__.'/../videos/');

if ($_GET['create']) {

	$videos = dirToArray($videodir);
	foreach($videos as $video) {

      $tags = array();
      if (($tagid = getTagFromId($video)) !== false) {
         $tags[] = array('TagPk' => $tagid);
         $oldvideo = $video;
         $video = substr($video, 1);
         rename($videodir.'/'.$oldvideo, $videodir.'/'.$video);
      }

      $pathinfo = pathinfo($video);
      if ($pathinfo['extension'] == 'mov') {
         $id =  basename($video, '.mov');
         $image = $imagedir.'/'.basename($video, '.mov').'-1.png';
         createVideoFromMovie($video);
      } else {
         $id =  basename($video, '.mp4');
         $image = $imagedir.'/'.basename($video, '.mp4').'-1.png';
      }
      
		if (!file_exists($image)) {
         createImageFromVideo($image, $video);
         createDrill($id, $tags) ;
		} else {
			echo "\n image exists:".$image;
		}
	}
} else if ($_GET['id']) {
   $type = 'mp4';
	$filepath = $videodir.'/'.$_GET['id'].'.mp4';

   if (!file_exists($filepath)) {
      $filepath = $videodir.'/'.$_GET['id'].'.mov';
      $type = 'mov';
   }
   $stream = new VideoStream($filepath);
	$stream -> start($type);
   exit($filepath);
	//exit($filepath);
} else if ($_GET['importdrills']) {
   importdrills();
} else if ($_GET['exportdrills']) {
   exportdrills();
}

function getTagFromId($id) {
   $tagid = false;
   $tags = array( 'K' => 2, 'L' => 3, 'H' => 4);
   $key = strtoupper(substr($id,0,1));
   if (isset($tags[$key])) {
      $tagid = $tags[$key];
   }
   return $tagid;
}

function createVideoFromMovie($movie) {
   global $videodir;
   $mp4video = $videodir.'/'.basename($movie, '.mov').".mp4";
   $mov = $videodir.'/'.$movie;
   if (!file_exists($mp4video)) {
      $cmd = "ffmpeg -i ".$mov." -vcodec -strict -c  copy ".$mp4video;
      shell_exec($cmd);
      $image = $imagedir.'/'.basename($movie, '.mov').'-1.png';
      unlink($mov);
   }
}

function createImageFromVideo($image, $video) {
   global $videodir;

   $videofile = $videodir.'/'.$video;
   $cmd = "ffmpeg -i $videofile -r 1 -f image2 $image";
   echo "\nCreate image:".$cmd;
   shell_exec($cmd);   
}

function createDrill($id, $tags) {
   $drill = array("id" => $id, 'tags' => $tags, 'title' => 'nieuwe oefening', 'description' => 'nieuwe oefening', 'hasvideo' => true);

   $handler = new DrillHandler();
   $handler -> createDrill($drill);
}

function importdrills() {
   global $apiConfig;

   $file = $apiConfig['basedir'].'/drills.csv';
   //echo "<pre>";
   echo $file."\n";
   if (file_exists($file)) {
      $rows = file($file);
      foreach($rows as $row) {
         $cols = explode(';', $row);
         $id = $cols[0];
         $title = $cols[1];
         $description = $cols[2];
         $video = $cols[3];
         $tags = $cols[4];
         if ($id > 0 && $title && $description) {
            echo "save $id $title"."\n";
            $query = new DrillQuery();
            $drillObject = $query->findPK($id);
            $drillObject -> setDrillTitle($title);
            $drillObject -> setDrillDescription($description);
            if ($video) {
               $drillObject -> setDrillVideo($video);
            }
            $drillObject -> save();
         } else if ($id == -1  && $title && $description) {
            $drill = array('title' => $title, 'description' => $description);
            if ($tags) {
               $arrtags = explode(';', $tags);
               $tagids = array();
               foreach($arrtags as $tagid) {
                  $tagids[] = array('TagPk' => $tagid);
               }
               $drill['tags'] = $tagids;
            }
            if ($video) {
               $drill['video'] = $video;
            }
            $handler = new DrillHandler();
            $handler -> createDrill($drill);
         }
      }      
   }

   echo 'done';
}

function exportdrills() {
   $handler = new DrillHandler();

   $tags = $handler -> getTags('TagName');

   //echo "<pre>";
   $rows = array();
   $categories = array(1,2,3,4,5);
   foreach($categories as $catid => $cat) {
      $drills = $handler -> getDrillsForSessionDrills(1, $catid);
      foreach($drills['drills'] as $drill) {
         $row['title'] = $drill['title'];
         $row['description'] = $drill['description'];
         $row['descriptionHtml'] = $drill['descriptionHtml'];
         $row['videoUrl'] = $drill['videoUrl'];
         $tagids = array();
         foreach($drill['tags'] as $tagName) {
            if (isset($tags[$tagName])) {
               $tagids[] = $tags[$tagName]['TagPk'];
            }
         }
         $row['tags'] =  implode(';', $tagids);
         $rows[] = $row;
      }
   }
   //print_r($rows);
   exportcsvfile("drills.csv", $rows);
   exit;
}

function exportcsvfile($filename, $rows, $delimiter=',') {
   header('Content-Type: application/csv');
   header('Content-Disposition: attachment; filename="'.$filename.'";');

   $f = fopen('php://output', 'w');

   $fields = array_keys($rows[0]);
   fputcsv($f, $fields, $delimiter);

   foreach ($rows as $line) {
      //$line = implode(';', $line);
      fputcsv($f, $line, $delimiter);
   }
}

function dirToArray($dir) { 
   
   $result = array(); 

   $cdir = scandir($dir); 
   foreach ($cdir as $key => $value) 
   { 
      if (!in_array($value,array(".",".."))) 
      { 
         if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) 
         { 
            $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value); 
         } 
         else 
         { 
            $result[] = $value; 
         } 
      } 
   } 
   
   return $result; 
}