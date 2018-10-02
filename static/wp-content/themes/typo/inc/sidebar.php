<div id="sidebar">

<?php /* If this is the frontpage */ if ( is_home()  ) { ?>

<div id="featured">
<?php include (TEMPLATEPATH . '/inc/featured.php'); ?>
</div>

<?php } ?>

<div class="search">
<h4>Search</h4>
<form id="searchform" method="get" action="<?php bloginfo('home'); ?>/"><input type="text" value="Search <?php bloginfo('name'); ?>..." name="s" id="s" onfocus="if (this.value == 'Search <?php bloginfo('name'); ?>...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search anything';}" /></form>
</div>

<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>

<?php if ( is_single()  ) { ?>
<?php include (TEMPLATEPATH . '/inc/sub.php'); ?>
<?php } ?>

<?php /* If this is the frontpage */ if ( is_home()  ) { ?>

<div id="twitter">
<?php include (TEMPLATEPATH . '/twitter.php'); ?>
</div>

<?php include (TEMPLATEPATH . '/inc/sidebar-me.php'); ?>
<?php include (TEMPLATEPATH . '/inc/sidenote.php'); ?>

<?php } ?>

<div class="cat">
<h4>Categories</h4>
<ul>
<?php wp_list_cats('sort_column=name&hierarchical=0'); ?>
</ul>
</div>
<div class="clear"></div>

<div id="slide">
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/misc.js"></script>
<a href="javascript:hightlighted('switch1', 'link1');" class="hightlighted_down" id="link1" title="View recent posts" >Recently</a> <a href="javascript:hightlighted('switch2', 'link2');" class="hightlighted" id="link2" title="View the archives">Archives</a>
<a href="javascript:hightlighted('switch3', 'link3');" class="hightlighted" id="link3" title="View Tags">Tags</a>

<div style="display:block;" id="switch1">
<div id="recent">
<ul class="dates">

<?php $my_query = new WP_Query('showposts=4'); ?>
<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
<li><a title="<?php the_content_rss('more_link_text', FALSE, 'more_file', 40); ?>" href="<?php the_permalink() ?>"><?php the_title() ?>   <small>on</small> <?php the_time('M'); ?>{<span class="bigdate"><?php the_time('j'); ?></span>}</a></li>
<?php endwhile; ?>

</ul>
</div>
</div>

<div id="switch2" style="display: none;">
<div id="recent2">
<ul class="dates"><?php wp_get_archives('type=monthly&limit=8'); ?></ul>
</div>
</div>

<div id="switch3" style="display: none;">
<div id="simtag2">
<?php wp_tag_cloud('smallest=8&largest=22&number=30&orderby=count'); ?>
</div>
</div>

</div>

<?php endif; ?>

</div>