 <div class="clear"></div>
 

 <div id="footbar">

 
 <div class="barone">
				<h2 class="am">About Me</h2>

	       
<?php 
	$img = get_option('scar_img'); 
	$about = get_option('scar_about'); 
	?>		
<img src="<?php echo ($img); ?>"  alt="" />	
<p class="text">
<?php echo ($about); ?> 
</p>


		
		</div>

 
 <div class="barone">
					<h2 class="tu">Twitter</h2>
<div id="twitter_div">

<ul id="twitter_update_list"></ul>
</div>
<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php $twit = get_option('scar_twit'); echo ($twit); ?>.json?callback=twitterCallback2&amp;count=5"></script>
		
		</div>

  		
 
		<div class="barone" >

		<h2 class="flick">Photos</h2>

	
<?php if(function_exists('get_flickrRSS')) { ?>
<?php get_flickrRSS(); ?>
<?php } else { ?>
<p> Activate the Flickrss plugin to see the image thumbnails! </p>
<?php } ?> 
		</div>
