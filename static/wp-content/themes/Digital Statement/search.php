<?php get_header(); ?>

<div id="left">

<?php if (have_posts()) : ?>
<div class="entry">

<h2>Search Results</h2>

<?php while (have_posts()) : the_post(); ?>

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
	<span class="date"><?php the_time('F jS, Y') ?></span> | <span class="comments"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?> </span> | <span class="category">Posted in <?php the_category(', ') ?></span> <!-- by <?php the_author() ?> -->
	
	</div>
	 
	</div><!-- end of post -->

<?php endwhile; ?>

</div><!-- end of entry -->

<!-- page navi -->
	<?php if(function_exists('wp_page_numbers')) { wp_page_numbers(); } ?>
<!-- page navi end -->

<?php else : ?>
<div class="entry">
<h2>Sorry, no post found. Try another search or check out the list below.</h2>

<h3>All internal blog posts:</h3>
<ul>
	<?php $archive_query = new WP_Query('showposts=1000');
		while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
	<li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a> <strong><?php comments_number('0', '1', '%'); ?></strong></li>
	<?php endwhile; ?>
</ul>

<h3>Monthly archive pages:</h3>
<ul>
	<?php wp_get_archives('type=monthly'); ?>
</ul>

<h3>Topical archive pages:</h3>
<ul>
	<?php wp_list_categories('title_li=0'); ?>
</ul>

<h3>Available RSS Feeds:</h3>
<ul>
	<li><a href="<?php bloginfo('rdf_url'); ?>" title="RDF/RSS 1.0 feed"><acronym title="Resource Description Framework">RDF</acronym>/<acronym title="Really Simple Syndication">RSS</acronym> 1.0 feed</a></li>
	<li><a href="<?php bloginfo('rss_url'); ?>" title="RSS 0.92 feed"><acronym title="Really Simple Syndication">RSS</acronym> 0.92 feed</a></li>
	<li><a href="<?php bloginfo('rss2_url'); ?>" title="RSS 2.0 feed"><acronym title="Really Simple Syndication">RSS</acronym> 2.0 feed</a></li>
	<li><a href="<?php bloginfo('atom_url'); ?>" title="Atom feed">Atom feed</a></li>
</ul>

</div><!-- end of entry -->
	<?php endif; ?>

	<div class="clear"></div>

</div><!-- end of left -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>