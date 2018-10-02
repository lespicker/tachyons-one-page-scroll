<div class="clear"></div>

		
<div class="tabber">

<div class="tabbertab">
<h2>VIDEO</h2>
		     	<?php $vid = get_option('scar_video'); echo stripslashes($vid); ?>
  
</div>
<div class="tabbertab">

<h2> TAG CLOUD </h2>
     		 
	
<?php if(function_exists('wp_cumulus_insert')) { ?>
<?php  wp_cumulus_insert(); ?>
<?php } else { ?>
<p> Activate the Wp-cumulus plugin to see the flash tag clouds! </p>
<?php } ?> 


   </div>

   <div class="tabbertab">

<h2> RECENT </h2>
<ul>
<?php
$myposts = get_posts('numberposts=10&offset=0');
foreach($myposts as $post) :
?>
<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
<?php endforeach; ?>
</ul>

</div>




</div>
	

		