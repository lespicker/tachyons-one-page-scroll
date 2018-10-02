<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<div id="content">

<ul id="archives">

<li>

<h6>Archives by Month:</h6>
	<ul>
		<?php wp_get_archives('type=monthly'); ?>
	</ul>

<h6>Archives by Category:</h6>
	<ul>
		 <?php wp_list_categories(); ?>
	</ul>
	
<h6>Browse Last 50 Posts:</h6>
	<ul>
	<?php query_posts('showposts=50'); ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<li>
			<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a>
		</li>
	<?php endwhile; else: endif; ?>
	</ul>				

</li>
</ul><!-- ARCHIVES END -->

</div><!-- CONTENT END -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>