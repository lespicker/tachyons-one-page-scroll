<?php get_header(); ?>

<div id="content">
	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<div class="post">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
                                 <span class="post-info">Posted <?php the_time('F jS, Y') ?> by <?php the_author() ?></span>
				
					<?php the_content('Read the rest of this entry &raquo;'); ?>

<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

<?php edit_post_link('Edit this entry.','<p>','</p>'); ?>

<?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>

<div class="cats">Filed under:<?php the_category(', ') ?></div>
</div>

	<?php comments_template(); ?>
		<?php endwhile; else : ?>

			<div class="post">
<h2>Page Not Found</h2>

<p>Sorry, but you are looking for something that isn't here.</p>

<?php include (TEMPLATEPATH . "/searchform.php"); ?>

</div>

	<?php endif; ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>