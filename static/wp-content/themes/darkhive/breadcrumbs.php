<?php
$category = get_the_category();
$current_cat = $category[0]->cat_ID;
?>
<?php if (is_single()) { ?>
<div id="breadcrumbs">You are here&nbsp;: <a href="<?php bloginfo('home'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> &raquo; <?php the_category(', ') ?> &raquo; <?php the_title(); ?></div>
<?php } else if (is_home()) { ?>
<div id="breadcrumbs">You are here&nbsp;: <a href="<?php bloginfo('home'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></div>
<?php } else if (is_category()) { ?>
<div id="breadcrumbs">You are here&nbsp;: <a href="<?php bloginfo('home'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> &raquo; Archives for <?php single_cat_title(); ?></div>
<?php } else if (is_tag()) { ?>
<div id="breadcrumbs">You are here&nbsp;: <a href="<?php bloginfo('home'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> &raquo; Tag for <?php single_cat_title(); ?></div>
<?php } else if (is_page()) { ?>
<div id="breadcrumbs">You are here&nbsp;: <a href="<?php bloginfo('home'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> &raquo; <?php the_title(); ?></div>
<?php } else if (is_archive()) { ?>
<div id="breadcrumbs">You are here&nbsp;: <a href="<?php bloginfo('home'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> &raquo; <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
<?php /* If this is a category archive */ if (is_day()) { ?>
Archives for <?php the_time('F jS, Y'); ?>
<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
Archives for <?php the_time('F Y'); ?>
<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
Archives for <?php the_time('Y'); ?>
<?php } ?></div>
<?php } else if (is_search()) { ?>
<div id="breadcrumbs">You are here&nbsp;: <a href="<?php bloginfo('home'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> &raquo; Your Search result for &quot; <?php the_search_query(); ?> &quot;</div>
<?php } else { ?>
<?php { /* nothing */ } ?>
<?php } ?>