<?php
/**
 * coded by misbah (ini_misbah@yahoo.com)
 */

include(TEMPLATEPATH.'/includes/themetoolkit.php');

$themeName = 'CianMag Theme';
$codename = 'CianMag';

$getCategories = get_categories('hide_empty=0');
$catArray = array();
foreach ($getCategories as $catm) {
	$catArray[$catm->cat_ID] = $catm->cat_name;
}
array_unshift($catArray, "Select a category:");
$numberEntries = '|0|Select a Number:|1|1|2|2|3|3|4|4|5|5|6|6|7|7|8|8|9|9|10|10|12|12|14|14|16|16|18|18|20|20';
$catTmp = '';
foreach ($catArray as $key=>$catn) {
	$catTmp .= "|$catn|$catn";
}

themetoolkit(
	$codename,

	array(
	'slideCat'		=> 'Slide Post Category {select'.$catTmp.'} ## Select the category that you would like to have displayed on the slide image.',
	'slideNum'		=> 'Number of slide post {select'.$numberEntries.'} ## Select the number of posts to display.',
	'topAdv'		=> 'Header Advertisement {textarea|5|40} ## Your 468x60 adv code (javascript or XHTML)',
	'imageLogo'		=> 'Logo  ## Your Logo Url (leave empty for default (text) logo)',

	),
	TEMPLATEPATH.'/functions.php'	/** Parent. DO NOT MODIFY THIS LINE !
				 * This is used to check which file (and thus theme) is calling
				 * the function (useful when another theme with a Theme Toolkit
				 * was installed before
				 */
);

if (!$$codename->is_installed()) {
	$set_defaults['imageLogo'] = trailingslashit( get_bloginfo('url') ).'wp-content/themes/'.$codename.'/images/logo.jpg';
	$result = $$codename->store_options($set_defaults);
}


?>