<?php
class Panel {
	var $default_settings = Array(
		'backgroundscheme' => 'none',
		'logostyle' => 'text',
		'colorscheme' => 'default',
		'custom_rss' => 0,
		'custom_rss_url' => '',
		'custom_titleblack' => 0,
		'c_titleblack' => '',
		'custom_titledif' => 0,
		'c_titledif' => '',
	);

	function Panel() {
		add_action('admin_menu', array(&$this, 'admin_menu'));
		add_action('admin_head', array(&$this, 'admin_head'));

		if (!is_array(get_option('TypographyWP')))
			
			add_option('TypographyWP', $this->default_settings);
			
			$this->options = get_option('TypographyWP');

		if (function_exists('register_sidebar'))
			register_sidebar(array('name' => 'Sidebar'));
	}

	function admin_menu() {
		add_theme_page('TypographyWP', 'Theme Options', 'edit_themes', 'TypographyWP', array(&$this, 'optionsmenu'));
	}

	function admin_head() { }

	function optionsmenu() {
		if ($_POST['act1'] == 'save') {
			
			if (isset($_POST['backgroundscheme_act2'])) {
				$this->options["backgroundscheme"] = $_POST['backgroundscheme_act2'];
			}

			else { $this->options["backgroundscheme"] = "none"; }

			if (isset($_POST['colorscheme_act2'])) {
				$this->options["colorscheme"] = $_POST['colorscheme_act2'];
			}

			else { $this->options["colorscheme"] = "default"; }
			
			if (isset($_POST['logostyle_act2'])) {
				$this->options["logostyle"] = $_POST['logostyle_act2'];
			}

			else { $this->options["logostyle"] = "text"; }
			
			if ($_POST['customrss_act2'] == "on") {
				$this->options["custom_rss"] = 1;
			}

			else { $this->options["custom_rss"] = 0; }

			if ($_POST['customrss_act2url'] != "") {
				$this->options["custom_rss_url"] = $_POST['customrss_act2url'];
			}

			else { $this->options["custom_rss_url"] = ""; }	
			
		    if ($_POST['customtitleblack_act2'] == "on") {
				$this->options["custom_titleblack"] = 1;
			}

			else { $this->options["custom_titleblack"] = 0; }

			if ($_POST['ctitleblack_act2'] != "") {
				$this->options["c_titleblack"] = $_POST['ctitleblack_act2'];
			}

			else { $this->options["c_titleblack"] = ""; }
						
		    if ($_POST['customtitledif_act2'] == "on") {
				$this->options["custom_titledif"] = 1;
			}

			else { $this->options["custom_titledif"] = 0; }

			if ($_POST['ctitledif_act2'] != "") {
				$this->options["c_titledif"] = $_POST['ctitledif_act2'];
			}

			else { $this->options["c_titledif"] = ""; }
			
			update_option('TypographyWP', $this->options);
			echo '<div class="wrap updated fade" id="message" style="margin-top:20px;"><p>Settings <strong>saved</strong>.</p></div>';
		}
		?>
		<div class="wrap">
			<script>
			function fieldSwitch(switcher,target) {
				if (document.getElementById(switcher).checked==true) {
					document.getElementById(target).disabled=false;
				}
				else {
					document.getElementById(target).disabled=true;
				}
			}
			</script>
			<h2>"TypographyWP" Options</h2>
						
		  <form action="" method="post" class="themeform" name="Form" id="Form">
			<input type="hidden" id="act1" name="act1" value="save">
			<table class="widefat">
				<thead>
				<tr>
					<th scope="col" style="width: 40%">Design Options</th>
					<th scope="col">Settings</th>
				</tr>
				</thead>
				<tbody>
                	 <tr>
						<td><strong>What type of logo do you want? Text or Image?</strong><br /><small>If you select Image, edit the psd file and save it as logo.png in your images folder!</small></td>
						<td>
						<select name="logostyle_act2" id="logostyle_act2">
							<option value="text" <?php if ($this->options["logostyle"] == "text") { echo "selected"; }?>>Text</option>
							<option value="image" <?php if ($this->options["logostyle"] == "image") { echo "selected"; }?>>Image</option>
						</select>
						</td>
					</tr>
                	 <tr>
						<td><strong>Choose a background pattern for your theme!</strong><br /><small>All patterns are simple.</small></td>
						<td>
						<select name="backgroundscheme_act2" id="backgroundscheme_act2">
							<option value="default" <?php if ($this->options["backgroundscheme"] == "none") { echo "selected"; }?>>Default pattern</option>

							<?php
							$backgroundSchemes = array (
								array ('Pattern 1','pattern1'),
								array ('Pattern 2','pattern2'),
								array ('Pattern 3','pattern3'),
								array ('Pattern 4','pattern4')
								);

							$totalBSchemes = count($backgroundSchemes);
							$limitBSchemes = $totalBSchemes - 1;

							for ($bscheme = 0; $bscheme < $totalBSchemes; $bscheme++ ) {
								if (file_exists('../wp-content/themes/'.get_option('template').'/images/pat/'.$backgroundSchemes[$bscheme][1].'.jpg')) { ?>
								<option value="<?php echo $backgroundSchemes[$bscheme][1];?>" <?php if ($this->options["backgroundscheme"] == $backgroundSchemes[$bscheme][1]) { echo "selected"; }?>><?php echo $backgroundSchemes[$bscheme][0];?> style</option>
								<?php }
							} ?>
						</select>
						</td>
					</tr>
					<tr>
						<td><strong>Choose a color scheme for your theme!</strong><br /><small>Blue, red, green, orange and pink. It is your choice!</small></td>
						<td>
						<select name="colorscheme_act2" id="colorscheme_act2">
							<option value="default" <?php if ($this->options["colorscheme"] == "default") { echo "selected"; }?>>Default color scheme</option>

							<?php
							$colorSchemes = array (
								array ('Red','red'),
								array ('Green','green'),
								array ('Orange','orange'),
								array ('Pink','pink')
								);

							$totalSchemes = count($colorSchemes);
							$limitSchemes = $totalSchemes - 1;

							for ($scheme = 0; $scheme < $totalSchemes; $scheme++ ) {
								if (file_exists('../wp-content/themes/'.get_option('template').'/style-'.$colorSchemes[$scheme][1].'.css')) { ?>
								<option value="<?php echo $colorSchemes[$scheme][1];?>" <?php if ($this->options["colorscheme"] == $colorSchemes[$scheme][1]) { echo "selected"; }?>><?php echo $colorSchemes[$scheme][0];?> style</option>
								<?php }
							} ?>
						</select>
						</td>
					</tr>
                    <tr>
						<td><strong>Do you want to use a custom feed URL?</strong><br /><small>Type your feed url (from FeedBurner for ex) or leave this box unchecked to use the default RSS url!</small></td>
						<td><input type="checkbox" name="customrss_act2" id="customrss_act2" <?php if($this->options["custom_rss"] == 1) { echo " checked"; } ?> onClick="fieldSwitch('customrss_act2','customrss_act2url');" /><label style="margin-left: 5px;" for="customrss_act2">Yes, use this link as my custom feed url!</label><br /><input type="text" name="customrss_act2url" id="customrss_act2url" <?php if(isset($this->options["custom_rss_url"]) && $this->options["custom_rss_url"]!="") { echo ' value="'.$this->options["custom_rss_url"].'"'; }?> style="width: 70%; margin-top: 5px;" <?php if($this->options["custom_rss"] == 0) { echo " disabled"; } ?> /></td>
					</tr>
                    
                    
                    <tr>
						<td><strong>Use a custom title (logo).</strong><br /><small>Font color: black!</small></td>
						<td><input type="checkbox" name="customtitleblack_act2" id="customtitleblack_act2" <?php if($this->options["custom_titleblack"] == 1) { echo " checked"; } ?> onClick="fieldSwitch('customtitleblack_act2','ctitleblack_act2');" /><label style="margin-left: 5px;" for="customtitleblack_act2">Yes, use a custom title.</label><br /><input type="text" name="ctitleblack_act2" id="ctitleblack_act2" <?php if(isset($this->options["c_titleblack"]) && $this->options["c_titleblack"]!="") { echo ' value="'.$this->options["c_titleblack"].'"'; }?> style="width: 70%; margin-top: 5px;" <?php if($this->options["custom_titleblack"] == 0) { echo " disabled"; } ?> /></td>
					</tr>
                    
                    
                    <tr>
						<td><strong>Use a custom title with a different font color.</strong><br /><small>Font color: blue, red, green... depends what color scheme is selected!</small></td>
						<td><input type="checkbox" name="customtitledif_act2" id="customtitledif_act2" <?php if($this->options["custom_titledif"] == 1) { echo " checked"; } ?> onClick="fieldSwitch('customtitledif_act2','ctitledif_act2');" /><label style="margin-left: 5px;" for="customtitledif_act2">Yes, use a custom title. (2)</label><br /><input type="text" name="ctitledif_act2" id="ctitledif_act2" <?php if(isset($this->options["c_titledif"]) && $this->options["c_titledif"]!="") { echo ' value="'.$this->options["c_titledif"].'"'; }?> style="width: 70%; margin-top: 5px;" <?php if($this->options["custom_titledif"] == 0) { echo " disabled"; } ?> /></td>
					</tr>
				</tbody>
			</table>
			<p class="submit" style="text-align: right; border: none; margin: 0 0 20px 0;"><input type="submit" value="Update TypographyWP" name="save" /></p>
		  </form>
		</div>
		<?php
	}
}
?>