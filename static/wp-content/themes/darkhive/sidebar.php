<div id="sidebar">
<div id="sidebarinner">

<ul class="sidebar_list">

<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar(1)) : ?>

<li id="searchbox">
<form method="get" action="<?php bloginfo('home'); ?>" id="searchform">
<input name="s" type="text" class="sbm-b" value="Search Here..." onfocus="if (this.value == 'Search Here...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search Here...';}" />
</form>
</li><!-- SEARCHBOX END -->

<?php $sponsor_activate = get_theme_option('sponsor_activate'); if(($sponsor_activate == '') || ($sponsor_activate == 'No')) { ?>
<?php { /* nothing */ } ?>
<?php } else { ?>
<?php include (TEMPLATEPATH . '/sponsor.php'); ?>
<?php } ?>

<?php $emvideo_activate = get_theme_option('emvideo_activate'); if(($emvideo_activate == '') || ($emvideo_activate == 'No')) { ?>
<?php { /* nothing */ } ?>
<?php } else { ?>
<?php include (TEMPLATEPATH . '/video.php'); ?>
<?php } ?>

<?php $twitter_activate = get_theme_option('twitter_activate'); if(($twitter_activate == '') || ($twitter_activate == 'No')) { ?>
<?php { /* nothing */ } ?>
<?php } else { ?>
<?php include (TEMPLATEPATH . '/twitter.php'); ?> 
<?php } ?>


<li class="widget_calendar">
<h6><?php _e('Calendar'); ?></h6>
<?php get_calendar(); ?>
</li>


<li class="widget_categories">
<h6><?php _e('Categories'); ?></h6>
<ul>
<?php wp_list_categories('orderby=id&show_count=1&use_desc_for_title=0&title_li='); ?>
</ul>
</li>


<li class="widget_pages">
<h6><?php _e('Pages'); ?></h6>
<ul>
<?php wp_list_pages('title_li=&depth=0&sort_column=menu_order'); ?>
</ul>
</li>


<li class="widget_archive">
<h6><?php _e('Archives'); ?></h6>
<ul>
<?php wp_get_archives('type=monthly&limit=&show_post_count=1'); ?>
</ul>	
</li>


<li class="widget_recentcomments_gravatar">
<h6><?php _e('Recent Comments'); ?></h6>
	<ul>
		<?php get_avatar_recent_comment(); ?>
	</ul>
</li>


<li class="widget_hottopics">
<h6><?php _e('Hot Topics'); ?></h6>
	<ul>
		<?php get_hottopics(); ?>
	</ul>
</li>


<li class="widget_tag_cloud">
<h6><?php _e('Popular Tags'); ?></h6>
<div>
<?php if(function_exists("wp_tag_cloud")) { ?>
<?php wp_tag_cloud('smallest=8&largest=20&'); ?>
<?php } ?>
</div>
</li>


<li class="widget_links">
<h6><?php _e('Blogroll'); ?></h6>
	<ul>
		<?php get_links(-1, '<li>', '</li>', ' - '); ?>
	</ul>
</li>


<li class="widget_meta">
<h6><?php _e('Meta'); ?></h6>
<ul>
<?php wp_register(); ?>
<li><?php wp_loginout(); ?></li>
<li><a href="http://www.wordpress.org/" rel="nofollow">WordPress</a></li>
<?php wp_meta(); ?>
<li><a href="http://validator.w3.org/check?uri=referer" rel="nofollow">XHTML</a></li>
<li><a href="http://jigsaw.w3.org/css-validator/validator?uri=<?php echo get_settings('home'); ?>&amp;usermedium=all" rel="nofollow">CSS</a></li>
</ul>
</li>

<?php endif; ?>

</ul><!-- SIDEBAR LIST END -->

</div><!-- SIDEBARINNER END -->
</div><!-- SIDEBAR END -->