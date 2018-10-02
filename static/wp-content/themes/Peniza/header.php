<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="author" content="misbah" />
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
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/jquery.tabs.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/widgets.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/comments.css" type="text/css" media="screen" />

<?php wp_enqueue_script('jquery'); ?>

<!--[if IE 6]>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/style-ie.css" />
<![endif]-->
<?php wp_head(); ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.easing.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.tabs.pack.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($){
	$('#top-s').val('Type text to search').focus(function(){ $(this).val(''); }).blur(function(){ if($(this).val() == '') $(this).val('Type text to search'); });
	$('#searchform').parent().addClass('search-fix');
	$('#navigation a span').each(function(){
		$(this).hover(
			function(){ $(this).parent().parent().addClass('hover'); },
			function(){ $(this).parent().parent().removeClass('hover'); }
		);
	});
	$('#tab-content').tabs({ fxSlide: true });
});
</script>
</head>
<body><div id="wrap">
<div id="header" class="clearfix">
	<h1 id="site-title"><a href="<?php echo get_option('home') ?>/" title="<?php bloginfo('name') ?>" rel="home"><?php bloginfo('name') ?></a></h1>
	<?php if (is_home()): ?>
	<h2 id="site-description"><?php bloginfo('description') ?></h2>
	<?php else: ?>
	<div id="site-description"><?php bloginfo('description') ?></div>
	<?php endif ?>

	<div id="navigation" class="menu clearfix">
		<ul>
			<li class="page_item <?php if(is_home()): ?>current_page_item<?php endif ?>"><a href="<?php echo get_option('home'); ?>/"><span>Home</span></a></li>
			<?php wp_list_pages('sort_column=menu_order&depth=1&title_li=&link_before=<span>&link_after=</span>');?>
		</ul>
	</div><!-- /navigation -->

</div><!-- /header -->

<div id="container" class="clearfix">
	<div id="content">


