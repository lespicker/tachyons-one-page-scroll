<ul>
	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(2) ) : else : ?>	
    <li>
	<?php
$today = current_time('mysql', 1);
if ( $recentposts = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_status = 'publish' AND post_modified_gmt < '$today' ORDER BY post_modified_gmt DESC LIMIT 10")):
?>
<h2><?php _e("Updated"); ?></h2>
<ul>
<?php
foreach ($recentposts as $post) {
if ($post->post_title == '') $post->post_title = sprintf(__('Post #%s'), $post->ID);
echo "<li><a href='".get_permalink($post->ID)."'>";
the_title();
echo '</a></li>';
}
?>
</ul>
<?php endif; ?>
</li>
                                       
              
        <li>
        <h2><?php _e('Meta'); ?></h2>
            <ul>
            <?php wp_register(); ?>
            <li><?php wp_loginout(); ?></li>
            <?php wp_meta(); ?>
            </ul>
        </li>
		<?php endif; ?>
</ul>