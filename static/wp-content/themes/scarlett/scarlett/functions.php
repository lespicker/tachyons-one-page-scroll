<?php
require_once(TEMPLATEPATH . '/controlpanel.php'); 
if ( function_exists('register_sidebars') )
    register_sidebars(2);
	 
		register_sidebar(array('name'=>'Sidebar 3',
		'before_widget' => '',
		'after_widget' => '</li></ul></div>',
		'before_title' => '<div class="sidebar3"><h2>',
		'after_title' => '</h2><ul><li>',
	)); 
	 
?>