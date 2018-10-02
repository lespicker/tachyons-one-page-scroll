<?php
require_once(TEMPLATEPATH . '/inc/control.php'); 
require_once(TEMPLATEPATH . '/inc/controlpanel.php'); 
require_once(TEMPLATEPATH . '/inc/image.php'); 
if ( function_exists('register_sidebars') )
    register_sidebars(1, array(
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
   	unregister_sidebar_widget ( "search" );
function initial_cap($content){
    // Regular Expression, matches a single letter
    // * even if it's inside a link tag.
    $searchfor = '/>(<a [^>]+>)?([^<\s])/';
    // The string we're replacing the letter for
    $replacewith = '>$1<span class="drop">$2</span>';
    // Replace it, but just once (for the very first letter of the post)
    $content = preg_replace($searchfor, $replacewith, $content, 1);
    // Return the result
    return $content;
}
// Add this function to the WordPress hook
add_filter('the_content', 'initial_cap');
add_filter('the_excerpt', 'initial_cap');
?>