<?php
function mSubscribeRSS(){
	$img = get_option('m_about_img');
	$content = get_option('m_about_content');
?>
	<li id="subscribe-rss" class="widget">
		<a href="<?php bloginfo('rss2_url'); ?>" title="Subscribe RSS"><img src="<?php bloginfo('template_directory'); ?>/images/widget-rss.jpg" alt="Subscribe RSS" /></a>
	</li>
<?php
}

register_sidebar_widget('Subscribe RSS', 'mSubscribeRSS');
?>