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
							
				<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
				
				<p class="postmetadata">by <?php the_author(); ?> on <?php the_time('l, F jS, Y') ?>  | <img src="<?php echo get_bloginfo('template_directory'); ?>/images/comments.png" alt="comments"> <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?> | <?php the_tags(); ?> </p>

				
				<div class="entry">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
				</div>
				
				
			</div>
			
<?php comments_template(); ?>
			
			
			

		<?php endwhile; ?>

		

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		

	<?php endif; ?>

	</div>



<?php get_sidebar('blog'); ?>
</div>
</body>
</html>
