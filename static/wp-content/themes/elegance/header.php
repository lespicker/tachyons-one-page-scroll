<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/global.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/jquery.js"></script>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); ?>
</head>
<body>
<div id="wrapper">
    <div id="header">
<div id="branding">
	      <h1><a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a></h1>

<p><?php bloginfo('description'); ?></p>

</div>
		  <div class="search">
<form action="<?php bloginfo('url'); ?>" method="get">
				<input type="text" name="s" class="search-text" onfocus="searchAlert();"  />
				<div class="search-alert" onclick="searchAlertHide();">
					Enter some text and press enter!
				</div>
</form>
			</div>
</div>
<div id="subheader">
			<p id="sub-1">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nullam eu est quis enim commodo aliquet. Vestibulum eleifend venenatis massa. Curabitur rutrum accumsan felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus ut augue eu purus iaculis viverra. Maecenas vehicula dictum diam.<br/><br/><a href="#read_more" onclick="return(readMore())">Read More </a></p>
			<p id="sub-2" style="display: none">Curabitur rutrum accumsan felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus ut augue eu purus iaculis viverra. Maecenas vehicula dictum diam. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nullam eu est quis enim commodo aliquet. Vestibulum eleifend venenatis massa. <br/><br/><a href="#read_less" onclick="return(readLess())">Read Less</a></p>
		</div>

