<?php get_header(); ?>

<div id="left">

<?php if($post->post_parent)
$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0"); else
$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
if ($children) { ?>
<ul id="subnav" class="clearfloat">
<?php echo $children; ?>
</ul>
<?php } else { ?>
<?php } ?>

<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>

	<div class="entry">
	<div class="post" id="post-<?php the_ID(); ?>">
	<h2><?php the_title(); ?></h2>

	<?php the_content('More &raquo;'); ?>

	<div class="subcontrol">	
	<span class="reply"><a href="#respond">Leave a Reply</a></span>
	<span class="share"><script type="text/javascript" src="http://w.sharethis.com/widget/?tabs=web%2Cpost%2Cemail&amp;charset=utf-8&amp;services=%2Cdigg%2Cdelicious%2Cfacebook%2Cstumbleupon%2Ctechnorati%2Cmyspace%2Creddit%2Cblinklist%2Cgoogle_bmarks%2Cyahoo_bmarks%2Cwindows_live%2Cfriendfeed%2Cnewsvine%2Cslashdot&amp;style=default&amp;publisher=d402cc39-48a8-4244-bfd0-680491a67fac"></script></span>
	<?php if (function_exists('todays_overall_count')) { todays_overall_count($post->ID, '', 'views', 'so far 
	today', '1', 'show'); } ?>
	</div>

	<div class="tags">
	<?php the_tags( 'Tags: ', ', ', ''); ?>	
	</div>
	</div>
	</div>
	<div class="clear"></div>

	<div class="entry">
	<?php comments_template(); ?>
	</div>

<?php endwhile; ?>

<div class="navigation">
<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
</div>

<?php else : ?>

<h2 class="center">Not Found</h2>
<p class="center">Sorry, but you are looking for something that isn't here.</p>
<?php include (TEMPLATEPATH . "/searchform.php"); ?>

<?php endif; ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
