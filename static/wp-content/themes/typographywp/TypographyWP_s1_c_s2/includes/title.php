    <h1><a href="<?php echo get_option('home'); ?>" title="<?php bloginfo('description'); ?>">
      <?php if ($theme_options["custom_titleblack"] == 1 && isset($theme_options["c_titleblack"]) && $theme_options["c_titleblack"] != "") {
					$customtitle = $theme_options["c_titleblack"];
				}
				else {
					$customtitle = "theme";
				}
      ?>  
    <?php echo $customtitle; ?> 
    <?php if ($theme_options["custom_titledif"] == 1 && isset($theme_options["c_titledif"]) && $theme_options["c_titledif"] != "") {
					$customtitledif = $theme_options["c_titledif"];
				}
				else {
					$customtitledif = "preview";
				}
      ?>  
    <span><?php echo $customtitledif; ?></span> </a></h1>