<?php
/**
 * Coded by misbah (ini_misbah@yahoo.com)
 */

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Peniza - Main Sidebar',
		'before_widget' => '<li id="%1$s" class="widget">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	register_sidebars(2,array(
		'name' => 'Peniza - Small Sidebar %d',
		'before_widget' => '<li id="%1$s" class="widget">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
}

include(TEMPLATEPATH.'/includes/plugins.php');

//Check for widgets in widget-ready areas http://wordpress.org/support/topic/190184?replies=7#post-808787
//Thanks to Chaos Kaizer http://blog.kaizeku.com/
function is_sidebar_active( $index = 1){
	$sidebars	= wp_get_sidebars_widgets();
	$key		= (string) 'sidebar-'.$index;
 
	return (isset($sidebars[$key]));
}

?>