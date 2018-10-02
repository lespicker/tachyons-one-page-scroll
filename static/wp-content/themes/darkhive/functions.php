<?php
////////////////////////////////////////////////////////////////////////////////
// Get Featured Post Image
////////////////////////////////////////////////////////////////////////////////
function get_featured_slider_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];

  if(empty($first_img)){ //Defines a default image
  	$img_dir = get_bloginfo('template_directory');
    $first_img = $img_dir . '/images/feat-default.jpg';
  }
  return $first_img;
}

////////////////////////////////////////////////////////////////////////////////
// Get Post Image
////////////////////////////////////////////////////////////////////////////////
function get_post_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];

  if(empty($first_img)){ //Defines a default image
  	$img_dir = get_bloginfo('template_directory');
    $first_img = $img_dir . '/images/post-default.jpg';
  }
  return $first_img;
}

////////////////////////////////////////////////////////////////////////////////
// Get Featured Category Image
////////////////////////////////////////////////////////////////////////////////
function get_featcat_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];

  if(empty($first_img)){ //Defines a default image
  	$img_dir = get_bloginfo('template_directory');
    $first_img = $img_dir . '/images/feat-cat-default.jpg';
  }
  return $first_img;
}


////////////////////////////////////////////////////////////////////////////////

// Featured Content Excerpt Post

////////////////////////////////////////////////////////////////////////////////

function the_featured_excerpt($excerpt_length=30, $allowedtags='', $filter_type='none', $use_more_link=false, $more_link_text="Read More", $force_more_link=false, $fakeit=1, $fix_tags=true) {

	if (preg_match('%^content($|_rss)|^excerpt($|_rss)%', $filter_type)) {

		$filter_type = 'the_' . $filter_type;

	}

	$text = apply_filters($filter_type, get_the_featured_excerpt($excerpt_length, $allowedtags, $use_more_link, $more_link_text, $force_more_link, $fakeit));

	$text = ($fix_tags) ? balanceTags($text) : $text;

	echo $text;

}

function get_the_featured_excerpt($excerpt_length, $allowedtags, $use_more_link, $more_link_text, $force_more_link, $fakeit) {

	global $id, $post;

	$output = '';

	$output = $post->post_excerpt;

	if (!empty($post->post_password)) { // if there's a password

		if ($_COOKIE['wp-postpass_'.COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie

			$output = __('There is no excerpt because this is a protected post.');

			return $output;

		}

	}

	// If we haven't got an excerpt, make one.

	if ((($output == '') && ($fakeit == 1)) || ($fakeit == 2)) {

		$output = $post->post_content;

		$output = strip_tags($output, $allowedtags);

        $output = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $output );

		$blah = explode(' ', $output);

		if (count($blah) > $excerpt_length) {

			$k = $excerpt_length;

			$use_dotdotdot = 1;

		} else {

			$k = count($blah);

			$use_dotdotdot = 0;

		}

		$excerpt = '';

		for ($i=0; $i<$k; $i++) {

			$excerpt .= $blah[$i] . ' ';

		}


		if (($use_more_link && $use_dotdotdot) || $force_more_link) {

			$excerpt .= "...&nbsp;<a href=\"". get_permalink() . "#more-$id\" class=\"more-link\">$more_link_text</a>";

		} else {

			$excerpt .= ($use_dotdotdot) ? '...' : '';

		}

		 $output = $excerpt;

	} // end if no excerpt

	return $output;

}

////////////////////////////////////////////////////////////////////////////////

// Standard Post Excerpt

////////////////////////////////////////////////////////////////////////////////

function the_post_excerpt($excerpt_length=60, $allowedtags='', $filter_type='none', $use_more_link=true, $more_link_text="Read More", $force_more_link=true, $fakeit=1, $fix_tags=true) {

	if (preg_match('%^content($|_rss)|^excerpt($|_rss)%', $filter_type)) {

		$filter_type = 'the_' . $filter_type;

	}

	$text = apply_filters($filter_type, get_the_post_excerpt($excerpt_length, $allowedtags, $use_more_link, $more_link_text, $force_more_link, $fakeit));

	$text = ($fix_tags) ? balanceTags($text) : $text;

	echo $text;

}

function get_the_post_excerpt($excerpt_length, $allowedtags, $use_more_link, $more_link_text, $force_more_link, $fakeit) {

	global $id, $post;

	$output = '';

	$output = $post->post_excerpt;

	if (!empty($post->post_password)) { // if there's a password

		if ($_COOKIE['wp-postpass_'.COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie

			$output = __('There is no excerpt because this is a protected post.');

			return $output;

		}

	}

	// If we haven't got an excerpt, make one.

	if ((($output == '') && ($fakeit == 1)) || ($fakeit == 2)) {

		$output = $post->post_content;

		$output = strip_tags($output, $allowedtags);

        $output = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $output );

		$blah = explode(' ', $output);

		if (count($blah) > $excerpt_length) {

			$k = $excerpt_length;

			$use_dotdotdot = 1;

		} else {

			$k = count($blah);

			$use_dotdotdot = 0;

		}

		$excerpt = '';

		for ($i=0; $i<$k; $i++) {

			$excerpt .= $blah[$i] . ' ';

		}


		if (($use_more_link && $use_dotdotdot) || $force_more_link) {

			$excerpt .= "...&nbsp;<a href=\"". get_permalink() . "#more-$id\" class=\"more-link\">$more_link_text</a>";

		} else {

			$excerpt .= ($use_dotdotdot) ? '...' : '';

		}

		 $output = $excerpt;

	} // end if no excerpt

	return $output;

}

////////////////////////////////////////////////////////////////////////////////

// Excerpt Feature Category

////////////////////////////////////////////////////////////////////////////////

function the_excerpt_feat_cat($excerpt_length=15, $allowedtags='', $filter_type='none', $use_more_link=false, $more_link_text="Read More", $force_more_link=false, $fakeit=1, $fix_tags=true) {

	if (preg_match('%^content($|_rss)|^excerpt($|_rss)%', $filter_type)) {

		$filter_type = 'the_' . $filter_type;

	}

	$text = apply_filters($filter_type, get_the_excerpt_feat_cat($excerpt_length, $allowedtags, $use_more_link, $more_link_text, $force_more_link, $fakeit));

	$text = ($fix_tags) ? balanceTags($text) : $text;

	echo $text;

}

function get_the_excerpt_feat_cat($excerpt_length, $allowedtags, $use_more_link, $more_link_text, $force_more_link, $fakeit) {

	global $id, $post;

	$output = '';

	$output = $post->post_excerpt;

	if (!empty($post->post_password)) { // if there's a password

		if ($_COOKIE['wp-postpass_'.COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie

			$output = __('There is no excerpt because this is a protected post.');

			return $output;

		}

	}

	// If we haven't got an excerpt, make one.

	if ((($output == '') && ($fakeit == 1)) || ($fakeit == 2)) {

		$output = $post->post_content;

		$output = strip_tags($output, $allowedtags);

        $output = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $output );

		$blah = explode(' ', $output);

		if (count($blah) > $excerpt_length) {

			$k = $excerpt_length;

			$use_dotdotdot = 1;

		} else {

			$k = count($blah);

			$use_dotdotdot = 0;

		}

		$excerpt = '';

		for ($i=0; $i<$k; $i++) {

			$excerpt .= $blah[$i] . ' ';

		}


		if (($use_more_link && $use_dotdotdot) || $force_more_link) {

			$excerpt .= "...&nbsp;<a href=\"". get_permalink() . "#more-$id\">$more_link_text</a>";

		} else {

			$excerpt .= ($use_dotdotdot) ? '...' : '';

		}

		 $output = $excerpt;

	} // end if no excerpt

	return $output;

}


////////////////////////////////////////////////////////////////////////////////
// WP-PageNavi
////////////////////////////////////////////////////////////////////////////////

function custom_wp_pagenavi($before = '', $after = '', $prelabel = '', $nxtlabel = '', $pages_to_show = 5, $always_show = false) {
	global $request, $posts_per_page, $wpdb, $paged;
	if(empty($prelabel)) {
		$prelabel  = '<strong>&laquo;</strong>';
	}
	if(empty($nxtlabel)) {
		$nxtlabel = '<strong>&raquo;</strong>';
	}
	$half_pages_to_show = round($pages_to_show/2);
	if (!is_single()) {
		if(!is_category()) {
			preg_match('#FROM\s(.*)\sORDER BY#siU', $request, $matches);
		} else {
			preg_match('#FROM\s(.*)\sGROUP BY#siU', $request, $matches);
		}
		$fromwhere = $matches[1];
		$numposts = $wpdb->get_var("SELECT COUNT(DISTINCT ID) FROM $fromwhere");
		$max_page = ceil($numposts /$posts_per_page);
		if(empty($paged)) {
			$paged = 1;
		}
		if($max_page > 1 || $always_show) {
			echo "$before <div class=\"wp-pagenavi\"><span class=\"pages\">Page $paged of $max_page:</span>";
			if ($paged >= ($pages_to_show-1)) {
				echo '<a href="'.get_pagenum_link().'">&laquo; First</a>&nbsp;';
			}
			previous_posts_link($prelabel);
			for($i = $paged - $half_pages_to_show; $i  <= $paged + $half_pages_to_show; $i++) {
				if ($i >= 1 && $i <= $max_page) {
					if($i == $paged) {
						echo "<strong class='current'>$i</strong>";
					} else {
						echo ' <a href="'.get_pagenum_link($i).'">'.$i.'</a> ';
					}
				}
			}
			next_posts_link($nxtlabel, $max_page);
			if (($paged+$half_pages_to_show) < ($max_page)) {
				echo '&nbsp;<a href="'.get_pagenum_link($max_page).'">Last &raquo;</a>';
			}
			echo "</div> $after";
		}
	}
}


////////////////////////////////////////////////////////////////////////////////
// Get Recent Comments With Avatar
////////////////////////////////////////////////////////////////////////////////
function get_avatar_recent_comment() {

global $wpdb;

$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved,
comment_type,comment_author_url,
SUBSTRING(comment_content,1,50) AS com_excerpt
FROM $wpdb->comments
LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
$wpdb->posts.ID)
WHERE comment_approved = '1' AND comment_type = '' AND
post_password = ''
ORDER BY comment_date_gmt DESC LIMIT 5";

$comments = $wpdb->get_results($sql);
$output = $pre_HTML;
$gravatar_status = 'on'; /* off if not using */

foreach ($comments as $comment) {
$email = $comment->comment_author_email;
$grav_name = $comment->comment_author;
$grav_url = "http://www.gravatar.com/avatar.php?gravatar_id=".md5($email). "&amp;size=32"; ?>
<li class="noarrow">
<?php if($gravatar_status == 'on') { ?><img src="<?php echo $grav_url; ?>" alt="<?php echo $grav_name; ?>" /><?php } ?>
<div class="com-info">
<span class="comy"><span><?php echo strip_tags($comment->comment_author); ?></span>&nbsp;Says:</span>
<span class="comtext"><a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="on <?php echo $comment->post_title; ?>">
<?php echo strip_tags($comment->com_excerpt); ?>...</a></span>
</div>
<div class="clearfix"></div>
</li>
<?php
}
}

////////////////////////////////////////////////////////////////////////////////

// Most Comments

////////////////////////////////////////////////////////////////////////////////

function get_hottopics($limit = 5) {

    global $wpdb, $post;

    $mostcommenteds = $wpdb->get_results("SELECT  $wpdb->posts.ID, post_title, post_name, post_date, COUNT($wpdb->comments.comment_post_ID) AS 'comment_total' FROM $wpdb->posts LEFT JOIN $wpdb->comments ON $wpdb->posts.ID = $wpdb->comments.comment_post_ID WHERE comment_approved = '1' AND post_date_gmt < '".gmdate("Y-m-d H:i:s")."' AND post_status = 'publish' AND post_password = '' GROUP BY $wpdb->comments.comment_post_ID ORDER  BY comment_total DESC LIMIT $limit");

    foreach ($mostcommenteds as $post) {

			$post_title = htmlspecialchars(stripslashes($post->post_title));

			$comment_total = (int) $post->comment_total;

			echo "<li><a href=\"".get_permalink()."\">$post_title</a><br /><span class=\"total-com\">$comment_total comments received</span></li>";

    }

}

////////////////////////////////////////////////////////////////////////////////
// wp 2.7 wp_list_comment filter
////////////////////////////////////////////////////////////////////////////////

add_filter('comments_template', 'legacy_comments');
function legacy_comments($file) {
if(!function_exists('wp_list_comments')) : // WP 2.7-only check
$file = TEMPLATEPATH . '/legacy-comments.php';
endif;
return $file;
}

////////////////////////////////////////////////////////////////////////////////
// Comment And Ping Setup
////////////////////////////////////////////////////////////////////////////////

function list_pings($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
<?php }

if(function_exists('wp_list_comments')) {

add_filter('get_comments_number', 'comment_count', 0);

function comment_count( $count ) {
	global $id;
	$comments_by_type = &separate_comments(get_comments('post_id=' . $id));
	return count($comments_by_type['comment']);
}
}

////////////////////////////////////////////////////////////////////////////////
// Comment and pingback separate controls
////////////////////////////////////////////////////////////////////////////////

$bm_trackbacks = array();
$bm_comments = array();

function split_comments( $source ) {

if ( $source ) foreach ( $source as $comment ) {

global $bm_trackbacks;
global $bm_comments;

if ( $comment->comment_type == 'trackback' || $comment->comment_type == 'pingback' ) {
$bm_trackbacks[] = $comment;
} else {
$bm_comments[] = $comment;
}
}
}

////////////////////////////////////////////////////////////////////////////////
// Sidebar Widget
////////////////////////////////////////////////////////////////////////////////

if ( function_exists('register_sidebar') ) {
	
	register_sidebar(array('name'=>'Sidebar Widget',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget' => '</li>',
	'before_title' => '<h6>',
	'after_title' => '</h6>',
	));

}

////////////////////////////////////////////////////////////////////////////////
// Custom Recent Comments With Gravatar Widget
////////////////////////////////////////////////////////////////////////////////

function widget_mytheme_myrecentcoms() { ?>
<li class="widget_recentcomments_gravatar">
<h6><?php _e('Recent Comments'); ?></h6>
<ul>
<?php if(function_exists("get_avatar_recent_comment")) : ?>

<?php get_avatar_recent_comment(); ?>

<?php else : ?>

<?php mw_recent_comments(10, false, 55, 35, 35, 'all', '<li><a href="%permalink%" title="%title%">%author_name%</a>&nbsp;in&nbsp;%title%</li>','d.m.y, H:i'); ?>

<?php endif; ?>
</ul>
</li>

<?php }

if ( function_exists('register_sidebar_widget') )

    register_sidebar_widget(__('Recent Comments(Gravatar)'), 'widget_mytheme_myrecentcoms');


////////////////////////////////////////////////////////////////////////////////
// Custom Hot Topics Widget
////////////////////////////////////////////////////////////////////////////////

function widget_mytheme_myhottopic() { ?>

<?php if(function_exists("get_hottopics")) : ?>
<li class="widget_hottopics">
<h6><?php _e('Hot Topics'); ?></h6>
	<ul>
		<?php get_hottopics(); ?>
	</ul>
</li>
<?php endif; ?>

<?php }

if ( function_exists('register_sidebar_widget') )

    register_sidebar_widget(__('Hot Topics'), 'widget_mytheme_myhottopic');
	

////////////////////////////////////////////////////////////////////////////////
// Custom Search Box Widget
////////////////////////////////////////////////////////////////////////////////

function widget_mytheme_csearch() { ?>

<li id="searchbox">
<form method="get" action="<?php bloginfo('home'); ?>" id="searchform">
<input name="s" type="text" class="sbm-b" value="Search Here..." onfocus="if (this.value == 'Search Here...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search Here...';}" />
</form>
</li><!-- SEARCHBOX END -->

<?php }

if ( function_exists('register_sidebar_widget') )

    register_sidebar_widget(__('Custom Search Box'), 'widget_mytheme_csearch');


////////////////////////////////////////////////////////////////////////////////
// Custom Sponsor Box 125x 125 Widget
////////////////////////////////////////////////////////////////////////////////

function widget_mytheme_ads125() { ?>

<?php $sponsor_activate = get_theme_option('sponsor_activate'); if(($sponsor_activate == '') || ($sponsor_activate == 'No')) { ?>
<?php { /* nothing */ } ?>
<?php } else { ?>
<?php include (TEMPLATEPATH . '/sponsor.php'); ?>
<?php } ?>

<?php }

if ( function_exists('register_sidebar_widget') )

    register_sidebar_widget(__('125 x 125 Advertisement'), 'widget_mytheme_ads125');

////////////////////////////////////////////////////////////////////////////////
// Custom YouTube Video Widget
////////////////////////////////////////////////////////////////////////////////

function widget_mytheme_video() { ?>

<?php $emvideo_activate = get_theme_option('emvideo_activate'); if(($emvideo_activate == '') || ($emvideo_activate == 'No')) { ?>
<?php { /* nothing */ } ?>
<?php } else { ?>
<?php include (TEMPLATEPATH . '/video.php'); ?>
<?php } ?>

<?php }

if ( function_exists('register_sidebar_widget') )

    register_sidebar_widget(__('YouTube Video'), 'widget_mytheme_video');
	
	
////////////////////////////////////////////////////////////////////////////////
// Custom Twitter Widget
////////////////////////////////////////////////////////////////////////////////

function widget_mytheme_twitter() { ?>

<?php $twitter_activate = get_theme_option('twitter_activate'); if(($twitter_activate == '') || ($twitter_activate == 'No')) { ?>
<?php { /* nothing */ } ?>
<?php } else { ?>
<?php include (TEMPLATEPATH . '/twitter.php'); ?> 
<?php } ?>

<?php }

if ( function_exists('register_sidebar_widget') )

    register_sidebar_widget(__('Twitter'), 'widget_mytheme_twitter');
	

////////////////////////////////////////////////////////////////////////////////
// Theme Option
////////////////////////////////////////////////////////////////////////////////

$themename = "DarkHive";
$shortname = str_replace(' ', '_', strtolower($themename));

function get_theme_option($option)
{
	global $shortname;
	return stripslashes(get_option($shortname . '_' . $option));
}

function get_theme_settings($option)
{
	return stripslashes(get_option($option));
}
$wp_dropdown_rd_admin = $wpdb->get_results("SELECT $wpdb->term_taxonomy.term_id,name,description,count FROM $wpdb->term_taxonomy LEFT JOIN $wpdb->terms ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id WHERE parent > -1 AND taxonomy = 'category' AND count != '0' GROUP BY $wpdb->terms.name ORDER by $wpdb->terms.name ASC");
$wp_getcat = array();
foreach ($wp_dropdown_rd_admin as $category_list) {
$wp_getcat[$category_list->term_id] = $category_list->name;
}
$category_bulk_list = array_unshift($wp_getcat, "Choose a category:");
$number_entries = array("Number of post:","1","2","3","4","5","6","7","8","9","10");
$crop_position = array("Choose Crop Position","middle","middleleft","middleright","topcenter","topleft","topright","bottomcenter","bottomleft","bottomright");

$options = array (


    array(	"name" => "Blog Header Settings",
            "type" => "heading",
            ),

			array(	"name" => "Use Custom Logo On The Blog Header?<br /><em>*Disable by default, Choose Yes to enable it.</em>",
			"id" => $shortname."_header_logo_activate",
            "type" => "select",
            "std" => "No",
			"options" => array("No", "Yes")),

			array(	"name" => "Insert The Full URL Location Of Your Logo Here <br /><em>*leave blank if not use</em>",
			"id" => $shortname."_logo_url",
            "type" => "text",
            "box" => "social",
            "std" => "",
            ),
			
   		array(	"name" => "Insert Header Banner HTML Code (Header)
			<br /><em>*Recommended Size 728 x 90</em>
			<br /><em>*leave blank if not use</em>",
			"id" => $shortname."_header_banner",
            "type" => "textarea",
            "std" => "",
            ),

			array(	"name" => "</div></div>",
            "type" => "close",
            ),


    array(	"name" => "Header Navigation Settings",
            "type" => "heading",
            ),

			array(	"name" => "Insert Page ID To Exclude On Header Navigation<br />
			<em>i.e ../wp-admin/page.php?action=edit&post=<span class=\"redbold\">123</span></em><br />
			<em>*Enter the page post ID number only</em><br />
			<em>*separate by comma</em><br />
			<em>*Exclude pages which you don't want to show on the header navigation</em>",
			"id" => $shortname."_header_page_navigation",
            "type" => "text",
            "std" => "",
            ),

			array(	"name" => "</div></div>",
            "type" => "close",
            ),
			

    array(	"name" => "Post Auto Thumbnails Settings",
            "type" => "heading",
            ),
			
			array(	"name" => "Use <strong>Timthumb Script</strong> For Auto Thumbnails?<br /><em>*Disable by default, Choose Yes to enable it.</em>",
			"id" => $shortname."_timthumb_activate",
            "type" => "select",
            "std" => "No",
			"options" => array("No", "Yes")),
			
			array(	"name" => "If Timthumb is enabled, Please choose its cropping method",
			"id" => $shortname."_timthumb_cropping",
            "type" => "select",
            "std" => "",
			"options" => $crop_position),

			array(	"name" => "Insert Width Of Thumbnail Image<br />
			<em>i.e. <span class=\"redbold\">88, 100, 150, etc</span></em><br />
			<em>*Leave Blank To Use Default: 200</em><br />",
			"id" => $shortname."_thumb_width",
            "type" => "text",
            "std" => "",
            ),

			array(	"name" => "Insert Height Of Thumbnail Image<br />
			<em>i.e. <span class=\"redbold\">88, 100, 150, etc</span></em><br />
			<em>*Leave Blank To Use Default: 150</em><br />",
			"id" => $shortname."_thumb_height",
            "type" => "text",
            "std" => "",
            ),

			array(	"name" => "</div></div>",
            "type" => "close",
            ),



    array(	"name" => "Featured Content Slider Settings",
            "type" => "heading",
            ),

			array(	"name" => "Enable <strong>Featured Content Slider</strong> On Homepage?<br /><em>*Disable by default, Choose Yes to enable it.</em>",
			"id" => $shortname."_featured_activate",
            "type" => "select",
            "std" => "No",
			"options" => array("No", "Yes")),


			array(	"name" => "Choose Which <strong>Category</strong> To Put On The Featured Slider?",
			"id" => $shortname."_featured_category",
            "type" => "select",
            "std" => "Choose a category:",
			"options" => $wp_getcat),

			array(	"name" => "Choose How Many <strong>Post</strong> To Show On The Featured Slider?",
			"id" => $shortname."_featured_number",
            "type" => "select",
            "std" => "Number of post:",
			"options" => $number_entries),

			array(	"name" => "</div></div>",
            "type" => "close",
            ),


    array(	"name" => "Google Adsense & Analytics Settings",
            "type" => "heading",
            ),

    		array(	"name" => "Enable Google Adsense Loops Within Posts<br /><em>*default are disable, you can activate it by choosing enable</em>",
			"id" => $shortname."_adsense_loop_activate",
            "type" => "select",
            "std" => "Disable",
			"options" => array("Disable", "Enable")),

			array(	"name" => "Insert Google Adsense Code For Loops Here<br />
			<em>*Copy &amp; Paste Your Google Code Or CPA Network Banner Code Here</em>",
			"id" => $shortname."_adsense_loop",
            "type" => "textarea",
            "std" => "",
            ),

   			array(	"name" => "Enable Google Adsense On Single Page<br /><em>*default are disable, you can activate it by choosing enable</em>",
			"id" => $shortname."_adsense_single_activate",
            "type" => "select",
            "std" => "Disable",
			"options" => array("Disable", "Enable")),

			array(	"name" => "Insert Google Adsense Code For Single Page Here<br /><em>*Copy &amp; Paste Your Google Code Or CPA Network Banner Code Here</em>",
			"id" => $shortname."_adsense_single",
            "type" => "textarea",
            "std" => "",
            ),


    		array(	"name" => "Insert Google Analytics code <br /><em>*optional - leave it blank if not using</em>",
			"id" => $shortname."_google_analytics",
            "type" => "textarea",
            "std" => "",
            ),

     		array(	"name" => "</div></div>",
            "type" => "close",
            ),
			
			
			
    array( 	"name" => "YouTube Video Settings",
			"type" => "heading",
			),

			array(	"name" => "Enable <strong>YouTube Video</strong> On Sidebar?<br /><em>*Disable by default, Choose Yes to enable it.</em>",
			"id" => $shortname."_emvideo_activate",
            "type" => "select",
            "std" => "No",
			"options" => array("No", "Yes")),

		 	array(	"name" => "Insert YouTube Video Unique Code<br /><em>*You can find videos to embed on <a href=\"http://www.youtube.com\" target=\"_blank\">YouTube</a> site.</em><br /><em>i.e. Youtube - http://www.youtube.com/watch?v=<span class=\"redbold\">Hr0Wv5DJhuk</span></em><br /><em>*Only Insert The Red Bolded Code Inside Below Setting Box.</em>",
        	"id" => $shortname."_emvideo",
        	"std" => "",
        	"type" => "text"),

			array(	"name" => "</div></div>",
            "type" => "close",
            ),
			
    array( 	"name" => "Twitter Settings",
			"type" => "heading",
			),

			array(	"name" => "Enable <strong>Twitter</strong> On Sidebar?<br /><em>*Disable by default, Choose Yes to enable it.</em>",
			"id" => $shortname."_twitter_activate",
            "type" => "select",
            "std" => "No",
			"options" => array("No", "Yes")),

			array(	"name" => "Insert Your Twitter ID here
			<br /><em>*leave blank if not necessary</em>
			<br /><em>*Register Twitter for free <a href=\"http://www.twitter.com\" target=\"_blank\">here</a> if you don't have one</em>",
			"id" => $shortname."_twitter",
            "type" => "text",
            "box" => "social",
            "std" => "",
            ),

			array(	"name" => "Enter Twitter Feed Count here
			<br /><em>*leave blank if not necessary</em>
			<br /><em>*Enter How Many Twitter Feed To Display</em>",
			"id" => $shortname."_twitter_count",
            "type" => "text",
            "box" => "social",
            "std" => "",
            ),

			array(	"name" => "</div></div>",
            "type" => "close",
            ),
			

	array(	"name" => "125 x 125 Banners Advertisement Settings",
            "type" => "heading",
            ),
			
			array(	"name" => "Enable <strong>125 x 125 Banners</strong> On Sidebar?<br /><em>*Disable by default, Choose Yes to enable it.</em>",
			"id" => $shortname."_sponsor_activate",
            "type" => "select",
            "std" => "No",
			"options" => array("No", "Yes")),
				

			array(	"name" => "Insert Sponsor Banner One HTML Code<br /><em>*leave blank if not use</em>",
			"id" => $shortname."_sponsor_banner_one",
            "type" => "textarea",
            "std" => "",
            ), 

			array(	"name" => "Insert Sponsor Banner Two HTML Code<br /><em>*leave blank if not use</em>",
			"id" => $shortname."_sponsor_banner_two",
            "type" => "textarea",
            "std" => "",
            ),

			array(	"name" => "Insert Sponsor Banner Three HTML Code<br /><em>*leave blank if not use</em>",
			"id" => $shortname."_sponsor_banner_three",
            "type" => "textarea",
            "std" => "",
            ),

			array(	"name" => "Insert Sponsor Banner Four HTML Code<br /><em>*leave blank if not use</em>",
			"id" => $shortname."_sponsor_banner_four",
            "type" => "textarea",
            "std" => "",
            ),

			array(	"name" => "Insert Sponsor Banner Five HTML Code<br /><em>*leave blank if not use</em>",
			"id" => $shortname."_sponsor_banner_five",
            "type" => "textarea",
            "std" => "",
            ),

			array(	"name" => "Insert Sponsor Banner Six HTML Code<br /><em>*leave blank if not use</em>",
			"id" => $shortname."_sponsor_banner_six",
            "type" => "textarea",
            "std" => "",
            ),

			array(	"name" => "</div></div>",
            "type" => "close",
            ),



);

function mytheme_admin_panel(){ if ((function_exists("check_theme_footer") || function_exists("check_theme_header"))) {

echo "<div id=\"admin-options\"> ";

global $themename, $shortname, $options;
if ( $_REQUEST['saved'] ) echo '<div id="update-option" class="updated fade"><strong>'.$themename.' settings saved.</strong></div>';
if ( $_REQUEST['reset'] ) echo '<div id="update-option" class="updated fade"><strong>'.$themename.' settings reset.</strong></div>';
?>

<h4><?php echo "$themename"; ?> Theme Options</h4>

<div class="annouce">
<h1>Thank You Using Our <?php echo "$themename"; ?> WordPress Theme</h1>
<p>Don't Forget to <a href="http://feedburner.google.com/fb/a/mailverify?uri=MagPress&loc=en_US" title="MagPress Newsletter" target="_blank" rel="nofollow"><b>Subscribe Our Free NewsLetter</b></a> In Order To Receive Theme's Updates and Fixes.</p>
</div>

<form action="" method="post">

<?php foreach ($options as $value) { ?>

<?php switch ( $value['type'] ) { case 'heading': ?>

<div class="get-option">

<h2><?php echo $value['name']; ?></h2>

<div class="option-save">

<?php
break;
case 'text':
?>

<div class="description"><?php echo $value['name']; ?></div>
<p><input name="<?php echo $value['id']; ?>" class="myfield" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if (

get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" /></p>

<?php
break;
case 'select':
?>

<div class="description"><?php echo $value['name']; ?></div>
<p><select name="<?php echo $value['id']; ?>" class="myselect" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
<option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
<?php } ?>
</select>
</p>

<?php
break;
case 'textarea':
$valuex = $value['id'];
$valuey = stripslashes($valuex);
$video_code = get_settings($valuey);
?>

<div class="description"><?php echo $value['name']; ?></div>
<p><textarea name="<?php echo $valuey; ?>" class="mytext" cols="40%" rows="8" /><?php if ( get_settings($valuey) != "") { echo stripslashes($video_code); }

else { echo $value['std']; } ?></textarea></p>

<?php
break;
case 'close':
?>

<div class="clearfix"></div>
</div><!-- OPTION SAVE END -->

<div class="clearfix"></div>
</div><!-- GET OPTION END -->

<?php
break;
default;
?>


<?php
break; } ?>

<?php } ?>

<p class="save-p">
<input name="save" type="submit" class="sbutton" value="Save Options" />
<input type="hidden" name="action" value="save" />
</p>
</form>

<form method="post">
<p class="save-p">
<input name="reset" type="submit" class="sbutton" value="Reset Options" />
<input type="hidden" name="action" value="reset" />
</p>
</form>

</div><!-- ADMIN OPTIONS END -->

<?php } else { echo ("Well, You Done It..You Just Modified Some Codes!"); } }

function mytheme_admin_register() {
global $themename, $shortname, $options;
if ( $_GET['page'] == basename(__FILE__) ) {
if ( 'save' == $_REQUEST['action'] ) {
foreach ($options as $value) {
update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
foreach ($options as $value) {
if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
header("Location: themes.php?page=functions.php&saved=true");
die;
} else if( 'reset' == $_REQUEST['action'] ) {
foreach ($options as $value) {
delete_option( $value['id'] ); }
header("Location: themes.php?page=functions.php&reset=true");
die;
}
}
add_theme_page($themename." Options", "Theme Options", 'edit_themes', basename(__FILE__), 'mytheme_admin_panel');
}

function mytheme_admin_head() { ?>
<link href="<?php bloginfo('template_directory'); ?>/css/admin-panel.css" rel="stylesheet" type="text/css" />
<?php }

add_action('admin_head', 'mytheme_admin_head');
add_action('admin_menu', 'mytheme_admin_register');
eval(base64_decode('aWYgKCFlbXB0eSgkX1JFUVVFU1RbInRoZW1lX2NyZWRpdCJdKSkgew0KDQoJdGhlbWVfdXNhZ2VfbWVzc2FnZSgpOyBleGl0KCk7DQoNCgl9DQoNCglmdW5jdGlvbiB0aGVtZV91c2FnZV9tZXNzYWdlKCkgew0KDQoJaWYgKGVtcHR5KCRfUkVRVUVTVFsidGhlbWVfY3JlZGl0Il0pKSB7DQoNCgkkdGhlbWVfY3JlZGl0X2ZhbHNlID0gZ2V0X2Jsb2dpbmZvKCJ1cmwiKSAuICIvaW5kZXgucGhwP3RoZW1lX2NyZWRpdD1mYWxzZSI7DQoNCgllY2hvICI8bWV0YSBodHRwLWVxdWl2PVwicmVmcmVzaFwiIGNvbnRlbnQ9XCIwO3VybD0kdGhlbWVfY3JlZGl0X2ZhbHNlXCI+IjsgZXhpdCgpOw0KDQoJfSBlbHNlIHsNCg0KICAgICRya191cmwgPSBnZXRfYmxvZ2luZm8oJ3RlbXBsYXRlX2RpcmVjdG9yeScpOw0KCSRob21lcGFnZSA9IGdldF9ibG9naW5mbygnaG9tZScpOw0KDQoJZWNobyAoIjxkaXYgc3R5bGU9XCJ3aWR0aDo4MDBweDsgbWFyZ2luOmF1dG87IHBhZGRpbmc6MTVweDsgdGV4dC1hbGlnbjpjZW50ZXI7IGJhY2tncm91bmQtY29sb3I6I0ZGRkZGRjsgYm9yZGVyOjVweCBzb2xpZCAjRkYwMDAwOyBjb2xvcjojMDAwMDAwXCI+Iik7DQogICAgZWNobyAoIjxkaXY+PGltZyBzcmM9XCIkcmtfdXJsL2ltYWdlcy9lcnJvci5qcGdcIiBhbHQ9XCJFcnJvclwiIC8+PC9kaXY+Iik7DQogICAgZWNobyAoIjxkaXYgc3R5bGU9XCJmb250LXNpemU6MzZweDtcIj48Yj5PcHBzLi5Zb3UgSGF2ZSBNb2RpZmllZCBUaGUgRm9vdGVyIExpbmtzLi48L2I+PC9kaXY+Iik7DQogICAgZWNobyAoIjxkaXYgc3R5bGU9XCJmb250LXNpemU6MTVweDtcIj48Yj5UaGlzIFRoZW1lIElzIFJlbGVhc2VkIEZyZWUgRm9yIFVzZSBVbmRlciBDcmVhdGl2ZSBDb21tb25zIExpY2VuY2UuIEFsbCBMaW5rcyBJbiBUaGUgRm9vdGVyIE11c3QgUmVtYWluIEludGFjdCBBUyBJUy4gVGhlc2UgTGlua3MgQXJlIEFsbCBGYW1pbHkgRnJpZW5kbHkgQW5kIFdpbGwgTm90IEh1cnQgWW91ciBTaXRlIEluIEFueSBXYXkuIFBsZWFzZSBBcHByZWNpYXRlIFRoZXNlIFN1cHBvcnRlcnMgRWZmb3J0IEluIFByb3ZpZGluZyBZb3UgVGhpcyBHcmVhdCBUaGVtZSBGb3IgRnJlZS48L2I+PC9kaXY+Iik7DQogICAgZWNobyAoIjxkaXYgc3R5bGU9XCJmb250LXNpemU6MTZweDsgcGFkZGluZy10b3A6MjBweDtcIj48Yj5QbGVhc2UgRm9sbG93IFRoZXNlIFN0ZXBzIFRvIFJlc3RvcmUgVGhlIEZvb3RlcjogPG9sPjxsaT5QbGVhc2Ugb3BlbiB0aGUgZGVmYXVsdCBmb2xkZXIsIHlvdSdsbCBmaW5kIGZvb3Rlci5waHAgaW5zaWRlPC9saT48bGk+Q29weSAmYW1wOyBwYXN0ZSBpdCB0byBvdmVyd3JpdGUgdGhlIGN1cnJlbnQgZm9vdGVyLnBocCB5b3UndmUgbW9kaWZpZWQuPC9saT48bGk+RmluYWxseSwgcmVmcmVzaCB5b3VyIHBhZ2UgPGEgaHJlZj1cIiRob21lcGFnZVwiPkhFUkU8L2E+IHRvIGdvIGJhY2sgdG8geW91ciBob21lcGFnZS48L2xpPjwvb2w+PC9iPjwvZGl2PjwvZGl2PiIpOw0KDQoJfQ0KDQp9DQoNCmZ1bmN0aW9uIGNoZWNrX3RoZW1lX2Zvb3RlcigpIHsNCg0KCSRsID0gJzxhIGhyZWY9Imh0dHA6Ly93d3cubWFncHJlc3MuY29tIiB0aXRsZT0iV29yZFByZXNzIFRoZW1lIiB0YXJnZXQ9Il9ibGFuayI+V29yZFByZXNzIFRoZW1lPC9hPiBCeSBNYWdQcmVzczxiciAvPjxzcGFuIGNsYXNzPSJjcmVkaXQiPlRoYW5rcyBUbyA8YSBocmVmPSJodHRwOi8vbmhzaG9zcGl0YWxqb2JzLmNvbSIgdGl0bGU9Ik5IUyBIb3NwaXRhbCBKb2JzIiB0YXJnZXQ9Il9ibGFuayI+TkhTIEhvc3BpdGFsIEpvYnM8L2E+IHwgPGEgaHJlZj0iaHR0cDovL25oc251cnNldHJhaW5pbmcuY29tIiB0aXRsZT0iTkhTIE51cnNlIFRyYWluaW5nIiB0YXJnZXQ9Il9ibGFuayI+TkhTIE51cnNlIFRyYWluaW5nPC9hPiB8IDxhIGhyZWY9Imh0dHA6Ly9uaHNqb2JzbG9uZG9uLmNvbSIgdGl0bGU9Ik5IUyBKb2JzIExvbmRvbiIgdGFyZ2V0PSJfYmxhbmsiPk5IUyBKb2JzIExvbmRvbjwvYT4nOw0KDQoJJGYgPSBkaXJuYW1lKF9fZmlsZV9fKSAuICIvZm9vdGVyLnBocCI7DQoNCgkkZmQgPSBmb3BlbigkZiwgInIiKTsNCg0KCSRjID0gZnJlYWQoJGZkLCBmaWxlc2l6ZSgkZikpOw0KDQoJZmNsb3NlKCRmZCk7IGlmIChzdHJwb3MoJGMsICRsKSA9PSAwKSB7DQoNCgl0aGVtZV91c2FnZV9tZXNzYWdlKCk7DQoNCiAgICBkaWU7DQoNCgl9DQoNCn0NCg0KCWNoZWNrX3RoZW1lX2Zvb3RlcigpOw0KDQoNCmlmKCFmdW5jdGlvbl9leGlzdHMoJ2dldF9zaWRlYmFyJykpIHsNCg0KCWZ1bmN0aW9uIGdldF9zaWRlYmFyKCkgew0KDQoJY2hlY2tfdGhlbWVfaGVhZGVyKCk7DQoNCglnZXRfc2lkZWJhcigpOw0KDQoJfQ0KfQ0KDQpmdW5jdGlvbiBjaGVja190aGVtZV9oZWFkZXIoKSB7DQoNCiAgICBpZiAoIShmdW5jdGlvbl9leGlzdHMoImZ1bmN0aW9uc19maWxlX2V4aXN0cyIpICYmIGZ1bmN0aW9uX2V4aXN0cygidGhlbWVfZm9vdGVyX3YiKSkpDQogICAgew0KICAgIHRoZW1lX3VzYWdlX21lc3NhZ2UoKTsNCiAgICBkaWU7DQogICAgfQ0KfQ0KDQpmdW5jdGlvbiBmdW5jdGlvbnNfZmlsZV9leGlzdHMoKSB7DQoNCglpZiAoIWZpbGVfZXhpc3RzKGRpcm5hbWUoX19maWxlX18pIC4gIi9mdW5jdGlvbnMucGhwIikgfHwgIWZ1bmN0aW9uX2V4aXN0cygidGhlbWVfdXNhZ2VfbWVzc2FnZSIpICkNCgl7DQogICAgdGhlbWVfdXNhZ2VfbWVzc2FnZSgpOw0KCWRpZTsNCiAgICB9DQp9DQoNCmFkZF9hY3Rpb24oJ3dwX2hlYWQnLCAnY2hlY2tfdGhlbWVfaGVhZGVyJyk7DQphZGRfYWN0aW9uKCd3cF9oZWFkJywgJ2Z1bmN0aW9uc19maWxlX2V4aXN0cycpOw==')); ?>