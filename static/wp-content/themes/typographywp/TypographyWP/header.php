<?php
$theme_options = get_option('TypographyWP');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
<?php bloginfo('name'); ?>
<?php wp_title(); ?>
</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<meta name="robots" content="all" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/style.css" />
<?php if (isset($theme_options["colorscheme"]) && $theme_options["colorscheme"] != "default") {
		$colorScheme = get_bloginfo('template_directory')."/style-".$theme_options["colorscheme"].".css";
	?>
<link rel="stylesheet" href="<?php echo $colorScheme; ?>" type="text/css" media="screen" />
<?php } ?>
<!--[if IE 7]>
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/styleie.css" />
<![endif]-->
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico" type="image/x-icon" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/js/jquery.idTabs.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/js/myjs.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/js/superfish.js"></script>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>
<?php if (isset($theme_options["backgroundscheme"]) && $theme_options["backgroundscheme"] != "default") {
		$backgroundpat = $theme_options["backgroundscheme"]; }?>
<body class="<?php echo $backgroundpat; ?>">
<div id="wrap">
<div id="menu">
  <ul class="menunav superfish">
    <?php if (is_home()) : ?>
    <li class="page_item home"><a href="<?php bloginfo('url'); ?>" class="title" title="Home">Home</a></li>
    <?php else : ?>
    <li class="page_item"><a href="<?php bloginfo('url'); ?>" class="title" title="Home">Home</a></li>
    <?php endif; ?>
    <?php wp_list_pages("title_li="); ?>
  </ul>
  <?php include(TEMPLATEPATH.'/includes/rss.php'); ?>
</div>
		<?php
		if (!isset($theme_options["logostyle"]) || $theme_options["logostyle"] == "text") {
			include (TEMPLATEPATH . '/includes/header1.php');
		}
		else if (!isset($theme_options["logostyle"]) || $theme_options["logostyle"] == "image") {
			include (TEMPLATEPATH . '/includes/header2.php');
		}
		?>
<div id="container">
