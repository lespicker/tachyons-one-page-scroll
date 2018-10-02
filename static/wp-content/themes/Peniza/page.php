<?php get_header() ?>
<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" class="post">
			<h3 class="title"><?php the_title(); ?></h3>
			<div class="meta clearfix">
				<span class="datepost icon"><?php the_time('l, F jS, Y') ?></span>
				<span class="commented icon"><?php comments_number('No Commented','one Commented','% Commented'); ?></span>
			</div>
			<div class="entry">
				<?php the_content(''); ?>
			</div>
			<?php wp_link_pages(array('before' => '<p id="post-pages"><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		</div>
	<?php endwhile; ?>
		<?php comments_template(); ?>
<?php else: ?>
		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
<?php endif ?>
<?php get_sidebar(); get_footer() ?>
