<?php
/*
Template Name: archive
*/
?>

<?php get_header(); ?>
<div id="content">
<div class="entry">
<h4>Browsing Archives</h4>
<p>Feel free to browsing around my archive(s) page.</p>

<h3>By Topic</h3>

<ul><?php wp_list_categories('orderby=name&show_count=1'); ?></ul>

<div class="clear"></div>

<h3>By Date</h3>

<ul>
<?php wp_get_archives('type=monthly&limit=342'); ?>
</ul>

<div class="clear"></div>

<h3>Latest Five</h3>
<ul>
<?php query_posts('showposts=5'); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<li><a title="<?php the_content_rss('more_link_text', FALSE, 'more_file', 40); ?>" href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
<?php endwhile; endif; ?></ul>

<div class="clear"></div>
		
</div>
</div>

<?php include(TEMPLATEPATH . '/inc/sidebar.php'); ?>
<?php include(TEMPLATEPATH . '/inc/footer.php'); ?>