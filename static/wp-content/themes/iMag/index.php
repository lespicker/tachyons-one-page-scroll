<?php get_header() ?>
		<div id="top-container">
			<?php include(TEMPLATEPATH.'/includes/slide.php'); ?>
			<div class="clear"></div>
			<?php include(TEMPLATEPATH.'/includes/glide.php'); ?>
			<?php include(TEMPLATEPATH.'/includes/widget-tab.php'); ?>
			<div class="clear"></div>
		</div><!-- /top-container -->

		<div id="content">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" class="post"><div class="post-top">
				<div class="meta">
					Posted by <?php the_author() ?> on <?php the_time('F-j-Y') ?> <a href="<?php the_permalink() ?>#comment"><?php comments_number('Add Comments','one Commented','% Commented'); ?></a>
				</div>
				<h3 class="title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
				<div class="entry">
					<?php the_content('') ?>
				</div>
			</div>
			<div class="post-bottom"></div>
			</div>
			<?php endwhile; ?>
			<?php if(function_exists('wp_pagenavi')) : wp_pagenavi(); ?>
			<div class="clearleft"></div>
			<?php else : ?>
			<div class="navigation">
				<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
				<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
			</div>
			<?php endif ?>
			<?php else: ?>
			<h2 class="center">Not Found</h2>
			<p class="center">Sorry, but you are looking for something that isn't here.</p>
			<?php endif ?>
<?php get_sidebar(); get_footer(); ?>
