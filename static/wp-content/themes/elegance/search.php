<?php get_header(); ?>



<div id="content">
	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<div class="post">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
                                 <span class="post-info">Posted <?php the_time('F jS, Y') ?> by <?php the_author() ?></span>
				
					<?php the_excerpt(); ?>

<?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>

<div class="cats">Filed under:<?php the_category(', ') ?></div>
</div>


		<?php endwhile; ?>

<div class="navigation">
	<div class="previous"><?php next_posts_link('&larr; Previous Entries') ?></div>
	<div class="next"><?php previous_posts_link('Next Entries &rarr;') ?></div>
</div>

<?php else : ?>

<div class="post">
<h2>No Results</h2>

<p>No posts found. Try a different search?</p>

<?php include (TEMPLATEPATH . "/searchform.php"); ?>

</div>

	<?php endif; ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>