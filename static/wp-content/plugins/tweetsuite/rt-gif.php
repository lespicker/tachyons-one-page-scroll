<?php
if(function_exists('imagefttext')) {
	if($_GET['count']) { $count =$_GET['count']; }
	else { $count = 'tweet'; }
	$adjust = 5-strlen($count);
	$im = imagecreatefrompng('tb.png');
	$white = imagecolorallocate($im, 0xFF, 0xFF, 0xFF);
	$blue = imagecolorallocate($im, 44, 170, 226);
	$size=13;
	$tx = 5.8;
	$ty = 75;
	if($adjust) {$ty=72.5; $tx = 6+($adjust*4);}
	imagefttext($im, $size, 0, $tx+2, $ty+2, $blue, './lbi.ttf', $count);
	imagefttext($im, $size, 0, $tx, $ty, $white, './lbi.ttf', $count);
}
else {
	$im = imagecreatefrompng('tb_tweet.png');
}
header('Content-Type: image/png');
imagesavealpha($im, true);
imagepng($im, './rt-'.$count.'.png');
imagepng($im);
?>