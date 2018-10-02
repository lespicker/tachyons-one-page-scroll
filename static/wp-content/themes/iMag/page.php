<?php get_header() ?>
	<div id="content">
		<?php if(have_posts()): the_post(); ?>
		<div class="post single" id="post-<?php the_ID(); ?>"><div class="post-top">
			<h3 class="title"><?php the_title(); ?></h3>
			<div class="meta icon">
				Posted by <?php the_author() ?> on <?php the_time('F j Y') ?> <a href="<?php the_permalink() ?>#comment"><?php comments_number('Add Comments','one Commented','% Commented'); ?></a>
			</div>
			<div class="entry">
				<?php the_content(); ?>
			</div>
		</div>
		<div class="post-bottom"></div>
		</div>
		<?php comments_template(); ?>
		<?php else: ?>
			<h2 class="center">Not Found</h2>
			<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php endif ?>

<?php get_sidebar(); get_footer(); ?>
