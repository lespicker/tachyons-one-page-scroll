<?php
/*
Plugin Name: TweetSuite
Plugin URI: http://danzarrella.com/beyond-tweetbacks-introducing-tweetsuite.html 
Description: A WordPress Plugin to integrate Twitter and WordPress
Version: 0.8
Author: Dan Zarrella
Author URI: http://danzarrella.com
*/
$ts_version = .9;
if ( ! defined( 'WP_CONTENT_URL' ) )
      define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );

add_action('admin_menu', 'tb_menu');
//add_filter('publish_post', 'decodeShortURLs');
//add_filter('publish_post', 'ts_send_tweet');

add_action('future_to_publish','decodeShortURLs');
add_action('new_to_publish','decodeShortURLs');
add_action('draft_to_publish','decodeShortURLs');

add_action('future_to_publish','ts_send_tweet');
add_action('new_to_publish','ts_send_tweet');
add_action('draft_to_publish','ts_send_tweet');

add_filter('the_content', 'addTweetBacks');

add_action('loop_end', 'updateTweetBacks');
register_activation_hook(__FILE__,'tweetbacks_install');
add_action('widgets_init', 'tweetsuite_widget_innit');

add_filter('cron_schedules', 'more_reccurences');
if (!wp_next_scheduled('tweetsuite_hourly_hook')) {
	wp_schedule_event( time(), 'hourly', 'tweetsuite_hourly_hook' );
}

if (!wp_next_scheduled('tweetsuite_5mins_hook')) {
	wp_schedule_event( time(), '5mins', 'tweetsuite_5mins_hook' );
}
add_action( 'tweetsuite_5mins_hook', 'tweetsuite_5mins' );

//tweetsuite_5mins();

function tweetsuite_5mins() {
	//echo "here";
	global $wpdb;	
	$table_name = $wpdb->prefix . "shorturls";

	$delayed = mktime()-600;
	$buff = $wpdb->get_results("SELECT * FROM $table_name WHERE accessed>$delayed");
	foreach ($buff as $line) {
	//	echo $line->postID."<br/>";
		if ( (!trim($line->tinyurl)) or 
			(!trim($line->snipurl)) or 
			//(!trim($line->trim)) or 
			(!trim($line->bitly)) ) {
				decodeShortURLs($line->postID);
			}
		getTweetBacks($line->postID);
	}

}



function more_reccurences() {
	return array('5mins' => array('interval' => 300, 'display' => 'Every 5 Minutes') );
}


function ts_send_tweet($postID) {
	global $wpdb;
	if(!is_int($postID)) {
		$postID = $postID->ID;
	}
	$table_name = $wpdb->prefix . "shorturls";
	$line = $wpdb->get_row("select * from $table_name where postID=$postID");
   	if($line->postID==$postID) {
   	    $tinyurl = $line->tinyurl;
		$post = get_post($postID);
		if(get_option('tweetsuite_send_posts')) { tweetsuite_send(trim($post->post_title).' '.$tinyurl); }
	}
}

function tweetsuite_hourly() {
	global $wpdb;
	if(get_option('tweetsuite_favorites')) {
		$favorites = parseTweets('favorites');	
		$table_name = $wpdb->prefix . "ts_favorites";
		addTweets($table_name, $favorites);				
	}
	if(get_option('tweetsuite_mine')) {
		$mine =  parseTweets();
		$table_name = $wpdb->prefix . "ts_mine";
		addTweets($table_name, $mine);		
	}
}	



function updateTweetBacks() {
	global $post, $wpdb;
	$table_name = $wpdb->prefix . "shorturls";
	$postID =$post->ID;
	$now = mktime();
	$line = $wpdb->get_row("select * from $table_name where postID=$postID");
	if($line->postID!=$postID) {
		$results = $wpdb->query("insert into $table_name (postID, accessed) values ($postID, $now)");	
	}
	else {		
		$results = $wpdb->query("update $table_name set accessed=$now where postID = $postID");	
	}
	//getTweetBacks($post->ID);
}

//decodeShortURLs($postID);
//getTweetBacks($postID);

function tweetsuite_tweetthis_button() {
	global $post, $wpdb;
	$table_name = $wpdb->prefix . "shorturls";
	$postID = $post->ID;
	$line = $wpdb->get_row("SELECT tweetthis, count FROM $table_name WHERE postID = $postID");
	$tweetthis = $line->tweetthis;
	$count = $line->count;
	$fn = 'rt-'.$count.'.png';
		if (file_exists(WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/'.$fn)) {
			$src=WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/'.$fn;
		}	
		else {
			$src = WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__))."/rt-gif.php?count=$count";
		}	
		$content = "<a href='$tweetthis'><img border='0' src='$src'></a>";
		echo $content;
}

function addTweetBacks($content) {
if( is_single() ) {
	global $wpdb, $post;
	$postID =$post->ID;
	$table_name = $wpdb->prefix . "tweetbacks";
 	$max_tbs = get_option('tb_max');
	if($max_tbs) { $limit = "limit $max_tbs";}
	
	$buff = $wpdb->get_results("SELECT * FROM $table_name WHERE postID = $postID order by datetime desc $limit");

	foreach ($buff as $line) {
		$count++;
		$tweet = strip_tags(stripslashes($line->tweet));
		$author = $line->author;
		$dt = $line->datetime;
		$avatar = $line->avatar;
		$posted = date('m/d/y h:ia', $dt);
		
		if(get_option('tweetsuite_retweetthis')) {
			$rt = urlencode($tweet);
			$tt_url = "http://twitter.com/home?status=rt:+@$author+$rt";
			$rt_this = WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/rt_this.gif';		  
			$rt_this_button = "<div style='float:right; margin-left:0px;'><a href='$tt_url'><img border='0' src='$rt_this'></a></div>";
		}
		
		$output .="<li style='display: block; height: 50px; margin-bottom: 10px;'>$rt_this_button<img width='48' src='$avatar' style='float:left; margin-right:5px;'><b><A href='http://twitter.com/$author'>$author</a>:</b> $tweet <span style='color:#009900;'>$posted</span></li>";
		
	}
	$table_name = $wpdb->prefix . "shorturls";
	$line = $wpdb->get_row("SELECT tweetthis, count FROM $table_name WHERE postID = $postID");
	$tb_count = $line->count;
	$tweetthis = $line->tweetthis;
	if($count>0) {
		$output = "<div id='tweetbacks'><b>$count Total TweetBacks:</b> (<a href='$tweetthis'>Tweet this post</a>) <ul>".$output."</ul></div>";
	}
	else {
		$output = "<div id='tweetbacks'><b>No TweetBacks yet.</b> (<a href='$tweetthis'>Be the first to Tweet this post</a>)</div>";
	}
	
	if(get_option('tweetsuite_tweetthis')) {
		$fn = 'rt-'.$tb_count.'.png';
		if (file_exists(WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/'.$fn)) {
			$src=WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/'.$fn;
		}	
		else {
			$src = WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__))."/rt-gif.php?count=$tb_count";
		}	
		$float = get_option('tweetsuite_tweetthis_float');	
		if(!$float) { $float = 'left'; }
		$content = "<a href='$tweetthis'><img border='0' style='float:$float; margin-right:5px;' src='$src'></a>".$content;
	}

	return $content . $output;
	}
	else {
		return $content;
	}
}

function addTweets($table_name, $entries) {
global $wpdb;
if(count($entries)>0) {
foreach($entries as $entry) {
		//print_r($entry);
		$tweet = $wpdb->escape($entry['tweet']);
		$author = $entry['author'];
		$link =  $entry['link'];
		$dt =  $entry['dt'];		
		$avatar =  $entry['avatar'];
		$q = "insert into $table_name ( datetime, tweet, author, link, avatar) values ($dt, '$tweet', '$author', '$link', '$avatar') ";
		//echo $q."<br/>";
		$results = $wpdb->query($q);				
	}
	}
}



function parseAtom($data) {
$chunks = split('<entry>', $data);
array_shift($chunks);
//print_r($chunks);
foreach($chunks as $chunk) {
	$lines = split("\n", $chunk);
	//print_r($lines);
	if(strstr($lines[9], '<author>')) {
		$author = split("\(", $lines[10]);
	}
	else {
		$author = split("\(", $lines[9]);
	}
	$author = trim(str_replace('<name>', '', $author[0]));
	$tweet = trim(str_replace(array('<title>', '</title>', '<content type="html">', '</content>'), '', $lines[5]));	
	list($junk, $avatar) = split('href="', $lines[7]);
	$avatar = str_replace('"/>', '', $avatar);
	$dt = $lines[2];
	list($date, $time) = split('T', $dt);
	$time = str_replace('Z', '', $time);
	list($hour, $minute, $second) = split(':', $time);
	list($year, $month, $day) = split('-', $date);
	$year = trim(str_replace('<published>', '', $year));
	$dt = mktime($hour, $minute, $second, $month, $day, $year);	
	
	list($junk, $link) = split('href="', $lines[3]);
	$link = str_replace('"/>', '', $link);
	
	$ret['tweet'] = strip_tags(html_entity_decode($tweet));
	$ret['link'] = $link;
	$ret['author'] = $author;
	$ret['avatar'] = $avatar;
	$ret['dt'] = $dt;						
	$return[] = $ret;	
}
return $return;
}


function tweetbacks_install () {
   global $wpdb, $ts_version;
   
    $table_name = $wpdb->prefix . "tweetbacks";
   if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
   		$sql = "CREATE TABLE `".$table_name."` (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  postID int(11) NOT NULL,
  datetime int(11) NOT NULL,
  link varchar(255) NOT NULL,
  avatar varchar(255) NOT NULL,
  tweet varchar(150) NOT NULL,
  author varchar(255) NOT NULL ,
   UNIQUE KEY id (id),
   UNIQUE KEY link (link)
);";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
		//echo "here";
   }
   
   $table_name = $wpdb->prefix . "ts_favorites";
   if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
   		$sql = "CREATE TABLE `".$table_name."` (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  datetime int(11) NOT NULL,
  link varchar(255) NOT NULL,
  avatar varchar(255) NOT NULL,
  tweet varchar(150) NOT NULL,
  author varchar(255) NOT NULL ,
   UNIQUE KEY id (id),
   UNIQUE KEY link (link)
);";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
		//echo "here";
   }
   
   $table_name = $wpdb->prefix . "ts_mine";
   if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
   		$sql = "CREATE TABLE `".$table_name."` (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  datetime int(11) NOT NULL,
  link varchar(255) NOT NULL,
  avatar varchar(255) NOT NULL,
  tweet varchar(150) NOT NULL,
  author varchar(255) NOT NULL ,
   UNIQUE KEY id (id),
   UNIQUE KEY link (link)
);";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
		//echo "here";
   }
   
   
   $table_name = $wpdb->prefix . "shorturls";
   if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
   		$sql = "CREATE TABLE `".$table_name."` (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  postID int(11) NOT NULL,
  count int(11) NOT NULL,
  accessed int(11) NOT NULL,
  tweetthis varchar(255) NOT NULL,
  tinyurl varchar(255) NOT NULL,
  isgd varchar(150) NOT NULL,
  snipurl varchar(150) NOT NULL,
  trim varchar(150) NOT NULL,
  bitly varchar(255) NOT NULL,
  UNIQUE KEY id (id),
  UNIQUE KEY postID (postID)
  );";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
   }      
   
	ts_setDefaults();
}

function clearTweetBacks() {
	global $wpdb;
	$table_name = $wpdb->prefix . "tweetbacks";
	$results = $wpdb->query('delete from $table_name');	
}
function getTweetBacks($postID) {
	global $wpdb;
	$table_name = $wpdb->prefix . "shorturls";
	$q = "select * from $table_name where postID=$postID";
		$line = $wpdb->get_row("select * from $table_name where postID=$postID");
	if(!$line->postID) {
		decodeShortURLs($postID);
		$line = $wpdb->get_row("select * from $table_name where postID=$postID");
	}
	
	$tinyurl = $line->tinyurl;
	$bitly = $line->bitly;
	$snipurl = $line->snipurl;
	//$trim = $line->trim;		
	$turl = 'http://search.twitter.com/search.atom?rpp=100&q=&ors=';
	if($tinyurl) {
		$turl .= urlencode($tinyurl).'+';
	}
	else {$short_broken=true;}
	if($bitly) {
		$turl .= urlencode($bitly).'+';
	}
	else {$short_broken=true;}
	if($snipurl) {
		$turl .= urlencode($snipurl).'+';
	}
	else {$short_broken=true;}
	/*
	if($trim) {
		$turl .= urlencode($trim);	
	}
	else {$short_broken=true;}
	*/
	$table_name = $wpdb->prefix . "tweetbacks";
	/*
	$line = $wpdb->get_row("select datetime from $table_name where postID=$postID order by datetime desc limit 1");
	$last = $line->datetime;
	*//*
	$last = get_option('tweetsuite_updated_'.$postID);
	if(!$last) {$last = 1; }
	$delay = get_option('tweetsuite_delay');
	
	if(!$delay) { $delay = 300; }
	if( ($last+$delay)>mktime()) { 

		return false; 
	}
	*/
	//update_option('tweetsuite_updated_'.$postID, mktime());
	$data = tb_get($turl);
	$entries = parseAtom($data);
	//print_r($array);
	if(count($entries)>0) {
	$own = get_option('tweetsuite_twitter_username');
	$hide_own = get_option('tweetsuite_own');
	foreach($entries as $entry) {
		//print_r($entry);
		$tweet = $wpdb->escape($entry['tweet']);
		$author = $entry['author'];
		$link =  $entry['link'];
		$add = true;
		
		if(($hide_own) and (strtolower($author)==strtolower($own))) {
			$add = false;
		}
		if(stristr($tweet, 'http://bit.ly')) {
			if(strstr($tweet, $bitly)) {
				$add = true;
			}
			else {
				$add = false;
			}
		}
		if($add) {
			$dt =  $entry['dt'];		
			$avatar =  $entry['avatar'];
		
			$q = "insert into $table_name (postID, datetime, tweet, author, link, avatar) values ($postID, $dt, '$tweet', '$author', '$link', '$avatar') ";
			$results = $wpdb->query($q);		
		//$count++;
		}
	}
		$q = "select count(id) as c from $table_name where postID=$postID";	
		$line = $wpdb->get_row($q);
		$count = $line->c;
		//print_r($line);
		$table_name = $wpdb->prefix . "shorturls";
		$q = "update $table_name set count=$count where postID=$postID";
		$results = $wpdb->query($q);	
	}
	
	
}

function decodeShortURLs($postID) {
	global $wpdb;
	if(!is_int($postID)) {
		$postID = $postID->ID;
	}
	//echo "here: $postID";
   $table_name = $wpdb->prefix . "shorturls";
   
   $line = $wpdb->get_row("select * from $table_name where postID=$postID");
  	$url = get_permalink($postID);		
   if($line->postID==$postID) {
   	
	if( (trim($line->tinyurl)) and (trim($line->snipurl)) and (trim($line->bitly)) ) 
	{  return false; }
	
   	if(!trim($line->tinyurl)) {
		$tinyurl = tinyUrl($url);	
	}
	else {
		$tinyurl = $line->tinyurl;
	}
	
	if(!trim($line->bitly)) {
		$bitly = bitly($url);	
	}
	else {
		$bitly = $line->bitly;
	}
	
	if(!trim($line->snipurl)) {
		$snipurl = snipurl($url);	
	}
	else {
		$snipurl = $line->snipurl;
	}   
   /*	if(!trim($line->trim)) {
		$trim = getTrim($url);	
	}
	else {
		$trim = $line->trim;
	}   
	*/
	$update =true;
	//echo "here";
	}
else {

  
	$tinyurl = tinyUrl($url);
	//$isgd = isgd($url);
	$bitly = bitly($url);
	$snipurl = snipurl($url);
	//$trim = getTrim($url);
}
	
	$from_name = get_option('tweetsuite_twitter_username');
	if($from_name) {
		$from = "+from:+@$from_name";
	}
	$post = get_post($postID);
	//$title = str_replace(' ', '+', trim($post->post_title));	
	$title = urlencode($post->post_title);
	$tt_url = "http://twitter.com/home?status=$title+$tinyurl$from";
	$insert = "replace INTO " . $table_name . " (postID, tinyurl, bitly, snipurl, tweetthis, accessed) " .
            "VALUES ($postID, '" . $wpdb->escape($tinyurl) . "',
								'" . $wpdb->escape($bitly) . "',
								'" . $wpdb->escape($snipurl) . "',							
								'".$wpdb->escape($tt_url)."'	,
								".mktime()."
								)";

//echo $insert."<---";
  $results = $wpdb->query( $insert );

	//if(get_option('tweetsuite_send_posts')) { tweetsuite_send(trim($post->post_title).' '.$tinyurl); }

}



function tb_menu() {
		add_options_page('TweetSuite Options', 'TweetSuite', 8, __FILE__, 'tb_options');

}


function ts_setDefaults() {
	//add_option('tweetbacks_enabled', 1);
	add_option('tweetsuite_retweetthis', 1);
	add_option('tweetsuite_mine', 1);
	add_option('tweetsuite_favorites', 1);
}

function tb_options() {
global $ts_version;
if($_POST) {
$page_options = split(',', $_POST['page_options']);
foreach($page_options as $opt) {
	//print_r($_POST);
	update_option('tb_max', $_POST['tb_max']);
	update_option('tweetsuite_twitter_username', $_POST['tweetsuite_twitter_username']);
	update_option('tweetsuite_twitter_password', $_POST['tweetsuite_twitter_password']);
	update_option('tweetsuite_tweetthis_float', $_POST['tweetsuite_tweetthis_float']);
	update_option('tweetsuite_tweetthis_position', $_POST['tweetsuite_tweetthis_position']);
	update_option('tweetsuite_prefix', $_POST['tweetsuite_prefix']);
	//
	//[tb_noavatars
	//
	
	if($_POST['tb_noavatars']) {
		update_option('tb_noavatars', 1);
	}
	else {
		update_option('tb_noavatars', 0);
	}
		
	
	//tweetbacks_enabled
		if($_POST['tweetbacks_enabled']) {
		update_option('tweetbacks_enabled', 1);
	}
	else {
		update_option('tweetbacks_enabled', 0);
	}
	
		//tweetbacks_enabled
		if($_POST['tweetsuite_send_posts']) {
		update_option('tweetsuite_send_posts', 1);
	}
	else {
		update_option('tweetsuite_send_posts', 0);
	}
		//tweetsuite_own
		if($_POST['tweetsuite_own']) {
		update_option('tweetsuite_own', 1);
	}
	else {
		update_option('tweetsuite_own', 0);
	}
	
		//tweetsuite_tweetthis
		if($_POST['tweetsuite_tweetthis']) {
		update_option('tweetsuite_tweetthis', 1);
	}
	else {
		update_option('tweetsuite_tweetthis', 0);
	}
	
				//tweetsuite_mine
		if($_POST['tweetsuite_retweetthis']) {
		update_option('tweetsuite_retweetthis', 1);		
	}
	else {
		update_option('tweetsuite_retweetthis', 0);
	}
	
		//tweetsuite_mine
		if($_POST['tweetsuite_mine']) {
		update_option('tweetsuite_mine', 1);		
	}
	else {
		update_option('tweetsuite_mine', 0);
	}		
	
		//tweetsuite_favorites
		if($_POST['tweetsuite_favorites']) {
		update_option('tweetsuite_favorites', 1);
	}
	else {
		update_option('tweetsuite_favorites', 0);
	}
	
	
	if(($_POST['tweetsuite_favorites']) or ($_POST['tweetsuite_mine']) ) {
		tweetsuite_hourly();
	}
	
	if($_POST['tweetsuite_clear']) {
		clearTweetBacks();
	}
}
}
//tweetsuite_mine
?>
<div class="wrap">
<h2>TweetSuite <?php echo $ts_version;?></h2>
<form method="post" action="">
<?php wp_nonce_field('update-options'); ?>
<table class="form-table">
	

<tr valign="top">
<th scope="row">Display TweetBacks?</th>
<td><INPUT TYPE=CHECKBOX NAME="tweetbacks_enabled" <?php if(get_option('tweetbacks_enabled')) { echo "checked"; } ?>>
</td>
</tr>

<tr valign="top">
<th scope="row">Insert Tweet-This button into posts?</th>
<td><INPUT TYPE=CHECKBOX NAME="tweetsuite_tweetthis" <?php if(get_option('tweetsuite_tweetthis')) { echo "checked"; } ?>>
</td>
</tr>


<tr valign="top">
<th scope="row">Float Tweet-this Button:</th>
<td>
<select name="tweetsuite_tweetthis_float">
<option value='left' <?php if(get_option('tweetsuite_tweetthis_float')=='left') { echo 'selected'; } ?>>Left</option>
<option value='right' <?php if(get_option('tweetsuite_tweetthis_float')=='right') { echo 'selected'; } ?>>Right</option>
</select>
</td>
</tr>


<tr valign="top">
<th scope="row">Display ReTweet-This Buttons?</th>
<td><INPUT TYPE=CHECKBOX NAME="tweetsuite_retweetthis" <?php if(get_option('tweetsuite_retweetthis')) { echo "checked"; } ?>>
</td>
</tr>

<tr valign="top">
<th scope="row">Enable Favorites widget?</th>
<td><INPUT TYPE=CHECKBOX NAME="tweetsuite_favorites" <?php if(get_option('tweetsuite_favorites')) { echo "checked"; } ?>>
</td>
</tr>

<tr valign="top">
<th scope="row">Enable My Tweets widget?</th>
<td><INPUT TYPE=CHECKBOX NAME="tweetsuite_mine" <?php if(get_option('tweetsuite_mine')) { echo "checked"; } ?>>
</td>
</tr>

<tr valign="top">
<th scope="row">Maximum number of TweetBacks to display:</th>
<td><input type="text" size="3" name="tb_max" value="<?php echo get_option('tb_max'); ?>" /></td>
</tr>

<tr valign="top">
<th scope="row">Turn off Avatars?</th>
<td><INPUT TYPE=CHECKBOX NAME="tb_noavatars" <?php if(get_option('tb_noavatars')) { echo "checked"; } ?>>
</td>
</tr>

<tr valign="top">
<th scope="row">Send a Tweet when you publish a post?</th>
<td><INPUT TYPE=CHECKBOX NAME="tweetsuite_send_posts" <?php if(get_option('tweetsuite_send_posts')) { echo "checked"; } ?>>
</td>
</tr>

<tr valign="top">
<th scope="row">PreFix to add to AutoTweets?</th>
<td><INPUT TYPE=text NAME="tweetsuite_prefix"  value='<?php echo get_option('tweetsuite_prefix'); ?>' >
</td>
</tr>

<tr valign="top">
<th scope="row">Twitter Username:</th>
<td><input type="text" size="20" name="tweetsuite_twitter_username" value="<?php echo get_option('tweetsuite_twitter_username'); ?>" /></td>
</tr>

<tr valign="top">
<th scope="row">Hide Tweets from you?</th>
<td><INPUT TYPE=CHECKBOX NAME="tweetsuite_own" <?php if(get_option('tweetsuite_own')) { echo "checked"; } ?>>
</td>
</tr>

<tr valign="top">
<th scope="row">Twitter Password:</th>
<td><input type="password" size="20" name="tweetsuite_twitter_password" value="<?php echo get_option('tweetsuite_twitter_password'); ?>" /></td>
</tr>

<tr valign="top">
<th scope="row">Clear TweetBacks DB?</th>
<td><INPUT TYPE=CHECKBOX NAME="tweetsuite_clear" >
</td>
</tr>

</table>
<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
</p>
</form>
</div>

<?php
}
function zima($url) {
		$bl = tb_get('http://zi.ma/?module=ShortURL&file=Add&mode=API&url='.$url);
		return trim($bl);
	}
function tinyUrl($url) {
$tu = tb_get('http://tinyurl.com/create.php?url='.$url);
$tu = split('Open in new window', $tu);
list($junk, $tu) = split('following TinyURL which has a length of 25 characters:', $tu[0]);
$tu = strip_tags($tu);
$tu = str_replace('[', '', $tu);
$tu = trim($tu);
return $tu;
}

function bitly($url) {
/*
$url = str_replace('http://', '', $url);
$bl = tb_get($bl_url);
list($junk, $bl) = split('shortUrl', $bl);
$bl = split('"', $bl);
$bl = $bl[2];
return $bl;
*/
}

function snipurl($url) {
	$su = 'http://snipurl.com/site/snip?link='.$url;
	$su = tb_get($su);
	list($junk, $su) = split('cSnPre', $su);
	$su = split(' ', $su);
	$su = str_replace("('", '', $su[0]);
	return $su;
}
function twurl($url) {
	$twurl = 'http://tweetburner.com/links/create?url='.$url;
	$tw = tb_get($twurl);
	list($junk, $tw) = split('id="twurl"', $tw);
	$tw = split('span', $tw);
	$tw = $tw[0];
	$tw = str_replace('>', '', $tw);
	$tw = str_replace('</', '', $tw);
	return $tw;
}

function tb_get($file) {

}

function tb_get1($url)
{

   
}

// all the widget functions go in this function this is your main
function tweetsuite_widget_innit() { if ( !function_exists('register_sidebar_widget') ) return;
global $post, $wpdb;


function tweetsuite_favorites_control() {
	if($_POST['ts_favorite_max']) { update_option('ts_favorite_max', $_POST['ts_favorite_max']); }
	$max = get_option('ts_favorite_max');
	if(!$max) {$max=5; }
		
	?><p><label for='ts_favorite_max'>Display at most:  <input style="width: 100px;" type='text'  name='ts_favorite_max' id='ts_favorite_max' value='<?php echo $max; ?>' /></label> tweets.</p><?php
}

function tweetsuite_mine_control() {
	if($_POST['ts_mine_max']) { update_option('ts_mine_max', $_POST['ts_mine_max']); }
	$max = get_option('ts_mine_max');
	if(!$max) {$max=5; }
		
	?><p><label for='ts_mine_max'>Display at most:  <input style="width: 100px;" type='text'  name='ts_mine_max' id='ts_mine_max' value='<?php echo $max; ?>' /></label> tweets.</p><?php
}

function tweetsuite_favorites_widget($args)
{ 
	global $wpdb;
    extract($args);
	echo $before_widget;
	echo $before_title . 'My Favorite Tweets' . $after_title;
	
	$max = get_option('ts_favorite_max');
	if(!$max) {$max=5; }
	
	$table_name = $wpdb->prefix . "ts_favorites";
	$buff = $wpdb->get_results("SELECT * FROM $table_name order by datetime desc limit $max");
	
	foreach ($buff as $line) {
		$tweet = $line->tweet;
		$link = $line->link;
		$author = $line->author;
		$dt = date('m/d/y h:ia', $line->datetime);
		$output .="<li><a href='http://twitter.com/$author'>$author</a>: $tweet <a href='$link'>$dt</a></li>";
	}
	echo $output;
	echo $after_widget;
}

function tweetsuite_mine_widget($args)
{ 
	global $wpdb;
    extract($args);
	echo $before_widget;
	echo $before_title . 'My Tweets' . $after_title;
	
	$max = get_option('ts_mine_max');
	if(!$max) {$max=5; }
	
	$table_name = $wpdb->prefix . "ts_mine";
	$buff = $wpdb->get_results("SELECT * FROM $table_name order by datetime desc limit $max");
	
	foreach ($buff as $line) {
		$tweet = $line->tweet;
		$link = $line->link;
		$dt = date('m/d/y h:ia', $line->datetime);
		$output .="<li>$tweet <a href='$link'>$dt</a></li>";
	}
	echo $output;
	echo $after_widget;
}

function tweetsuite_recent_widget($args)
{ 
	global $wpdb;
    extract($args);
	echo $before_widget;
	echo $before_title . 'Recently Tweeted' . $after_title;
	
	$max = get_option('recent_tweeted_max');
	if(!$max) {$max=5; }
	
	$table_name = $wpdb->prefix . "tweetbacks";
	$buff = $wpdb->get_results("SELECT distinct postID FROM $table_name order by datetime desc limit $max");
	
	foreach ($buff as $line) {
		$post = get_post($line->postID); 
		$title = $post->post_title;
		$url = get_permalink($line->postID);		
		$output .="<li><a href='$url'>$title</a></li>";
	}
	echo $output;
	echo $after_widget;
}
function tweetsuite_recent_widget_control() {
	

	if($_POST['recent_tweeted_max']) { update_option('recent_tweeted_max', $_POST['recent_tweeted_max']); }
	$max = get_option('recent_tweeted_max');
	if(!$max) {$max=5; }
		
	?><p><label for='recent_tweeted_max'>Display at most:  <input style="width: 100px;" type='text'  name='recent_tweeted_max' id='recent_tweeted_max' value='<?php echo $max; ?>' /></label> posts.</p><?php
}


function tweetsuite_most_widget($args)
{ 
	global $wpdb;
    extract($args);
	echo $before_widget;
	echo $before_title . 'Most Tweeted' . $after_title;
	
	$max = get_option('most_tweeted_max');
	if(!$max) {$max=5; }
	
	$table_name = $wpdb->prefix . "shorturls";
	$buff = $wpdb->get_results("SELECT * FROM $table_name order by count desc limit $max");
	
	foreach ($buff as $line) {
		$count = $line->count;
		$post = get_post($line->postID); 
		$title = $post->post_title;
		$url = get_permalink($line->postID);		
		$output .="<li><a href='$url'>$title</a> ($count Tweets)</li>";
	}
	echo $output;
	echo $after_widget;
}
function tweetsuite_most_widget_control() {
	

	if($_POST['most_tweeted_max']) { update_option('most_tweeted_max', $_POST['most_tweeted_max']); }
	$max = get_option('most_tweeted_max');
	if(!$max) {$max=5; }
		
	?><p><label for='most_tweeted_max'>Display at most:  <input style="width: 100px;" type='text'  name='most_tweeted_max' id='most_tweeted_max' value='<?php echo $max; ?>' /></label> posts.</p><?php
}

register_widget_control(array('Recently Tweeted', 'widgets'), 'tweetsuite_recent_widget_control', 200, 150);
register_sidebar_widget(array('Recently Tweeted','widgets'), 'tweetsuite_recent_widget');

register_widget_control(array('Most Tweeted', 'widgets'), 'tweetsuite_most_widget_control', 200, 150);
register_sidebar_widget(array('Most Tweeted','widgets'), 'tweetsuite_most_widget');

register_widget_control(array('My Favorite Tweets', 'widgets'), 'tweetsuite_favorites_control', 200, 150);
register_sidebar_widget(array('My Favorite Tweets','widgets'), 'tweetsuite_favorites_widget');

register_widget_control(array('My Tweets', 'widgets'), 'tweetsuite_mine_control', 200, 150);
register_sidebar_widget(array('My Tweets','widgets'), 'tweetsuite_mine_widget');

}

function tweetsuite_send($msg) {
$username = get_option('tweetsuite_twitter_username');
$password = get_option('tweetsuite_twitter_password');
$prefix = urlencode(get_option('tweetsuite_prefix').' ');
$msg = $prefix.$msg;
if(($username) and ($password))  {
	$url = 'http://twitter.com/statuses/update.xml';
	$curl_handle = curl_init();
	curl_setopt($curl_handle, CURLOPT_URL, "$url");
	curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
	curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl_handle, CURLOPT_POST, 1);
	curl_setopt($curl_handle, CURLOPT_POSTFIELDS, "status=$msg");
	curl_setopt($curl_handle, CURLOPT_USERPWD, "$username:$password");
	$buffer = curl_exec($curl_handle);
	curl_close($curl_handle);
}

}


function parseTweets($type='tweets') {
	$user = get_option('tweetsuite_twitter_username');	
	if($type=='favorites') {$url = "http://twitter.com/favorites/$user.atom"; }
	else { $url = "http://twitter.com/statuses/user_timeline/$user.atom"; }
	//echo "parseTweet $url";
	//	print_r($return);	
	$data =tb_get($url);
$chunks = split('<entry>', $data);
array_shift($chunks);
foreach($chunks as $chunk) {	
	$lines = split("\n", $chunk);

	$author = split("\(", $lines[9]);
	$author = trim(str_replace('<name>', '', $author[0]));
	$tweet = trim(str_replace(array('<title>', '</title>', '<content type="html">', '</content>'), '', $lines[2]));	
	list($junk, $avatar) = split('href="', $lines[7]);
	$avatar = str_replace('"/>', '', $avatar);
	$dt = $lines[4];
	list($date, $time) = split('T', $dt);
	$time = str_replace('Z', '', $time);
	list($hour, $minute, $second) = split(':', $time);
	list($year, $month, $day) = split('-', $date);
	$year = trim(str_replace('<published>', '', $year));
	$dt = mktime($hour, $minute, $second, $month, $day, $year);	
	
	list($junk, $link) = split('href="', $lines[6]);
	$link = str_replace('"/>', '', $link);
	if($type=='tweets') {
		$ret['tweet'] = trim(str_replace($user.':', '', strip_tags(html_entity_decode($tweet))));
		$ret['author'] = $user;
	}
	else {
		$tws = split(': ', strip_tags(html_entity_decode($tweet)));
		$ret['author'] = array_shift($tws);
		$ret['tweet'] = join(': ', $tws);
	}
	$ret['link'] = $link;
	
	$ret['avatar'] = $avatar;
	$ret['dt'] = $dt;						
	$return[] = $ret;	
}			
return $return;
}


  $installed_ver = get_option( "tweetsuite_db_version" );
  if( $installed_ver != $ts_version ) {
 // echo "here";
   $table_name = $wpdb->prefix . "shorturls";
$sql = "CREATE TABLE ".$table_name." (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  postID int(11) NOT NULL,
  count int(11) NOT NULL,
  accessed int(11) NOT NULL,
  tweetthis varchar(255) NOT NULL,
  tinyurl varchar(255) NOT NULL,
  isgd varchar(150) NOT NULL,
  snipurl varchar(150) NOT NULL,
  trim varchar(150) NOT NULL,
  bitly varchar(255) NOT NULL,
  UNIQUE KEY id (id),
  UNIQUE KEY postID (postID)
  );";
//	echo $sql;
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
   	
	update_option( "tweetsuite_db_version", $ts_version );
   
   
   }

?>
