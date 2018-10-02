<div id="footer">
	<div class="footnav">
		<ul>
<li><a href="<?php echo get_option('home'); ?>">Home</a></li>
           <?php wp_list_pages('title_li=&depth=1'); ?>
<li><a href="#top" title="Jump to Page Top">Top &#8593;</a></li>
			<li><div class="clear"></div></li>
		</ul>
	</div>
	<div class="clear"></div>
	<div class="footlinks">
	
		<ul>
		<li><h3>Recently</h3></li>
<?php wp_get_archives('type=postbypost&limit=4'); ?>
		</ul>
	
<ul>
		<li><h3>Archives</h3></li>
<?php wp_get_archives('type=monthly&limit=4'); ?>
		</ul>
	
		<ul>
		<li><h3>Categories</h3></li>
<?php wp_list_categories('title_li='); ?>
		</ul>
	
		<ul>
		<li><h3>Friends</h3></li>
<?php get_links('-1', '<li>', '</li>', '<br />', FALSE, 'id', FALSE, 
FALSE, 5, FALSE); ?>	
</ul>

	</div>
	
	
</div>

<div id="sbm">
<p>&copy; <?php echo date("Y")." ";  ?> <a title="<?php bloginfo('name'); ?>" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>. Created by <a href="http://3oneseven.com/" title="milo317">miloIIIIVII</a>. <br />With <?php echo get_num_queries(); ?> queries in <?php timer_stop(1); ?> seconds. <br /><a href="http://jigsaw.w3.org/css-validator/">Valid CSS 2.1.</a> | <a href="http://validator.w3.org/">Valid XHTML 1.0</a><br />
<?php
$num_posts = wp_count_posts( 'post' );
$num_pages = wp_count_posts( 'page' );
$num_cats  = wp_count_terms('category');
$num_tags = wp_count_terms('post_tag');
$post_type_texts = array();

if ( !empty($num_posts->publish) ) { 
	$post_text = sprintf( __ngettext( '%s post', '%s posts', $num_posts->publish ), number_format_i18n( $num_posts->publish ) );
	$post_type_texts[] = $can_edit_posts ? "$post_text" : $post_text;
}
if ( $can_edit_pages && !empty($num_pages->publish) ) { 
	$post_type_texts[] = ''.sprintf( __ngettext( '%s page', '%s pages', $num_pages->publish ), number_format_i18n( $num_pages->publish ) ).'';
}
if ( $can_edit_posts && !empty($num_posts->draft) ) {
	$post_type_texts[] = '<a href="edit.php?post_status=draft">'.sprintf( __ngettext( '%s draft', '%s drafts', $num_posts->draft ), number_format_i18n( $num_posts->draft ) ).'</a>';
}
if ( $can_edit_posts && !empty($num_posts->future) ) {
	$post_type_texts[] = ''.sprintf( __ngettext( '%s scheduled post', '%s scheduled posts', $num_posts->future ), number_format_i18n( $num_posts->future ) ).'';
}

if ( current_user_can('publish_posts') && !empty($num_posts->pending) ) {
	$pending_text = sprintf( __ngettext( 'There is %2$s post pending your review.', 'There are %2$s posts pending your review.', $num_posts->pending ), 'edit.php?post_status=pending', number_format_i18n( $num_posts->pending ) );
} else {
	$pending_text = '';
}

$cats_text = sprintf( __ngettext( '%s category', '%s categories', $num_cats ), number_format_i18n( $num_cats ) );
$tags_text = sprintf( __ngettext( '%s tag', '%s tags', $num_tags ), number_format_i18n( $num_tags ) );
if ( current_user_can( 'manage_categories' ) ) {
	$cats_text = "$cats_text";
	$tags_text = "$tags_text";
}

$post_type_text = implode(', ', $post_type_texts);

$sentence = sprintf( __( '%1$s within %2$s, %3$s %4$s' ), $post_type_text, $cats_text, $tags_text, $pending_text );
$sentence = apply_filters( 'dashboard_count_sentence', $sentence, $post_type_text, $cats_text, $tags_text, $pending_text );

?>
<?php echo $sentence; ?>
<?php
$sidebars_widgets = wp_get_sidebars_widgets();
$num_widgets = array_reduce( $sidebars_widgets, create_function( '$prev, $curr', 'return $prev+count($curr);' ) );
$widgets_text = sprintf( __ngettext( '%d widget', '%d widgets', $num_widgets ), $num_widgets );
if ( $can_switch_themes = current_user_can( 'switch_themes' ) )
	$widgets_text = "$widgets_text";
?>
	<?php printf( __( ' and %2$s.' ), $ct->title, $widgets_text ); ?>

</p>

</div>

</div>
</div>
<?php wp_footer(); ?>
</body>
</html>