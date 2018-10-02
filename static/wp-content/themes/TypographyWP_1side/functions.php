<?php
include(TEMPLATEPATH.'/includes/controlpanel/controlpanel.php');
$cpanel = new Panel();

if ( function_exists('register_sidebar') )
     register_sidebar(array(
	    'name' => 'Sidebar 300px right',
	    'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
if ( function_exists('register_sidebar') )
     register_sidebar(array(
	    'name' => 'Sidebar 160px right',
	    'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
if ( function_exists('register_sidebar') )
     register_sidebar(array(
	    'name' => 'Footer SPOT1',
	    'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
if ( function_exists('register_sidebar') )
     register_sidebar(array(
	    'name' => 'Footer SPOT2',
	    'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
if (function_exists('mdv_recent_comments')) { 
}else{



function mdv_recent_comments($no_comments = 5, $comment_lenth = 10, $before = '<li class="com">', $after = '</li>', $show_pass_post = false, $comment_style = 0) {
	    global $wpdb;
	    $request = "SELECT ID, comment_ID, comment_content, comment_author, comment_author_url, post_title FROM $wpdb->comments LEFT JOIN $wpdb->posts ON $wpdb->posts.ID=$wpdb->comments.comment_post_ID WHERE post_status IN ('publish','static') ";
		if(!$show_pass_post) $request .= "AND post_password ='' ";
		$request .= "AND comment_approved = '1' ORDER BY comment_ID DESC LIMIT $no_comments";
		$comments = $wpdb->get_results($request);
	    $output = '';
		if ($comments) {
			foreach ($comments as $comment) {
				$comment_author = stripslashes($comment->comment_author);
				if ($comment_author == "")
					$comment_author = "anonymous"; 
				$comment_content = strip_tags($comment->comment_content);
				$comment_content = stripslashes($comment_content);
				$words=split(" ",$comment_content); 
				$comment_excerpt = join(" ",array_slice($words,0,$comment_lenth));
				$permalink = get_permalink($comment->ID)."#comment-".$comment->comment_ID;
	
				if ($comment_style == 1) {
					$post_title = stripslashes($comment->post_title);
					
					$url = $comment->comment_author_url;
	
					if (empty($url))
						$output .= $before . $comment_author . ' on ' . $post_title . '.' . $after;
					else
						$output .= $before . "<a href='$url' rel='nofollow'>$comment_author</a>" . ' on ' . $post_title . '.' . $after;
				}
				else {
					$output .= $before . '' . $comment_author . ':  <a href="' . $permalink;
					$output .= '" title="View the entire comment by ' . $comment_author.'">' . $comment_excerpt.'</a>' . $after;
				}
			}
			$output = convert_smilies($output);
		} else {
			$output .= $before . "None found" . $after;
		}
	    echo $output;
	}
}

function mdv_recent_posts($no_posts = 15, $before = '<li>', $after = '</li>', $hide_pass_post = true, $skip_posts = 0, $show_excerpts = false) { 
    global $wpdb; 
        $time_difference = get_settings('gmt_offset'); 
        $now = gmdate("Y-m-d H:i:s",time()); 
    $request = "SELECT ID, post_title, post_excerpt FROM $wpdb->posts WHERE post_status = 'publish' "; 
        if($hide_pass_post) $request .= "AND post_password ='' "; 
        $request .= "AND post_date_gmt < '$now' ORDER BY post_date DESC LIMIT $skip_posts, $no_posts"; 
    $posts = $wpdb->get_results($request); 
        $output = ''; 
    if($posts) { 
                foreach ($posts as $post) { 
                        $post_title = stripslashes($post->post_title);
                        $permalink = get_permalink($post->ID); 
                        $output .= $before . '<a href="' . $permalink . '" rel="bookmark" title="Permanent Link: ' . htmlspecialchars($post_title, ENT_COMPAT) . '">' . htmlspecialchars($post_title) . '</a>'; 
                        if($show_excerpts) { 
                                $post_excerpt = stripslashes($post->post_excerpt); 
                                $output.= '<br />' . $post_excerpt; 
                        } 
                        $output .= $after; 
                } 
        } else { 
                $output .= $before . "None found" . $after; 
        } 
    echo $output; 
} 


function most_commented($no_posts = 10, $before = '<li class="mostcom">', $after = '</li>', $show_pass_post = false) { 
    global $wpdb; 
        $request = "SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS 'comment_count' FROM $wpdb->posts, $wpdb->comments"; 
        $request .= " WHERE comment_approved = '1' AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish'"; 
        if(!$show_pass_post) $request .= " AND post_password =''"; 
        $request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts"; 
    $posts = $wpdb->get_results($request); 
    $output = ''; 
        if ($posts) { 
                foreach ($posts as $post) { 
                        $post_title = stripslashes($post->post_title); 
                        $comment_count = $post->comment_count; 
                        $permalink = get_permalink($post->ID); 
                        $output .= $before . '<a href="' . $permalink . '" title="' . $post_title.'">' . $post_title . '</a> (' . $comment_count.')' . $after; 
                } 
        } else { 
                $output .= $before . "None found" . $after; 
        } 
    echo $output; 
} 

function recent_comments($no_comments = 5, $comment_len = 100) { 
    global $wpdb; 
	
	$request = "SELECT * FROM $wpdb->comments";
	$request .= " JOIN $wpdb->posts ON ID = comment_post_ID";
	$request .= " WHERE comment_approved = '1' AND post_status = 'publish' AND post_password =''"; 
	$request .= " ORDER BY comment_date DESC LIMIT $no_comments"; 
		
	$comments = $wpdb->get_results($request);
		
	if ($comments) { 
		foreach ($comments as $comment) { 
			ob_start();
			?>
				<li class="com">
					<a href="<?php echo get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment->comment_ID; ?>"><?php echo get_author($comment); ?>:</a>
					<?php echo strip_tags(substr(apply_filters('get_comment_text', $comment->comment_content), 0, $comment_len)); ?>
				</li>
			<?php
			ob_end_flush();
		} 
	} else { 
		echo "<li>No comments</li>";
	}
}


function commentstemplate($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
      <div class="comment-author vcard">
         <?php echo get_avatar($comment,$size='30',$default='<path_to_url>' ); ?>

         <?php printf(__('<span class="says">%s</span>'), get_comment_author_link()) ?>
         <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></div>
      </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('<small class="moder">Your comment is awaiting moderation.</small>') ?></em>
         <br />
      <?php endif; ?>
      <div class="comtext">
      <?php comment_text() ?>
      </div>
      <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>  
     </div>
<?php
        }
?>
