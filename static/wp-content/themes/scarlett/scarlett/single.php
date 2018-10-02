<?php get_header(); ?>

<div id="content">
<div class="breadcrumb">
<?php
if (class_exists('breadcrumb_navigation_xt')) {
// Display a prefix
echo 'Navigation: ';
// new breadcrumb object
$mybreadcrumb = new breadcrumb_navigation_xt;
// Display the breadcrumb
$mybreadcrumb->display();
}
?>
</div>
<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>
<div class="single" id="post-<?php the_ID(); ?>">
<div class="title">

<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
<div class="date"><span class="author">Posted by <?php the_author(); ?></span> <span class="clock"> On <?php the_time('F - j - Y'); ?></span></div>	
</div>

<div class="cover">
<div class="entry">
		<?php include (TEMPLATEPATH . '/ad1.php'); ?>
					<?php the_content('Read the rest of this entry &raquo;'); ?>
			
				 <div class="clear"></div>
			
</div>

</div>

<div class="singleinfo">
					<div class="category"><?php the_category(', '); ?> </div>
				
</div>


</div>
<div class="related">

<?php if(function_exists('wp_related_posts')) { ?>
<?php wp_related_posts(); ?>
<?php } else { ?>
<p> Activate the Wp-related-posts plugin to see the related post list! </p>
<?php } ?> 

</div>
<div class="clear"> </div>
<div class="allcomments"> 
<?php comments_template(); ?>
</div>
	<?php endwhile; else: ?>

		<h1 class="title">Not Found</h1>
		<p>I'm Sorry,  you are looking for something that is not here. Try a different search.</p>

<?php endif; ?>

</div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>