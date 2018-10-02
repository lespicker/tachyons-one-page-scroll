<?php if ((!function_exists("check_theme_footer") || !function_exists("check_theme_header"))) { ?><?php { /* nothing */ } ?><?php } else { ?>

<?php get_header(); ?>

<div id="content">

<?php $featured_slider_activate = get_theme_option('featured_activate'); if(($featured_slider_activate == '') || ($featured_slider_activate == 'No')) { ?>
<?php { /* nothing */ } ?>
<?php } else { ?>
<?php if((is_home())&& ($paged < 1)) { ?>
<?php include (TEMPLATEPATH . '/featured.php'); ?> 
<?php } ?>
<?php } ?>

<div id="post-entry">

<?php $postcounter = 1; if (have_posts()) : ?>

<?php while (have_posts()) : $postcounter = $postcounter + 1; the_post(); $do_not_duplicate = $post->ID; $the_post_ids = get_the_ID(); ?>

<div class="post-meta" id="post-<?php the_ID(); ?>">

<div class="post-info">
<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
<span class="post-date">
Posted On <?php the_time('d M Y') ?> By <?php the_author_posts_link(); ?>. Under: <?php the_category(', ') ?>.
</span><!-- POST DATE END -->
</div><!-- POST INFO END -->

<div class="post-content">

<?php $values = get_post_custom_values("post-img"); if (isset($values[0])) : ?>

<?php $timthumb_activate = get_theme_option('timthumb_activate'); if($timthumb_activate == 'Yes') { ?>

<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo bloginfo('template_url'); ?>/scripts/timthumb.php?src=<?php $values = get_post_custom_values("post-img"); echo $values[0]; ?>&amp;w=<?php $thumbwidth = get_theme_option('thumb_width');  if($thumbwidth == '') { ?>250<?php } else { ?><?php echo stripcslashes($thumbwidth); ?><?php } ?>&amp;h=<?php $thumbheight = get_theme_option('thumb_height');  if($thumbheight == '') { ?>200<?php } else { ?><?php echo stripcslashes($thumbheight); ?><?php } ?>&amp;zc=1&amp;q=100&amp;cropfrom=<?php $thumbcrop = get_theme_option('timthumb_cropping');  if($thumbcrop == '') { ?>topcenter<?php } else { ?><?php echo stripcslashes($thumbcrop); ?><?php } ?>" alt="<?php the_title(); ?>" class="alignleft" /></a>

<?php } else { ?>

<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php $values = get_post_custom_values("post-img"); echo $values[0]; ?>" alt="<?php the_title(); ?>" width="<?php $thumbwidth = get_theme_option('thumb_width');  if($thumbwidth == '') { ?>250<?php } else { ?><?php echo stripcslashes($thumbwidth); ?><?php } ?>" height="<?php $thumbheight = get_theme_option('thumb_height');  if($thumbheight == '') { ?>200<?php } else { ?><?php echo stripcslashes($thumbheight); ?><?php } ?>" class="alignleft" /></a>

<?php } ?>

<?php else: ?>

<?php $timthumb_activate = get_theme_option('timthumb_activate'); if($timthumb_activate == 'Yes') { ?>

<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo bloginfo('template_url'); ?>/scripts/timthumb.php?src=<?php echo get_post_image(); ?>&amp;w=<?php $thumbwidth = get_theme_option('thumb_width');  if($thumbwidth == '') { ?>250<?php } else { ?><?php echo stripcslashes($thumbwidth); ?><?php } ?>&amp;h=<?php $thumbheight = get_theme_option('thumb_height');  if($thumbheight == '') { ?>200<?php } else { ?><?php echo stripcslashes($thumbheight); ?><?php } ?>&amp;zc=1&amp;q=100&amp;cropfrom=<?php $thumbcrop = get_theme_option('timthumb_cropping');  if($thumbcrop == '') { ?>topcenter<?php } else { ?><?php echo stripcslashes($thumbcrop); ?><?php } ?>" alt="<?php the_title(); ?>" class="alignleft" /></a>

<?php } else { ?>

<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo get_post_image(); ?>" alt="<?php the_title(); ?>" width="<?php $thumbwidth = get_theme_option('thumb_width');  if($thumbwidth == '') { ?>250<?php } else { ?><?php echo stripcslashes($thumbwidth); ?><?php } ?>" height="<?php $thumbheight = get_theme_option('thumb_height');  if($thumbheight == '') { ?>200<?php } else { ?><?php echo stripcslashes($thumbheight); ?><?php } ?>" class="alignleft" /></a>

<?php } ?>

<?php endif; ?>

<?php the_post_excerpt(); ?>

</div><!-- POST CONTENT END -->

<div class="clearfix"></div>
</div><!-- POST META <?php the_ID(); ?> END -->

<?php $get_google_activate = get_theme_option('adsense_loop_activate'); if(($get_google_activate == '') || ($get_google_activate == 'Disable')) { ?>
<?php } else { ?>
<?php $get_google_code = get_theme_option('adsense_loop'); if($get_google_code == '') { ?>
<?php } else { ?>
<?php if($postcounter <= 4){ ?>
<div class="adsense-loop">
<?php echo stripcslashes($get_google_code); ?>
</div>
<?php } ?>
<?php } ?>
<?php } ?>

<?php endwhile; ?>

<?php else : ?>

<p class="center">NOT FOUND</p>

<p class="center">Sorry, but you are looking for something that isn't here.</p>

<?php endif; ?>

</div><!-- POST ENTRY END -->

<?php include (TEMPLATEPATH . '/paginate.php'); ?>

</div><!-- CONTENT END -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>

<?php } ?>