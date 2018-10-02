<?php
/**
 * Plugin Name: PhotoJAR: Base
 * Plugin URI: http://www.jarinteractive.com
 * Description: Provides numerous enhancements to the Wordpress gallery.
 * Version: 1.1
 * Author: James Rantanen
 * Author URI: http://www.jarinteractive.com
 */

/*
    Copyright (C) 2008 James Rantanen (JARinteractive)

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

//Check PHP version
if (version_compare(phpversion(), "5.0.0", "<"))
{
	die('PhotoJAR requires PHP5, your PHP version is '.phpversion());
}

define('PJ_BASE_PATH', dirname(__FILE__));

//error_reporting(E_WARNING);
$pjWPUD = wp_upload_dir();
define('PJ_DEFAULT_CACHE_PATH', $pjWPUD['basedir'].'/photojar/cache/');
define('PJ_DEFAULT_CACHE_URL', $pjWPUD['baseurl'].'/photojar/cache/');
define('PJ_BASE_PATH', dirname(__FILE__));

$pjcpath = trim(get_option('pj_cache_path'));
$pjcurl = trim(get_option('pj_cache_url'));
if($pjcpath == '')
	$pjcpath = PJ_DEFAULT_CACHE_PATH;
if($pjcurl == '')
	$pjcurl = PJ_DEFAULT_CACHE_URL;
define('PJ_CACHE_PATH', $pjcpath);
define('PJ_CACHE_URL', $pjcurl);

if(is_admin && !@opendir(PJ_CACHE_PATH))
{
	function photojar_warning() 
	{
		echo '<div id="photojar-warning" class="updated fade"><p><strong>PhotoJAR Error: </strong> the PhotoJAR cache directory ('.PJ_CACHE_PATH.') is missing.</p></div>';
	}
	add_action('admin_notices', 'photojar_warning');
}

//improved image resizing & caching
include_once(PJ_BASE_PATH.'/pj-image-resize.php');
$imageResize= new ImageResize();
add_filter('image_downsize', array($imageResize, 'imageDownsizeFilter'), 1, 3);

//image shortcode
include_once(PJ_BASE_PATH.'/pj-image-shortcode.php');
$imageShortcode= new ImageShortcode();
add_shortcode('image', array($imageShortcode, 'imageShortcodeHandler'));
if(get_option('pj_insert_image')=='true')
	add_filter('image_send_to_editor', array($imageShortcode, 'generateTagForEditor'), 1, 7);

//Gallery Shortcode Override - Columns & Size
include_once(PJ_BASE_PATH.'/pj-gallery-shortcode.php');
include_once(PJ_BASE_PATH.'/pj-gallery.php');
add_shortcode('gallery', 'pjDisplayGallery');

//Image Linking &
//LightBox, ThickBox, LightView, Etc...
include_once(PJ_BASE_PATH.'/pj-link-utility.php');

//Config Page
function addPhotoJarConfig() 
{
	add_options_page('PhotoJAR', 'PhotoJAR', 10, basename(dirname(__FILE__)).'/pj-options.php');
}
add_action('admin_menu', 'addPhotoJarConfig');

//install
function pjBaseInstall()
{
	if(get_option('pj_linkto')=='')
	{
		update_option('pj_linkto', 'default');
	}
	if(get_option('pj_linkto_single')=='')
	{
		$linkTo = get_option('pj_linkto');
		update_option('pj_linkto_single', $linkTo);
	}
	if(get_option('pj_viewer')=='')
	{
		update_option('pj_viewer', 'lightbox');
	}
	if(get_option('pj_insert_image')=='')
	{
		update_option('pj_insert_image', 'true');
	}
	if(get_option('pj_gallery_columns')=='')
	{
		update_option('pj_gallery_columns', '3');
	}
	if(get_option('pj_gallery_size')=='')
	{
		update_option('pj_gallery_size', 'thumbnail');
	}
	if(get_option('pj_jpeg_quality')=='')
	{
		update_option('pj_jpeg_quality', '90');
	}
	if(get_option('pj_cache_path')=='')
	{
		update_option('pj_cache_path', PJ_DEFAULT_CACHE_PATH);
	}	
	if(get_option('pj_cache_url')=='')
	{
		update_option('pj_cache_url', PJ_DEFAULT_CACHE_URL);
	}
	wp_mkdir_p(PJ_CACHE_PATH);
	
	pjClearCache();
}
add_action('activate_'.plugin_basename(__FILE__), 'pjBaseInstall');

function pjClearCache()
{
	$cache = opendir(PJ_CACHE_PATH);
	while (false !== ($file = readdir($cache))) 
	{
		if ($file != "." && $file != "..") 
		{
			unlink(PJ_CACHE_PATH.$file);
		}
	}
	closedir($cache);
}