<?php get_header(); ?>


	<div id="content">



	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<div class="post">
				<h2><?php the_title(); ?></h2><br/>

					<?php the_content(); ?>

<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

<?php edit_post_link('Edit this entry.','<p>','</p>'); ?>

</div>

		<?php endwhile; ?>
	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
