<?php if ($theme_options["custom_rss"] == 1 && isset($theme_options["custom_rss_url"]) && $theme_options["custom_rss_url"] != "") {
					$customRSS = $theme_options["custom_rss_url"];
				}
				else {
					$customRSS = get_bloginfo('rss_url');
				}
  ?>

<ul class="rss">
  <li><a href="<?php bloginfo('comments_rss2_url'); ?>">comments feed</a></li>
  <li><a href="<?php echo $customRSS; ?>">Full RSS feed</a></li>
</ul>
