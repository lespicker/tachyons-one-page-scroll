<?php get_header() ?>
<?php if (have_posts()) : ?>
		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
		<?php /* If this is a category archive */ if (is_category()) { ?>
		<h2 class="pagetitle">Archive for the &#8220;<?php single_cat_title(); ?>&#8221; Category</h2>
		<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h2 class="pagetitle">Posts Tagged &#8220;<?php single_tag_title(); ?>&#8221;</h2>
		<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2 class="pagetitle">Archive for <?php the_time('F jS, Y'); ?></h2>
		<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2 class="pagetitle">Archive for <?php the_time('F, Y'); ?></h2>
		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2 class="pagetitle">Archive for <?php the_time('Y'); ?></h2>
		<?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2 class="pagetitle">Author Archive</h2>
		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 class="pagetitle">Blog Archives</h2>
		<?php } ?>
	<?php while (have_posts()) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" class="post">
			<h3 class="title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
			<div class="meta clearfix">
				<span class="datepost icon"><?php the_time('l, F jS, Y') ?></span>
				<span class="commented icon"><?php comments_number('No Commented','one Commented','% Commented'); ?></span>
			</div>
			<div class="entry clearfix">
				<?php the_excerpt(); ?>
			</div>
		</div>
	<?php endwhile; ?>
	<?php if(function_exists('wp_pagenavi')) : ?>
		<?php wp_pagenavi('<div id="wp-pagenavi-wrapper">', '<div id="wp-pagenavi-left"></div><div id="wp-pagenavi-right"></div></div><!-- /wp-pagenavi-wrapper -->') ?>
	<?php else: ?>
		<div class="navigation clearfix">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>
	<?php endif ?>
<?php else: ?>
		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
<?php endif ?>

<?php get_sidebar(); get_footer() ?>

