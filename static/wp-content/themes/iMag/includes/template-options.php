<?php

include(TEMPLATEPATH.'/includes/themetoolkit.php');

$themeName = 'iMag Theme';
$codename = 'iMag';

$getCategories = get_categories('hide_empty=0');
$catArray = array();
foreach ($getCategories as $cat) {
	$catArray[$cat->cat_ID] = $cat->cat_name;
}
array_unshift($catArray, "Select a category:");
$numberEntries = '|0|Select a Number:|1|1|2|2|3|3|4|4|5|5|6|6|7|7|8|8|9|9|10|10|12|12|14|14|16|16|18|18|20|20';
$catTmp = '';
foreach ($catArray as $key=>$cat) {
	$catTmp .= "|$cat|$cat";
}

themetoolkit(
	$codename,

	array(
	'separator1'	=> 'Slide Settings {separator}',
	'featuredCat'	=> 'Featured Post Category {select'.$catTmp.'} ## Select the category that you would like to have displayed on the featured posts.',
	'featuredNum'	=> 'Number of featured post {select'.$numberEntries.'} ## Select the number of posts to display.',
	'slideCat'		=> 'Slide Post Category {select'.$catTmp.'} ## Select the category that you would like to have displayed on the slide image.',
	'slideNum'		=> 'Number of slide post {select'.$numberEntries.'} ## Select the number of posts to display.',
	'separator2'	=> 'Other settings {separator}',
	'imageLogo'		=> 'Logo ## Your Logo Url (leave empty for default (text) logo)',

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