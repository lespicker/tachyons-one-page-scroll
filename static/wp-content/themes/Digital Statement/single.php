<?php get_header(); ?>

<div id="left">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="entry">

	<div class="post" id="post-<?php the_ID(); ?>">
	<h2><a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title_attribute
	(); ?>"><?php the_title(); ?></a>
	</h2>
	<div class="allinfos">
	<span class="date"><?php the_time('F jS, Y') ?></span> | <span class="comments"><a href="#comments"><?php comments_number('No Comments', '1 Comment', '% Comments'); ?></a> </span> | <span class="category">Posted in <?php the_category(', ') ?></span> <!-- by <?php the_author() ?> -->
	</div>
	<span class="content">
	<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
	</span>
	<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 
	'number')); ?>

	<div class="subcontrol">	
	<span class="reply"><a href="#respond">Leave a Reply</a></span>
	<span class="share"><script type="text/javascript" src="http://w.sharethis.com/widget/?tabs=web%2Cpost%2Cemail&amp;charset=utf-8&amp;services=%2Cdigg%2Cdelicious%2Cfacebook%2Cstumbleupon%2Ctechnorati%2Cmyspace%2Creddit%2Cblinklist%2Cgoogle_bmarks%2Cyahoo_bmarks%2Cwindows_live%2Cfriendfeed%2Cnewsvine%2Cslashdot&amp;style=default&amp;publisher=d402cc39-48a8-4244-bfd0-680491a67fac"></script></span>
	<?php if (function_exists('todays_overall_count')) { todays_overall_count($post->ID, '', 'views', 'so far 
	today', '1', 'show'); } ?> | <?php edit_post_link('Edit Post', '', ''); ?>
	</div>
	
	<div class="tags">
	<?php the_tags( 'Tags: ', ', ', ''); ?>
	</div>
	
	</div>
</div>

<div class="related-post">
	<?php wp_related_posts(); ?>
</div>

<div class="clear"></div>

<div class="entry">
<?php comments_template(); ?>
</div>

<?php endwhile; else: ?>

<div class="entry">
<p>Sorry, no posts matched your criteria.</p>
</div>

<?php endif; ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
