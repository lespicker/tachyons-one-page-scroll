<!-- Initialization of SmoothGallery-->
<script type="text/javascript">
	function startGallery() {
	var myGallery = new gallery($('myGallery'),
	{timed: true});}
	window.addEvent('domready',startGallery);
</script>
<!-- Creation of the html for the gallery -->
<div id="myGallery">
	<!--
		Get the 5 lasts posts of category which ID is 3 
		(to show the recent post use query_posts('showposts=5&cat=3');)
	-->
	<?php query_posts('showposts=5&cat=3');?>
	<?php while (have_posts()) : the_post(); ?>
	<!--get the custom fields gallery_image 
		(fields which contains the link to the image to show in the gallery) 
	-->
	<?php $values = get_post_custom_values("gallery_image");?> 
	<!-- Verify if you set the custom field gallery_image for the post -->
	<?php if(isset($values[0]))
	{?>
		<!--define a gallery element-->
		<div class="imageElement">  
			<!--post's title to show for this element-->
			<h3><?php the_title(); ?></h3>
			<!--post's excerpt to show for this element-->
			<?php the_excerpt(); ?> 
			<!--Link to the full post-->
			<a href="<?php the_permalink() ?>" title="Read more" class="open"></a> 
			<!-- Define the image for the gallery -->
			<img src="<?php echo $values[0]; ?>" class="full" alt="<?php the_title(); ?>"/> 
			<!-- Define the thumbnail for the gallery -->
			<img src="<?php echo $values[0]; ?>" class="thumbnail" alt="<?php the_title(); ?>"/> 
		</div>
	<?php }?>
	<?php endwhile; ?>
</div>