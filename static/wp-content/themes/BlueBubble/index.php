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

<?php 
if (get_option('bb_portfolio_cat')) {
	$portfolio_cat = get_option('bb_portfolio_cat');
} else {
	$portfolio_cat = "Uncategorized";
}
?>

<div id="container">


<div id="header">
		<a class="homelink" title="<?php echo bloginfo('blog_name'); ?>" href="<?php echo get_option('home'); ?>/"><img class="logotype" alt="logo" src="<?php echo $logourl; ?>" /></a>
</div>


	<div id="content">

	<?php if (have_posts()) : ?>
		
		<?php query_posts("category_name=$portfolio_cat");  ?>

		<?php while (have_posts()) : the_post(); ?>

			<div class="post" id="post-<?php the_ID(); ?>">
				
				<div class="box">
				
				<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
					<img src="<?php bloginfo( 'template_directory' ); ?>/scripts/timthumb.php?src=<?php echo get_post_meta( $post->ID, "post_image_value", true ); ?>&amp;w=310&amp;h=150&amp;zc=1"  alt="<?php the_title(); ?>" />
					</a>
				
				</div>
			
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				
				<div class="entry">
					<p><?php echo substr(strip_tags($post->post_content), 0, 120); ?>... <a href="<?php the_permalink(); ?>">
					Show project details</a></p>
				</div>

			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&larr; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &rarr;') ?></div>
		</div>

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		

	<?php endif; ?>

	</div>


<?php get_sidebar(); ?>
</div>
</body>
</html>
