<title>
<?php if ( is_home() ) { ?><? bloginfo('name'); ?> | <?php bloginfo('description'); ?>
<?php } ?>
<?php if ( is_search() ) { ?>Search Results for <?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); echo $key; _e(' &mdash; '); echo $count . ' '; _e('articles'); wp_reset_query(); ?>  
 | <? bloginfo('name'); ?><?php } ?>
<?php if ( is_404() ) { ?><? bloginfo('name'); ?> | 404 Nothing Found
<?php } ?> 
<?php if ( is_author() ) { ?><? bloginfo('name'); ?> | Author Archives
<?php } ?> 
<?php if ( is_single() ) { ?><?php wp_title(''); ?> | <?php $category = get_the_category(); echo $category[0]->cat_name; ?> | <? bloginfo('name'); ?>
<?php } ?> 
<?php if ( is_page() ) { ?><? bloginfo('name'); ?> | <?php wp_title(''); ?>
<?php } ?>
<?php if ( is_category() ) { ?><?php single_cat_title(); ?> | <?php $category = get_the_category(); echo $category[0]->category_description; ?> | <? bloginfo('name'); ?><?php } ?> 
<?php if ( is_month() ) { ?><? bloginfo('name'); ?> | Archive | <?php the_time('F'); ?>
<?php } ?>
<?php if ( is_day() ) { ?><? bloginfo('name'); ?> | Archive | <?php the_time('F j, Y'); ?>
<?php } ?> 
<?php if (function_exists('is_tag')) { if ( is_tag() ) { ?><? bloginfo('name'); ?> | Tag Archive | 
<?php  single_tag_title("", true); } } ?>
</title>