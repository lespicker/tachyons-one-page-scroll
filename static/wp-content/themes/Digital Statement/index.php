<?php get_header(); ?>

<div id="left">

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	
	<div class="entry">
	<div class="post" id="post-<?php the_ID(); ?>">
	<span class="custom_image">
	<a href="<?php the_permalink() ?>" rel="bookmark" title="Read the rest of <?php the_title_attribute(); ?>"><img src="<?php echo get_post_meta($post->ID, "Image", true);?>" /></a>
	</span>
	<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Read the rest of <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
	</h2>
	<span class="content">
	<?php the_excerpt(); ?>
	</span>
	<div class="clearfloat"></div>
	<div class="allinfos">
	<span class="alignright">
	[<a href="<?php the_permalink() ?>" rel="bookmark" title="Read the rest of <?php the_title(); ?>"> More </a>]
	</span>
	<span class="date"><?php the_time('F jS, Y') ?></span> | <span class="comments"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?> </span> | <span class="category">Posted in <?php the_category(', ') ?></span> | <?php edit_post_link('edit', '', ''); ?>

	
	</div>
	 
	</div>
	</div>
	<?php endwhile; ?>

	<div style="padding:10px;"><!-- page navi -->
	<?php if(function_exists('wp_page_numbers')) { wp_page_numbers(); } ?>
	<!-- page navi end --></div>

	<?php else : ?>

	<h2 class="center">Not Found</h2>
	<p class="center">Sorry, but you are looking for something that isn't here.</p>
	<?php include (TEMPLATEPATH . "/searchform.php"); ?>

<?php endif; ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
