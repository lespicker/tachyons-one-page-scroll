<?php
function mAboutUsWidget(){
	$img = get_option('m_about_img');
	$content = get_option('m_about_content');
?>
					<div id="about">
						<div id="about-in">
							<h2>About Us</h2>
							<div id="about-content">
								<img src="<?php echo $img ?>" alt="about us" />
								<p><?php echo $content ?></p>
								<div class="clearleft"></div>
							</div>
						</div>
					</div><!-- /about -->
<?php
}

function mAboutUsWidgetAdmin(){
	$img = get_option('m_about_img');
	$content = get_option('m_about_content');

	if (isset($_POST['update_about_us'])) {
		$img = strip_tags(stripslashes($_POST['m_about_img']));
		$content = strip_tags(stripslashes($_POST['m_about_content']));

		update_option("m_about_img",$img);
		update_option("m_about_content",$content);		
	}

	echo '
		<p>
			<label for="m_about_img">About Us Image:
			<input id="m_about_img" name="m_about_img" type="text" class="widefat" value="'.$img.'" /></label>
		</p>
		<p>
			<label for="m_about_content">About Us Text:
			<input id="m_about_content" name="m_about_content" type="text" class="widefat" value="'.$content.'" /></label>
		</p>
		<input type="hidden" id="update_ads" name="update_about_us" value="1" />';
}
register_sidebar_widget('About Us', 'mAboutUsWidget');
register_widget_control('About Us', 'mAboutUsWidgetAdmin', 400, 200);
?>