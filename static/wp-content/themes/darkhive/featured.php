<?php $featured_category = get_theme_option('featured_category'); $featured_number = get_theme_option('featured_number'); ?>
	
<?php if(($featured_category == "Choose a category:") || ($featured_number == 'Number of post:')) { ?>
	
<?php { /* nothing */ } ?>

<?php } else { ?>

<div id="featured">
<div id="featured-title"><?php _e('Featured News'); ?></div>

<div id="Gallerybox">
<script type="text/javascript">
function startGallery() {
var myGallery = new gallery($('myGallery'), {
timed: true,
showArrows: true,
showCarousel: false,
embedLinks: true
});
document.gallery = myGallery;
}
window.onDomReady(startGallery);
</script>	
<div id="myGallery">

<?php
$category_id = get_cat_id($featured_category);
$my_query = new WP_Query('cat='. $category_id . '&' . 'showposts='. $featured_number);
while ($my_query->have_posts()) : $my_query->the_post();
$do_not_duplicate = $post->ID;
$the_post_ids = get_the_ID();
?>

<div class="imageElement post-<?php the_ID(); ?>">
<?php $values = get_post_custom_values("feat-img"); if (isset($values[0])) : ?>
<img src="<?php $values = get_post_custom_values("feat-img"); echo $values[0]; ?>" class="full" alt="<?php the_title(); ?>" />
<?php else : ?>
<img src="<?php echo get_featured_slider_image(); ?>" class="full" alt="<?php the_title(); ?>" />
<?php endif; ?>
<!-- Uncomment To Use Thumbnail Carousel
<img src="<?php echo get_featured_slider_image(); ?>" class="thumbnail" alt="<?php the_title(); ?>" />
-->
<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
<p><?php the_featured_excerpt(); ?></p>
<a href="<?php the_permalink(); ?>" title="open image" class="open"></a>
</div><!-- IMAGE ELEMENT POST <?php the_ID(); ?> END -->

<?php endwhile;?>

</div><!-- MYGALLERY END -->
</div><!-- GALLERBOX END -->
</div><!-- FEATURED END -->

<?php } ?> 