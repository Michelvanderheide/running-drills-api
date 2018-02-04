<pre>
<?php

require_once 'vendor/autoload.php';
require_once 'config.php';
require_once 'generated-conf/config.php';
require_once 'common/DrillHandler.php';


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
         $tags = array('TagPk' => $tagid);
         $oldvideo = $video;
         $video = substr($video, 1);
         print($videodir.'/'.$oldvideo ."  ::  ". $videodir.'/'.$video);exit;
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
      
      var_dump($image);
      var_dump($video);
		if (!file_exists($image)) {
         createImageFromVideo($video);
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
}

function getTagFromId($id) {
   $tagid = false;
   $tags = array( 'K' => 2, 'L' => 3, 'H' => 4);
   $key = strtoupper(subsctr($id,0,1));
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

function createImageFromVideo($video) {
   global $videodir;
   $handler = new DrillHandler();
   $videofile = $videodir.'/'.$video;
   $cmd = "ffmpeg -i $videofile -r 1 -f image2 $image";
   echo "\nCreate image:".$cmd;
   shell_exec($cmd);   
}

function createDrill($id, $tags) {
   $drill = array("drillPk" => $id, 'tags' => $tags, 'title' => 'nieuwe oefening', 'description' => 'nieuwe oefening');

   $handler = new DrillHandler();
   $handler -> createDrill($drill);
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