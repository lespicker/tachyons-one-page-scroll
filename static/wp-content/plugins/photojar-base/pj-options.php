<?php
if ($_SERVER['REQUEST_METHOD']=='POST' && check_admin_referer('update-pj-options'))
{
    update_option('pj_linkto', $_POST['pj_linkto']);
    update_option('pj_linkto_single', $_POST['pj_linkto_single']);
    update_option('pj_viewer', $_POST['pj_viewer']);
    if($_POST['pj_viewer']=='custom')
    {
	    update_option('pj_custom_class', $_POST['pj_custom_class']);
	    update_option('pj_custom_rel', $_POST['pj_custom_rel']);
	}
    update_option('pj_insert_image', $_POST['pj_insert_image']);
    update_option('pj_gallery_columns', $_POST['pj_gallery_columns']);
    update_option('pj_gallery_size', $_POST['pj_gallery_size']);
    if($_POST['pj_gallery_size']=='custom')
    {
	    update_option('pj_custom_width', $_POST['pj_custom_width']);
	    update_option('pj_custom_height', $_POST['pj_custom_height']);
	    update_option('pj_custom_crop', $_POST['pj_custom_crop']);
    }
	update_option('pj_resize_full', $_POST['pj_resize_full']);
    if($_POST['pj_resize_full']=='true')
    {
	    update_option('pj_full_width', $_POST['pj_full_width']);
	    update_option('pj_full_height', $_POST['pj_full_height']);
    }
    update_option('pj_cache_path', $_POST['pj_cache_path']);
    update_option('pj_cache_url', $_POST['pj_cache_url']);
    update_option('pj_jpeg_quality', $_POST['pj_jpeg_quality']);
    do_action('pj_config_post');
    if($_POST['SubmitNClear']!='')
    {
    	pjClearCache();
    }
}

$pjLinkTo = get_option('pj_linkto');
$pjViewer = get_option('pj_viewer');
$pjLinkToSingle = get_option('pj_linkto_single');
$pjCustomClass = get_option('pj_custom_class');
$pjCustomRel = get_option('pj_custom_rel');
$pjInsertImage = get_option('pj_insert_image');
$pjGalleryColumns = get_option('pj_gallery_columns');
$pjGallerySize = get_option('pj_gallery_size');
$pjCustomWidth = get_option('pj_custom_width');
$pjCustomHeight = get_option('pj_custom_height');
$pjCustomCrop = get_option('pj_custom_crop');
$pjResizeFull = get_option('pj_resize_full');
$pjFullWidth = get_option('pj_full_width');
$pjFullHeight = get_option('pj_full_height');
$pjJpegQuality = get_option('pj_jpeg_quality');
$pjCachePath = get_option('pj_cache_path');
$pjCacheUrl = get_option('pj_cache_url');

?>

<div class="wrap">
	<form method="post">
		<?php wp_nonce_field('update-pj-options') ?>
		<h2><?php _e('PhotoJAR Settings') ?></h2>
		<table class="form-table">
		<tr valign="top">
			<th scope="row"><?php _e('Javascript Viewer') ?></th>
			<td>
				<select name="pj_viewer" id="pj_viewer" onchange="pjOnChange(this.form.pj_viewer, 'pj_custom_viewer');">
					<option value="none" <?php if($pjViewer=='none'){echo 'selected';}?>>None</option>
					<option value="lightbox" <?php if($pjViewer=='lightbox'){echo 'selected';}?>>LightBox/SlimBox</option>
					<option value="shadowbox" <?php if($pjViewer=='shadowbox'){echo 'selected';}?>>Shadowbox</option>
					<option value="lightview" <?php if($pjViewer=='lightview'){echo 'selected';}?>>LightView</option>
					<option value="thickbox" <?php if($pjViewer=='thickbox'){echo 'selected';}?>>ThickBox</option>
					<option value="custom" <?php if($pjViewer=='custom'){echo 'selected';}?>>Custom Viewer</option>
				</select>
			<span id="pj_custom_viewer" style="display: <?php echo ($pjViewer=='custom')?'inline':'none';?>;"><br />
				<b>See viewer documention to determine these values ("link class" may be not be required):</b><br />
				<label>link class=</label>
				<input type="text" name="pj_custom_class" value="<?php echo $pjCustomClass; ?>" /><br />
				<label>link rel=</label>
				<input type="text" name="pj_custom_rel" value="<?php echo $pjCustomRel; ?>" />
			</span></td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php _e('Link Gallery Images To') ?></th>
			<td>
				<select name="pj_linkto" id="pj_linkto">
					<option value="none" <?php if($pjLinkTo=='none'){echo 'selected';}?>>None</option>
					<option value="default" <?php if($pjLinkTo=='default'){echo 'selected';}?>>Wordpress Default</option>
					<option value="full" <?php if($pjLinkTo=='full'){echo 'selected';}?>>Full Size Image</option>
					<option value="viewer" <?php if($pjLinkTo=='viewer'){echo 'selected';}?>>Javascript Viewer</option>
				</select>
				<br />

				<?php _e('The <code>linkto</code> parameter in an <code>[gallery]</code> shortcode will override this setting.') ?>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php _e('Link Single Images To') ?></th>
			<td>
				<select name="pj_linkto_single" id="pj_linkto_single">
					<option value="none" <?php if($pjLinkToSingle=='none'){echo 'selected';}?>>None</option>
					<option value="default" <?php if($pjLinkToSingle=='default'){echo 'selected';}?>>Wordpress Default</option>
					<option value="full" <?php if($pjLinkToSingle=='full'){echo 'selected';}?>>Full Size Image</option>
					<option value="viewer" <?php if($pjLinkToSingle=='viewer'){echo 'selected';}?>>Javascript Viewer</option>
				</select>
				<br />

				<?php _e('The <code>linkto</code> parameter in an <code>[image]</code> shortcode will override this setting.') ?>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php _e('Image Shortcode') ?></th>
			<td><label for="pj_insert_image"><input name="pj_insert_image" type="checkbox" id="pj_insert_image" value="true" <?php if($pjInsertImage=='true'){echo 'checked';}?>/>
			Insert <code>[image]</code> shortcode into posts in place of html.</label></td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php _e('Gallery Columns') ?></th>
			<td><input name="pj_gallery_columns" type="text" id="pj_gallery_columns" value="<?php echo $pjGalleryColumns ?>" size="5" /><br />
			<?php _e('The <code>columns</code> parameter in a <code>[gallery]</code> shortcode will override this setting.');?></td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php _e('Gallery Image Size') ?></th>
			<td>
				<select name="pj_gallery_size" id="pj_gallery_size" onchange="pjOnChange(this.form.pj_gallery_size, 'pj_custom_size');">
					<option value="default" <?php if($pjGallerySize=='default'){echo 'selected';}?>>Wordpress Default</option>
					<option value="thumbnail" <?php if($pjGallerySize=='thumbnail'){echo 'selected';}?>>Thumbnail</option>
					<option value="medium" <?php if($pjGallerySize=='medium'){echo 'selected';}?>>Medium</option>
					<option value="full" <?php if($pjGallerySize=='full'){echo 'selected';}?>>Full</option>
					<option value="custom" <?php if($pjGallerySize=='custom'){echo 'selected';}?>>Custom</option>
				</select>
				<br />
				<?php _e('The <code>size</code> parameter in a <code>[gallery]</code> shortcode will override this setting.') ?>
				<span id="pj_custom_size" style="display: <?php echo ($pjGallerySize=='custom')?'inline':'none';?>;"><br />
					<label>width x height</label>
					<input type="text" name="pj_custom_width" size="5" value="<?php echo $pjCustomWidth;?>" /> x
					<input type="text" name="pj_custom_height" size="5" value="<?php echo $pjCustomHeight;?>" /> - Crop 
					<input type="checkbox" name="pj_custom_crop" value="true" <?php if($pjCustomCrop=='true'){echo 'checked';}?>/>
				</span></td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php _e('Constrain Full Size Images') ?></th>
			<td>
				<input name="pj_resize_full" type="checkbox" id="pj_resize_full" onclick="pjOnClick('pj_resize_full', 'pj_full_size');" value="true" <?php if($pjResizeFull=='true'){echo 'checked';}?>/>
				<span id="pj_full_size" style="display: <?php echo ($pjResizeFull=='true')?'inline':'none';?>;">
					<label>width x height</label>
					<input type="text" name="pj_full_width" size="5" value="<?php echo $pjFullWidth;?>" /> x
					<input type="text" name="pj_full_height" size="5" value="<?php echo $pjFullHeight;?>" />
				</span></td>
		</tr>
		</table>
		<?php do_action('pj_config');?>
		<h2><?php _e('Advanced') ?></h2>
		<table class="form-table">
		<tr valign="top">
			<th scope="row"><?php _e('JPEG Quality') ?></th>
			<td><input name="pj_jpeg_quality" type="text" id="pj_jpeg_quality" value="<?php echo $pjJpegQuality ?>" size="5" /><br />
			Default setting is 90.</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php _e('PhotoJAR Cache Path') ?></th>
			<td><input name="pj_cache_path" type="text" id="pj_cache_path" value="<?php echo $pjCachePath ?>" style="width: 95%;" /><br />
			Default setting is '<?php echo PJ_DEFAULT_CACHE_PATH;?>'.</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php _e('PhotoJAR Cache Url') ?></th>
			<td><input name="pj_cache_url" type="text" id="pj_cache_url" value="<?php echo $pjCacheUrl ?>" style="width: 95%;" /><br />
			Default setting is '<?php echo PJ_DEFAULT_CACHE_URL;?>'.</td>
		</tr>
		</table>
		<?php do_action('pj_config_advanced');?>
		<p class="submit">
			<input type="submit" name="Submit" value="<?php _e('Update Options') ?> &raquo;" />
			<input type="submit" name="SubmitNClear" value="<?php _e('Update Options and Clear Cache') ?> &raquo;" />
		</p>
	</form>
</div>
<script type="text/javascript">
	<!--
	function pjOnChange(list, theID)
	{
	    var index  = list.selectedIndex;
	    var value = list.options[index].value;
	    if(value=="custom")
	    {
	    	document.getElementById(theID).style.display = 'inline';
    	}
    	else
    	{
    		document.getElementById(theID).style.display = 'none';
		}
	    return true;
	}
	
	function pjOnClick(checkboxID, theID)
	{
	    var checked = document.getElementById(checkboxID).checked;
	    if(checked==true)
	    {
	    	document.getElementById(theID).style.display = 'inline';
    	}
    	else
    	{
    		document.getElementById(theID).style.display = 'none';
		}
	    return true;
	}
	// -->
</script>