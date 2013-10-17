<?php

//include_once("connect_to_db_backend.php");
/*
$query = "SELECT * FROM social_posts WHERE channel=2;"; 
$result = mysql_query($query);
while ($row = mysql_fetch_row($result)) {
  $id = $row[0];
  echo $id." ... ";
}
*/

$names = array("danielberkal","mesh","UnitZeroOne");

for ($i=0; $i<count($names); $i++){
  $url = "http://www.twitter.com/".$names[$i];
  $data = file_get_contents($url);
  $classPos = strpos($data, "avatar size73");
  $srcStart = strpos($data, '<img src=', $classPos-250) +10;
  $srcEnd = strpos($data, '" alt', $srcStart);
  $src = substr($data, $srcStart, $srcEnd-$srcStart);
  
  if ( strpos($src,".jpg")>1 ) {
    $image=imagecreatefromjpeg($src);
    imagejpeg( $image, "twitterimages/".$names[$i].".jpg" );
    echo "<br/>saved jpg for ".$names[$i].":".$src;
  }
  else if ( strpos($src,".png")>1 ) {
    $image=imagecreatefrompng($src);
    imagejpeg( $image, "twitterimages/".$names[$i].".png" );
    echo "<br/>saved png for ".$names[$i].":".$src;
  }
  else {
    echo "<br/> ************ skipped ".$names[$i].": NOT SAVED"; 
  }
}
?>
