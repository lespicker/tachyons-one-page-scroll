<?
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>

<!-- Blog Category check from Theme Options Page -->
<?php 
if (get_option('bb_blog_cat')) {
	$blog_cat = get_option('bb_blog_cat');
} else {
	$blog_cat = "Uncategorized";
}
?>

<?php $post = $wp_query->post;
if ( in_category($blog_cat) ) {
  include(TEMPLATEPATH . '/single_blog.php');
} else {
  include(TEMPLATEPATH . '/single_portfolio.php');
}
?>