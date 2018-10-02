<?php
/*
Plugin Name: unfake.it URL shortener for Twitter Tools
Plugin URI: http://unfake.it/help.php#twitter-tools
Description: Takes URLs to your new blog posts and shortens them befor sending to Twitter. This plugin totally depends on Twitter Tools v1.6 and above since it works as a filter. You may also save your shortened URLs on facebook using our facebook application. If configured so, your WordPress blog will take you to facebook.
Version: 1.2
Author: Thomas Gericke
Author URI: http://www.thomasgericke.de/
*/

// **********************************************************************
// COPYRIGHT
// **********************************************************************
// Copyright (c) 2009 Thomas Gericke. All rights reserved.
//
//
// **********************************************************************
// LICENSE
// **********************************************************************
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
//
// **********************************************************************
// ABOUT
// **********************************************************************
// This is an add-on for WordPress - http://wordpress.org/.
// It also is a filter for Twitter Tools plugin and won't work without.
//
//
// **********************************************************************
// CREDITS
// **********************************************************************
// Thanks to Alex King (http://alexking.org) for his Twitter Tools plugin
//
//
// **********************************************************************
// DISCLAIMER
// **********************************************************************
// This program is proudly brought to you without any warranty!


register_activation_hook(__FILE__,'tt_unfake_it_activate');
register_deactivation_hook(__FILE__,'tt_unfake_it_deactivate');

function tt_unfake_it_deactivate() {

	// glad, we have nothing to do here...

}

function tt_unfake_it_activate() {

	global $wpdb;

	$wpdb->unfake = $wpdb->prefix.'unfake_it_config';
	$wpdb->uf_store = $wpdb->prefix.'unfake_it_store';

	$createtable = $wpdb->query("
		CREATE TABLE " . $wpdb->unfake . " (
		`use_facebook` ENUM ( 'yes', 'no' ) DEFAULT 'yes'
		)");
	$wpdb->query($createtable);
	$setconfig = $wpdb->query("
		REPLACE INTO " . $wpdb->unfake . " (`use_facebook`) VALUES ('yes')");
	$wpdb->query($setconfig);

	$createtable = $wpdb->query("
		CREATE TABLE " . $wpdb->uf_store . " (
		`fake_url` varchar(12) NOT NULL,
		`timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP
		)");
	$wpdb->query($createtable);

}

add_action ('url-shortener-for-twitter-tools/tt_unfake_it.php', 'tt_unfake_it_activate');

function uf_menu() {

	global $wpdb;
	$wpdb->unfake = $wpdb->prefix.'unfake_it_config';

	if ($_POST["uf_action"] == "update") {

		$dropconfig = $wpdb->query("DELETE FROM " . $wpdb->unfake);
		$wpdb->query($dropconfig);

		$setconfig = $wpdb->query("INSERT INTO " . $wpdb->unfake . " (use_facebook) VALUES ('" . $_POST["use_facebook"] . "')");
		$wpdb->query($setconfig);

	}

	echo "<DIV CLASS='wrap'>";
	echo "<H2><I><B>unfake.it URL shortener for Twitter Tools</B></I></H2>";
	echo "This is our configuration page. At the moment, the one and only thing ";
	echo "to be adjusted here, is wheter or not you wish to use facebook to ";
	echo "save the shortened URL to your new blog posts. If <B>yes</B> you will ";
	echo "be taken to facebook and your short URL will be saved and a thumbnail ";
	echo "screenshot will be displayed on your profile page and also in your ";
	echo "facebook friend's newsfeeds.<BR /><BR />";
	echo "No worries, we won't save your facebook login data!";
	echo "<BR /><BR />";
	echo "Please keep in mind:";
	echo "<UL>";
	echo "<LI>unfake.it's URL shortener depends on Twitter Tools</LI>";
	echo "<LI>you need to allow popups for your own WordPress blog, because ";
	echo "it takes you to facebook</LI>";
	echo "</UL>";
	echo "<BR /><BR />";

	$results = $wpdb->get_results("SELECT `use_facebook` FROM " . $wpdb->unfake);
	foreach ($results as $result) {
		$uf_use_facebook = $result->use_facebook;
	}

	echo "Use facebook?";
	echo "<BR />";
	echo "<FORM ACTION='" . get_bloginfo("wpurl") . "/wp-admin/options-general.php?page=unfake.it' METHOD='POST'>";
	echo "<INPUT TYPE='hidden' NAME='uf_action' VALUE='update'>";
	echo "<SELECT NAME='use_facebook'>";
	echo "<OPTION VALUE=''>";
	echo "<OPTION VALUE='yes'";
		if ($uf_use_facebook == "yes") { echo " SELECTED"; }
	echo ">yes";
	echo "<OPTION VALUE='no'";
		if ($uf_use_facebook == "no") { echo " SELECTED"; }
	echo ">no";
	echo "</SELECT>";
	echo "<BR />";
	echo "<INPUT TYPE='submit' VALUE='update'>";
	echo "<BR /><BR />";
	echo "<A HREF='http://unfake.it/' TARGET=_BLANK>unfake.it URL shortener</A> by ";
	echo "<A HREF='http://www.thomasgericke.de' TARGET=_BLANK>Thomas Gericke</A>";

	echo "</DIV>";

}

function uf_admin_actions() {

	add_options_page("unfake.it URL shortener", "unfake.it URL shortener", 1, "unfake.it", "uf_menu");

}

add_action("admin_menu", "uf_admin_actions");

function fake_tt_url($long_url) { 

	$unfake_api = "http://unfake.it/?a=api&X-Client=wpv1.2&url=";
	$api_handle = fopen ($unfake_api . $long_url, "r");
	$fake_url = fread ($api_handle, 8192);
	fclose ($api_handle);

## PopUp-Hack begin
	
	global $wpdb;
	$my_fake = ereg_replace ("http:\/\/unfake.it\/", "", $fake_url);

	$wpdb->uf_store = $wpdb->prefix.'unfake_it_store';
	$addstore = $wpdb->query("INSERT INTO " . $wpdb->uf_store . " (fake_url) VALUES ('" . $my_fake . "')");
	$wpdb->query($addstore);

## PopUp-Hack end

	return $fake_url;

}

add_filter('tweet_blog_post_url', 'fake_tt_url');

function uf_add_popup() {

	global $wpdb;

	$wpdb->unfake = $wpdb->prefix.'unfake_it_config';
	$wpdb->uf_store = $wpdb->prefix.'unfake_it_store';

	$results = $wpdb->get_results("SELECT `use_facebook` FROM " . $wpdb->unfake);
	foreach ($results as $result) {
		$uf_use_facebook = $result->use_facebook;
	}

	sleep (3);

	$results = $wpdb->get_results("SELECT `fake_url` FROM " . $wpdb->uf_store . " WHERE `timestamp` > (NOW() - INTERVAL 42 SECOND)");
	foreach ($results as $result) {
		$my_fake = $result->fake_url;
	}

	echo "<!-- use facebook? $uf_use_facebook //-->";

	if ($uf_use_facebook == "yes") {

		echo "<!-- begin of plugin output added by WordPress plugin: unfake.it URL shortener";
		echo "	" . $my_fake . " - " . $uf_microtime . " //-->";
	
		if ($my_fake != "") {
	
			echo "<SCRIPT TYPE='text/javascript'>";
			echo "	window.open('http://apps.facebook.com/unfake_it/?u=" . $my_fake . "','','resizeable=no,scrollbars=no,toolbars=no,location=no,directories=no,status=no,menubar=no,width=1024,height=768');";
			echo "</SCRIPT>";
	
		}
	
		echo "<!-- end of plugin output from: unfake.it URL shortener //-->";

	}

}

add_action ('admin_head', 'uf_add_popup');

global $uf_fake;

?>
