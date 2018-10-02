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

<div id="container">

<div id="header">
		<a class="homelink" title="<?php echo bloginfo('blog_name'); ?>" href="<?php echo get_option('home'); ?>/"><img class="logotype" alt="logo" src="<?php echo $logourl; ?>" /></a>
</div>

	<div id="content">

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<div class="postsingle" id="post-<?php the_ID(); ?>">
			
				<h1><?php the_title(); ?></h1>
				
				<div class="entry">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
					
					<a class="homelink" title="<?php echo bloginfo('blog_name'); ?>" href="<?php echo get_option('home'); ?>/"> &larr; Back </a>
					
				</div>

			</div>

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
