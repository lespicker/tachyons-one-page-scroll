<?php /* Template Name: Archives */ ?>

<?php get_header(); ?>

<div id="left">

<div class="entry">
		
<h3>Listed below are all the post ever written. Whose counting?</h3>
	<ul>
		<?php $archive_query = new WP_Query('showposts=1000');
			while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
		<li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a> <strong><?php comments_number('0', '1', '%'); ?></strong></li>
		<?php endwhile; ?>
	</ul>

<h3>Monthly Archive Pages:</h3>
	<ul>
		<?php wp_get_archives('type=monthly'); ?>
	</ul>

<h3>Topical Archive Pages:</h3>
	<ul>
		<?php wp_list_categories('title_li=0'); ?>
	</ul>

</div><!-- end of entry -->

<div class="clear"></div>

</div><!-- end of left -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>

