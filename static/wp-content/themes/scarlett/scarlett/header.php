<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->
<meta name="description" content="<?php bloginfo('description') ?>" />
<meta name="keywords" content="" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="all" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-1.2.6.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/spy.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/tabber.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/scroll.js"></script>

<script type="text/javascript" > jQuery.noConflict();</script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/banner.css" media="screen" />	
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/tabs.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/featlist.css" media="screen" />



<script type="text/javascript"><!--//--><![CDATA[//><!--
sfHover = function() {
	if (!document.getElementsByTagName) return false;
	var sfEls = document.getElementById("catmenu").getElementsByTagName("li");
	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
			this.className+=" sfhover";
		}
		sfEls[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
		}
	}
}
if (window.attachEvent) window.attachEvent("onload", sfHover);
//--><!]]></script>

<?php wp_get_archives('type=monthly&format=link'); ?>
<?php //comments_popup_script(); // off by default ?>

<?php 
if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
wp_head(); ?>
</head>

<body>

<div id="wrapper">

<div id="menu">
	<ul>
        <li class="page_item <?php if ( is_home() ) { ?>current_page_item<?php } ?>"><a href="<?php echo get_settings('home'); ?>/" title="Home">Home</a></li>
		<?php wp_list_pages('sort_column=menu_order&depth=1&title_li=');?>
	</ul>
</div>		

<div class="clear"></div>
<div id="top"> 
<?php include (TEMPLATEPATH . '/searchform.php'); ?>
<div class="blogname">
	<h1><a href="<?php bloginfo('siteurl');?>/" title="<?php bloginfo('name');?>"><?php bloginfo('name');?></a></h1>
	<h2><?php bloginfo('description'); ?></h2>
</div>

<?php include (TEMPLATEPATH . '/headbanner.php'); ?>
</div>


<div id="catmenucontainer">

	<div id="catmenu">
			<ul>
				<?php wp_list_categories('sort_column=name&title_li=&depth=4'); ?>
			</ul>
	</div>	
		
</div>
<div class="clear"></div>
<div id="casing">		