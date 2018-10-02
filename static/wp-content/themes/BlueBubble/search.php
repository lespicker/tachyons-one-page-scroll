<?php get_header(); ?>

<?
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>

<?php 
if (get_option('bb_logo')) {
	$logourl = get_option('bb_logo');
} else {
	$logourl = get_bloginfo('template_directory') . "/images/logo.png";
}
?>

<!-- Blog Category check from Theme Options Page -->
<?php 
if (get_option('bb_blog_cat')) {
	$blog_cat = get_option('bb_blog_cat');
} else {
	$blog_cat = "Uncategorized";
}
?>

<div id="container">


<div id="header">
		<a class="homelink" title="<?php echo bloginfo('blog_name'); ?>" href="<?php echo get_option('home'); ?>/"><img class="logotype" alt="logo" src="<?php echo $logourl; ?>" /></a>
</div>

	<div id="content">

<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h2 class="pagetitle">Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h2>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h2 class="pagetitle">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>
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

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<div class="postsingle" id="post-<?php the_ID(); ?>">
							
				<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
				
				<p class="postmetadata">by <?php the_author(); ?> on <?php the_time('l, F jS, Y') ?>  | <?php comments_popup_link('No Comments &rarr;', '1 Comment &rarr;', '% Comments &rarr;'); ?> | <?php the_tags(); ?> </p>

				
				<div class="entry">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
				</div>
				
				
			</div>
			
<?php comments_template(); ?>
			
			
			

		<?php endwhile; ?>

		

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here. Try a different search please.</p>
		

	<?php endif; ?>

	</div>



<?php get_sidebar('blog'); ?>
</div>
</body>
</html>
