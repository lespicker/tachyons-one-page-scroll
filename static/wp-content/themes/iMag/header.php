<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="author" content="HPA, Denishua" />
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->
<title><?php
if (is_home()) {
	bloginfo('name');
} elseif (is_404()) {
	echo '404 Not Found'; echo ' | '; bloginfo('name');
} elseif (is_category()) {
	echo 'Category:'; wp_title(''); echo ' | '; bloginfo('name');
} elseif (is_search()) {
	echo 'Search Results'; echo ' | '; bloginfo('name');
} elseif ( is_day() || is_month() || is_year() ) {
	echo 'Archives:'; wp_title(''); echo ' | '; bloginfo('name');
} else {
	echo wp_title(''); echo ' | '; bloginfo('name');
}
global $codename,$$codename; ?>
</title>
<!--
Reader's Magazine Theme
Designed by hpa
Coded by denishua (denishua@hotmail.com)
-->
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-1.2.6-packed.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.easing.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.lavalamp.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/glide.noconflict.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.tabs.pack.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/slide.noconflict.js"></script>

<style type="text/css">
<?php if ($$codename->option['imageLogo']) : ?>
#blog-title {
	background:url('<?php echo $$codename->option['imageLogo']; ?>') no-repeat 0 0;
	text-indent:-9999px;
	height:37px;
	display:block;
}
#blog-title a {
	display:block;
	height:37px;
}
#blog-description { display:none; }
<?php endif ?>
<?php if($$codename->option['topAdv']) : ?>
#branding {
	float:left;
	width:505px;
	padding:13px 0;
	overflow:hidden;
}

#top-adv {
	float:right;
	width:468px;
	height:60px;
	margin-top:5px;
}
<?php endif ?>
</style>
<script type="text/javascript">
//jQuery Plugin: Drop Shadow Text
// call like this: $(element).textDropShadow();
(function($) {
 $.fn.textDropShadow = function(){
	 $(this).html('<span class="jq-shadow">'+$(this).html()+'</span><span>'+$(this).html()+'</span>');
	 return $(this);
 }
})(jQuery);


jQuery.noConflict();
jQuery(document).ready(function() {
	jQuery('.menu .lavaLampWithImage').lavaLamp({
		fx: "backout",
		speed: 700,
		click: function(event, menuItem) {
			return true;
		}
	});
	//nav drop shads
	//jQuery('.lavaLampWithImage a').each(function(){jQuery(this).textDropShadow();});
	jQuery('#top-search label').before('<span class="shadow">SEARCH</span>');
	jQuery('#tab-content').tabs({ fxSlide: true });

	//toggle on sidebar
	jQuery('.toggle').each(function() {
		var widgetHeader = jQuery(this).parent();
		jQuery(this).toggle(
			function() {
				jQuery(this).addClass('toggle-down');
				jQuery(this).next().addClass('hidden');
				widgetHeader.next().addClass('hidden');
				widgetHeader.addClass('min');
				widgetHeader.children('.widget-title').addClass('remove-margin');
				widgetHeader.parent().addClass('remove-bg');
			},
			function() {
				jQuery(this).removeClass('toggle-down');
				jQuery(this).next().removeClass('hidden');
				widgetHeader.next().removeClass('hidden');
				widgetHeader.removeClass('min');
				widgetHeader.children('.widget-title').removeClass('remove-margin');
				widgetHeader.parent().removeClass('remove-bg');
			}
		);
	});
	jQuery('.widget ul li,.tabs-container ul li').each(function() {
		jQuery(this).hover(
			function() {
				jQuery(this).addClass('hover');
			},
			function() {
				jQuery(this).removeClass('hover');
			}
		);
	});
});
</script>
<!--[if IE 6]>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/style-ie.css" />
<![endif]-->
<?php wp_head(); ?>
</head>
<body>
<div id="wrapper"><div id="wrapper-in">
	<div id="header">
		
		<div id="header-content">

			<div id="top-search-wrap">
				<a id="feed" href="<?php bloginfo('rss2_url'); ?>">Subscribe to RSS2</a>
				<form id="top-search" action="<?php echo get_option('home') ?>/" method="get">
					<input type="submit" id="top-search-submit" value="" class="input-submit"/>
					<input type="text" id="top-s" name="s" value="" class="input-text"/>
				</form>
			</div>

			<div id="branding">
				<span id="blog-title"><a href="<?php echo get_option('home') ?>/" title="<?php bloginfo('name') ?>" rel="home"><?php bloginfo('name') ?></a></span>
				<?php if (is_home()) : $home = ' current_page_item'; ?>
				<h1 id="blog-description"><span><?php bloginfo('description') ?></span></h1>
				<?php else: $home=''; ?>
				<div id="blog-description"><span><?php bloginfo('description') ?></span></div>
				<?php endif ?>
			</div><!-- /branding -->
			<div class="clear"></div>
		</div><!-- /header-content -->
	
		<div id="header-bottom">
			<div id="cat-menu" class="menu">
				<ul id="cat-menu-shadow">
					<?php wp_list_categories('sort_column=name&title_li=&depth=1'); ?>
				</ul>
				<ul>
					<?php wp_list_categories('sort_column=name&title_li=&depth=1'); ?>
				</ul>
			</div>
			<div class="clear"></div>
		</div><!-- /header-bottom -->

	</div><!-- /header -->

	<div id="container">

