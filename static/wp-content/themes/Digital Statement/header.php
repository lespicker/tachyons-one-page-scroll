<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<!--Tabber Start-->
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/tab.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/tabber.js"></script>
<script type="text/javascript">
document.write('<style type="text/css">.tabber{display:none;}<\/style>');
</script>
<!--Tabber End-->
<!--Sliding Panel Start-->
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/mootools.svn.js"></script>
<script type="text/javascript">
window.addEvent('domready', function(){
var mySlide = new Fx.Slide('top-panel').hide();
$('toggle').addEvent('click', function(e){
e = new Event(e);
mySlide.toggle();
e.stop();
});
});
</script>
<!--Sliding Panel End-->
<!--Fancybox Start-->
<script type='text/javascript' src="<?php bloginfo('url'); ?>/wp-includes/js/jquery/jquery.js"></script>
<link href="<?php bloginfo('template_directory'); ?>/js/fancybox/fancy.css" media="screen" rel="stylesheet" type="text/css"/>
<script src="<?php bloginfo('template_directory'); ?>/js/fancybox/jquery.fancybox-1.0.0.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
$("a.zoom[href$=.jpg]").fancybox(); 
$("a.tt-flickr[href$=.jpg]").fancybox();
});
</script>
<!--Fancybox End-->
<!--SmoothGallery Starts-->
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/js/smoothgallery/css/jd.gallery.css" type="text/css" media="screen"/>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/smoothgallery/scripts/mootools.v1.11.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/smoothgallery/scripts/jd.gallery.js"></script>
<!--SmoothGallery Ends-->
<?php wp_head(); ?>
</head>
<body>

<div id="top-panel">
	<?php global $user_ID, $user_identity, $user_level ?>
	<?php if ( $user_ID ) : ?>
	<ul>
	<li>Welcome Back, <?php echo $user_identity ?></li> |
	<li><a href="<?php bloginfo('url') ?>/wp-admin/">Dashboard</a></li> |
	<?php if ( $user_level >= 1 ) : ?>
	<li><a href="<?php bloginfo('url') ?>/wp-admin/post-new.php">Write an article</a></li> |
	<?php endif // $user_level >= 1 ?>
	<li><a href="<?php bloginfo('url') ?>/wp-admin/profile.php">Profile</a></li> |
	<li><a href="<?php bloginfo('url') ?>/wp-login.php?action=logout&amp;redirect_to=<?php echo urlencode($_SERVER['REQUEST_URI']) ?>">Exit</a></li>
	</ul>
	<?php elseif ( get_option('users_can_register') ) : ?>	
	<form action="<?php bloginfo('url') ?>/wp-login.php" method="post">
	<label for="log">USER &nbsp;&nbsp;<input type="text" name="log" id="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" size="10" /></label>
	<label for="pwd">PASSWORD &nbsp;&nbsp;<input type="password" name="pwd" id="pwd" size="10" /></label>
	<input type="submit" name="submit" value="SUBMIT" class="button" /><br />
	<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>"/>
	</form>
	<?php endif // get_option('users_can_register') ?>
</div>

<div id="sub-panel">
	<a href="#" id="toggle"><img src="<?php bloginfo('template_directory'); ?>/images/slider-button.png"></a>
</div>
<div class="clearfloat"></div>
<br/>
<div id="top-wrap">
<div id="infobar"><!--Info Bar-->
	
		<div id="browse">
		<?php if (class_exists('breadcrumb_navigation_xt')) {
		echo '< Browse > ';
		// New breadcrumb object
		$mybreadcrumb = new breadcrumb_navigation_xt;
		// Options for breadcrumb_navigation_xt
		$mybreadcrumb->opt['title_blog'] = 'Home';
		$mybreadcrumb->opt['separator'] = ' / ';
		$mybreadcrumb->opt['singleblogpost_category_display'] = true;
		// Display the breadcrumb
		$mybreadcrumb->display();
		} ?>
		</div>
		
		<div id="rss">
		<p><script src="<?php bloginfo('template_url'); ?>/js/date.js" type="text/javascript"></script> |
		<span class="mobile">
		<a href="#">Mobile</a>
		</span>| 
		<a href="<?php bloginfo('rss2_url'); ?>" title="RSS">RSS</a></p>
		</div>
	
	</div><!--Close Infobar-->
</div>

<div id="wrapper">

<div id="frame"><!--Frame Content-->

<div id="header"><!--Header-->

	<div id="logo">
		<h1><a href="<?php echo get_settings('home'); ?>"><?php bloginfo('name'); ?><?php echo $langblog;?></a></h1>
	</div>

	<div id="searchbox">
		<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
		<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" class="swap_value" />
		<input type="image" src="<?php bloginfo('template_directory'); ?>/images/go.gif" id="go" alt="Search" title="Search" />
		</form>
	</div>

</div><!--Close Header-->

<div id="nav"><!--Nav Menu-->

	<ul>
	<li><a href="<?php echo get_option('home'); ?>/" class="on">Home</a></li>
	<?php wp_list_pages('depth=1&title_li='); ?>
	</ul>
	<div class="clearfloat"></div>
	<ul id="cat">
	<?php wp_list_categories('orderby=name&title_li='); ?>
	</ul>
</div><!--Close Nav Menu-->

<div id="content">