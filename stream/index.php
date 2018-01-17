<pre>
<?php


//echo "Streaming..".__DIR__;exit;
include_once('../common/VideoStream.php');

//print_r(dirToArray(__DIR__.'/../videos'));
$imagedir = realpath(__DIR__.'/../images/');
$videodir = realpath(__DIR__.'/../videos/');

if ($_GET['create']) {
	$videos = dirToArray($videodir);
	foreach($videos as $video) {
		$image = $imagedir.'/'.basename($video, '.mp4').'-1.png';

      $pathinfo = pathinfo($video);
      if ($pathinfo['extension'] == 'mov') {

         $mp4video = $videodir.'/'.basename($video, '.mov').".mp4";
         if (!file_exists($mp4video)) {
            $cmd = "ffmpeg -i ".$videodir.'/'.$video." -vcodec -strict -c  copy ".$mp4video;
            shell_exec($cmd);
         }
      }
      
		if (!file_exists($image)) {
			$videofile = $videodir.'/'.$video;
			$cmd = "ffmpeg -i $videofile -r 1 -f image2 $image";
			echo "\nCreate image:".$cmd;
			shell_exec($cmd);
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