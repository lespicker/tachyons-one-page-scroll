<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<?php include(TEMPLATEPATH."/inc/title.php");?>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="shortcut icon" type="image/ico" href="<?php bloginfo('template_url'); ?>/favicon.ico" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/prototype.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/scriptaculous.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/behaviour.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/rules.js"></script>
<script type="text/javascript">
   		// <![CDATA[
     	// Behaviour Rules
   		Behaviour.register(myrules);
   		// ]]>
 </script>
<?php wp_head(); ?>

</head>
<body>
<div id="wrap"><a name="top"></a>
<div id="container">
<div id="logo">
<h1><a title="Get back to the frontpage" href="<?php echo get_settings('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
<div class="des"><?php bloginfo('description'); ?></div>
</div>  
<div id="header">
<?php include (TEMPLATEPATH . '/inc/nav.php'); ?>
</div>