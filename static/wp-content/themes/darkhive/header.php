<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><?php function theme_footer_v() { if (!(function_exists("check_theme_footer") && function_exists("check_theme_header"))) { theme_usage_message(); die; }} ?>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php if (is_home()) { echo bloginfo('name'); echo (' - '); bloginfo('description');} else if (is_404()) { bloginfo('name'); echo ' - Oops, This is a 404 Page'; } else if (is_search()) { bloginfo('name'); echo (' - Search Results');} else {bloginfo('name'); echo (' - '); wp_title(''); } ?></title>
<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php bloginfo('template_directory'); ?>/css/menu.css" rel="stylesheet" type="text/css" />
<link href="<?php bloginfo('template_directory'); ?>/css/comments.css" rel="stylesheet" type="text/css" />
<?php $featured_slider_activate = get_theme_option('featured_activate'); if($featured_slider_activate == 'Yes') { ?> 
<link href="<?php bloginfo('template_directory'); ?>/css/gallery.css" rel="stylesheet" type="text/css" />
<?php } else { ?><?php { /* nothing */ } ?><?php } ?> 
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_get_archives('type=monthly&format=link'); ?>
<link rel="icon" href="<?php bloginfo('stylesheet_directory');?>/favicon.ico" type="images/x-icon" />
<?php $featured_slider_activate = get_theme_option('featured_activate'); if($featured_slider_activate == 'Yes') { ?> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/mootools.v1.11.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jd.gallery.v2.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jd.gallery.set.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jd.gallery.transitions.js"></script>
<?php } else { ?><?php { /* nothing */ } ?><?php } ?> 

<?php $g_analytics = get_theme_option('google_analytics'); echo stripcslashes($g_analytics); ?>

<?php remove_action( 'wp_head', 'wp_generator' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>

<body>

<div id="wrapper">
<div id="container">

<div id="navigation">
<div class="invertedshiftdown2">
<ul>
<li id="<?php if (is_home()) { ?>home<?php } else { ?>page_item<?php } ?>"><a href="<?php bloginfo('url'); ?>" title="Home">Home</a></li>
<?php $header_page_navigation = get_theme_option('header_page_navigation'); if($header_page_navigation == '') { ?>
<?php wp_list_pages('title_li=&depth=1&sort_column=menu_order'); ?>
<?php } else { ?>
<?php wp_list_pages('exclude='. $header_page_navigation . '&' . 'title_li=' . '&' . 'depth=' . '1' . '&' . 'sort_column=menu_order'); ?>
<?php } ?>
</ul>
<div class="clearfix"></div>
</div>
</div><!-- NAVIGATION END -->


<div id="header">

<div id="siteinfo">
<?php $header_logo_activate = get_theme_option('header_logo_activate'); if(($header_logo_activate == '') || ($header_logo_activate == 'No')) { ?>
<h1><a href="<?php echo get_option('home'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>
<h2><?php bloginfo('description'); ?></h2>
<?php } else { ?>
<div id="sitelogo">
<a href="<?php echo get_settings('home'); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo get_theme_option('logo_url'); ?>" alt="<?php bloginfo('name'); ?>" /></a>
<h1><?php bloginfo('name'); ?></h1>
<h2><?php bloginfo('description'); ?></h2>
</div><!-- SITELOGO END -->
<?php } ?>
</div><!-- SITEINFO END -->

<div id="topbanner">
<?php $header_banner = get_theme_option('header_banner'); if($header_banner == '') { ?>
<a href="http://www.shareasale.com/r.cfm?b=63825&amp;u=264147&amp;m=10805" target="_blank" rel="nofollow"><img src="http://www.shareasale.com/image/468x60-banner1.gif" alt="Dream Template" width="468" height="60" /></a>
<?php } else { ?>
<?php echo get_theme_option('header_banner'); ?>
<?php } ?>
</div><!-- TOPBANNER END -->

<div class="clearfix"></div>
</div><!-- HEADER END -->

<div id="main">

<div id="maintop"></div>

<div id="maincenter">

<?php include (TEMPLATEPATH . '/breadcrumbs.php'); ?> 