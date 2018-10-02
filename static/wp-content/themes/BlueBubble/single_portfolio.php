<?php get_header(); ?>

<?
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>

<?php 
if (get_option('bb_logo')) {
	$logourl = get_option('bb_logo');
} else {
	$logourl = get_bloginfo('template_directory') . "/images/logo.png";
}
?>

<!-- Blog Category check from Theme Options Page -->
<?php 
if (get_option('bb_blog_cat')) {
	$blog_cat = get_option('bb_blog_cat');
} else {
	$blog_cat = "Uncategorized";
}
?>

<div id="container">


<div id="header">
		<a class="homelink" title="<?php echo bloginfo('blog_name'); ?>" href="<?php echo get_option('home'); ?>/"><img class="logotype" alt="logo" src="<?php echo $logourl; ?>" /></a>
</div>

	<div id="content">

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<div class="postsingle" id="post-<?php the_ID(); ?>">
				
				<div class="boxsingle">
							
						
					<img src="<?php bloginfo( 'template_directory' ); ?>/scripts/timthumb.php?src=<?php echo get_post_meta( $post->ID, "post_image_value", true ); ?>&amp;w=657&amp;h=318&amp;zc=1" class="portfolio" style="display:none;" alt="<?php the_title(); ?>" />
					
				
				</div>
			
				<h2><?php the_title(); ?></h2>
				
				<div class="entry">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
					
					<a class="homelink" title="<?php echo bloginfo('blog_name'); ?>" href="<?php echo get_option('home'); ?>/"> &larr; Back </a>
					
				</div>

			</div>
			
<?php 
if (get_option('bb_comments')) {
	 echo "";
} else {
	 echo comments_template();
}
?>
			
			
			

		<?php endwhile; ?>

		

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		

	<?php endif; ?>

	</div>



<?php get_sidebar(); ?>
</div>
</body>
</html>
