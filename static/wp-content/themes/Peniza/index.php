<?php get_header() ?>
<?php include (ABSPATH . '/wp-content/plugins/featured-content-gallery/gallery.php'); ?>
<?php if (have_posts()) : $odd = true; ?>
		<div id="mini-post-wrap" class="clearfix">
	<?php while (have_posts()) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" class="mini-post<?php if ($odd) : echo ' odd'; else : echo ' even'; endif; ?>">
				<a class="read-more" href="<?php the_permalink() ?>#more-<?php the_ID(); ?>" title="Read more: <?php the_title(); ?>">Read More</a>
				<h3 class="title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
				<div class="entry clearfix">
					<?php the_content_rss('', TRUE, '', 55); ?>
				</div>
				<div class="meta clearfix">
					<span class="datepost icon"><?php the_time('l, F jS, Y') ?></span>
					<span class="commented icon"><?php comments_number('No Commented','one Commented','% Commented'); ?></span>
				</div>
			</div>
	<?php $odd = !$odd; endwhile; ?>
				</div><!-- /mini-post-wrap -->
	<?php if(function_exists('wp_pagenavi')) : ?>
					<?php wp_pagenavi('<div id="wp-pagenavi-wrapper">', '<div id="wp-pagenavi-left"></div><div id="wp-pagenavi-right"></div></div><!-- /wp-pagenavi-wrapper -->') ?>
	<?php else: ?>
				<div class="navigation clearfix">
					<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
					<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
				</div>
	<?php endif ?>
<?php else: ?>
				<h2 class="center">Not Found</h2>
				<p class="center">Sorry, but you are looking for something that isn't here.</p>
<?php endif ?>

<?php get_sidebar(); get_footer() ?>

