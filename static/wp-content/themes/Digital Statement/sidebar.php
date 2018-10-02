<div id="right">

<?php include ('gallery.php'); ?>

<div id="about">
	<h2>About <?php the_author_posts_link(); ?></h2>
	<div id="author-box" class="section">
	<?php
	$author_email = get_the_author_email();
	echo get_avatar($author_email, '50', 'wavatar');
	?>
	<?php the_author_description(); ?>
	<div class="clearfloat"></div>
	</div>
</div>

<div class="tabber">

	<div class="tabbertab">
	<h2>Recent Post</h2>
	<ul>
	<?php query_posts('showposts=5'); ?>
	<ul>
	<?php while (have_posts()) : the_post(); ?>
	<li>
	<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent link to'); ?> <?php the_title(); ?>"><?php the_title(); ?></a>
	</li>
	<?php endwhile;?>
	</ul>
	</div>
	
	<div class="tabbertab">
	<h2>Popular Post</h2>
	<?php if (function_exists('todays_overall_count_widget')) { todays_overall_count_widget('views', 'ul'); } ?>
	</div>
	
	<div class="tabbertab">
	<?php
	$today = current_time('mysql', 1);
	if ( $recentposts = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_status = 'publish' AND post_modified_gmt < '$today' ORDER BY post_modified_gmt DESC LIMIT 5")):
	?>
	<h2><?php _e("Updated Post"); ?></h2>
	<ul>
	<?php
	foreach ($recentposts as $post) {
	if ($post->post_title == '') $post->post_title = sprintf(__('Post #%s'), $post->ID);
	echo "<li><a href='".get_permalink($post->ID)."'>";
	the_title();
	echo '</a></li>';
	}
	?>
	</ul>
	<?php endif; ?>
	
	</div>
	
</div>

<div class="tabber">

	<div class="tabbertab">
	<h2><?php _e('Categories'); ?></h2>
	<ul>
	<?php wp_list_cats('sort_column=name&hierarchical=0'); ?>
	</ul>
	</div>
	
	<div class="tabbertab">
	<h2><?php _e('Archives'); ?></h2>
	<ul>
	<?php wp_get_archives('type=monthly'); ?>
	</ul>
	</div>
    
    <div class="tabbertab">
	<h2>Tag Cloud</h2>
	<ul>
	<?php wp_tag_cloud('smallest=8&largest=20&number=30'); ?>
	</ul>
	</div>

</div>

<div id="twitter">
<h2>Twitter</h2>
<ul id="twitter_update_list"></ul>
<br/>
</div>

</div>

<div id="sidebarbottom">
<div id="lsidebar"><?php include (TEMPLATEPATH . '/lsidebar.php'); ?>	</div>
<div id="rsidebar"><?php include (TEMPLATEPATH . '/rsidebar.php'); ?>	</div>
<div class="clear"></div>
<br/>
</div>