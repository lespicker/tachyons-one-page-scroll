<?php

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Main Sidebar',
		'before_widget' => '<li id="%1$s" class="widget"><div class="widget-top">',
		'after_widget' => '</div></div><div class="widget-bottom"></div></li>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4><span class="toggle"></span><div class="widget-content">',
	));
}

//Check for widgets in widget-ready areas http://wordpress.org/support/topic/190184?replies=7#post-808787
//Thanks to Chaos Kaizer http://blog.kaizeku.com/
function is_sidebar_active( $index = 1){
	$sidebars	= wp_get_sidebars_widgets();
	$key		= (string) 'sidebar-'.$index;
 
	return (isset($sidebars[$key]));
}

function remove_default_widgets() {
	if (function_exists('unregister_sidebar_widget')) {
		unregister_sidebar_widget('Search');
	}
}

add_action('widgets_init', 'remove_default_widgets', 0);

include(TEMPLATEPATH.'/includes/template-options.php');

include(TEMPLATEPATH.'/includes/plugins.php');

include(TEMPLATEPATH.'/includes/widgets.php');

include(TEMPLATEPATH.'/includes/comments.php');