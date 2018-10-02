<div id="sidebar">
	<ul class="sidebar_list">
		<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar()) : ?>
		<li class="widget">
			<h2>Recent Entries</h2>
			<ul>
				<?php query_posts('showposts=10'); ?>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
				<?php endwhile; endif; ?>
				<li><a href="<?php bloginfo('url'); ?>/archives" title="Visit the archives!">Visit the archives for more!</a></li>
			</ul>
		</li>
		
		<?php get_links_list('id'); ?>
		<?php endif; ?>
	</ul>
</div>