<?php get_header() ?>
<?php if (have_posts()) : ?>
		<h2 class="pagetitle">Search Results</h2>
	<?php while (have_posts()) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" class="post">
			<h3 class="title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
			<div class="meta clearfix">
				<span class="datepost icon"><?php the_time('l, F jS, Y') ?></span>
				<span class="commented icon"><?php comments_number('No Commented','one Commented','% Commented'); ?></span>
			</div>
			<div class="entry clearfix">
				<?php the_excerpt(); ?>
			</div>
		</div>
	<?php endwhile; ?>
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

