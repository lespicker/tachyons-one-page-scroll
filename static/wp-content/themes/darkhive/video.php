<li class="widget_video">
<div>
<?php $emvideo = get_theme_option('emvideo');  if($emvideo == '') { ?>
<object data="http://www.youtube.com/v/Hr0Wv5DJhuk" type="application/x-shockwave-flash" width="278" height="240"><param name="movie" value="http://www.youtube.com/v/Hr0Wv5DJhuk" /><param name="wmode" value="transparent" /></object>
<?php } else { ?>
<object data="http://www.youtube.com/v/<?php echo stripcslashes($emvideo); ?>" type="application/x-shockwave-flash" width="278" height="240"><param name="movie" value="http://www.youtube.com/v/<?php echo stripcslashes($emvideo); ?>" /><param name="wmode" value="transparent" /></object> 
<?php } ?>
</div>
</li>