<?php
/*
Template Name: Full Width Template
*/
?>

<?php get_header(); ?>

<div id="fullcontent">

<div id="post-entry">

<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); $do_not_duplicate = $post->ID; $the_post_ids = get_the_ID(); ?>

<div class="post-meta" id="post-<?php the_ID(); ?>">

<div class="post-info">
<h1><?php the_title(); ?></h1>
</div><!-- POST INFO END -->

<div class="post-content">

<?php the_content(); ?>
<?php wp_link_pages('before=<div id="page-links">&after=</div>'); ?>

</div><!-- POST CONTENT END -->

<div class="clearfix"></div>
</div><!-- POST META <?php the_ID(); ?> END -->

<?php endwhile; ?>

<?php else : ?>

<p class="center">NOT FOUND</p>

<p class="center">Sorry, but you are looking for something that isn't here.</p>

<?php endif; ?>

</div><!-- POST ENTRY END -->

<?php include (TEMPLATEPATH . '/paginate.php'); ?>

</div><!-- CONTENT END -->

<?php get_footer(); ?>