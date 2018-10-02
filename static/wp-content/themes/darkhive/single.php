<?php get_header(); ?>

<div id="content">

<div id="post-entry">

<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); $do_not_duplicate = $post->ID; $the_post_ids = get_the_ID(); ?>

<div class="post-meta" id="post-<?php the_ID(); ?>">

<div class="post-info">
<h1><?php the_title(); ?></h1>
<span class="post-date">
Posted On <?php the_time('d M Y') ?> By <?php the_author_posts_link(); ?>. Under: <?php the_category(', ') ?>.&nbsp;<?php if(function_exists("the_tags")) : ?><?php the_tags('<b>Tags:</b>&nbsp;') ?>.<?php endif; ?>&nbsp;&nbsp;<?php edit_post_link('Edit Post'); ?>
</span><!-- POST DATE END -->
</div><!-- POST INFO END -->

<?php $get_google_activate = get_theme_option('adsense_single_activate'); if(($get_google_activate == '') || ($get_google_activate == 'Disable')) { ?>
<?php } else { ?>
<?php $get_google_code = get_theme_option('adsense_single'); if($get_google_code == '') { ?>
<?php } else { ?>
<div class="adsense-single">
<?php echo stripcslashes($get_google_code); ?>
</div>
<?php } ?>
<?php } ?>

<div class="post-content">

<?php the_content(); ?>
<?php wp_link_pages('before=<div id="page-links">&after=</div>'); ?>

</div><!-- POST CONTENT END -->

<?php $get_google_activate = get_theme_option('adsense_single_activate'); if(($get_google_activate == '') || ($get_google_activate == 'Disable')) { ?>
<?php } else { ?>
<?php $get_google_code = get_theme_option('adsense_single'); if($get_google_code == '') { ?>
<?php } else { ?>
<div class="adsense-single">
<?php echo stripcslashes($get_google_code); ?>
</div>
<?php } ?>
<?php } ?>

<div class="clearfix"></div>
</div><!-- POST META <?php the_ID(); ?> END -->

<?php endwhile; ?>

<?php
$mywp_version = get_bloginfo('version');
if ($mywp_version >= '2.7') {
comments_template('', true);
} else {
comments_template();
}
?>

<?php else : ?>

<p class="center">NOT FOUND</p>

<p class="center">Sorry, but you are looking for something that isn't here.</p>

<?php endif; ?>

</div><!-- POST ENTRY END -->

<?php include (TEMPLATEPATH . '/paginate.php'); ?>

</div><!-- CONTENT END -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>