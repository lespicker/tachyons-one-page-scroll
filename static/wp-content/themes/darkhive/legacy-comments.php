<?php // Do not delete these lines
if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');
if (!empty($post->post_password)) { // if there's a password
if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
?>
<h2><?php _e("This post is password protected. Enter the password to view comments."); ?></h2>
<?php
return;
}
}

/* This variable is for alternating comment background */
$oddcomment = '-alt';


?>


<div id="commentpost">

<?php
global $bm_comments;
global $bm_trackbacks;
split_comments( $comments );
?>

<?php if ( $comments ) : ?>

<?php
$trackbackcounter = count( $bm_trackbacks );
$commentcounter = count( $bm_comments );
?>

<?php if ('open' == $post->comment_status) { ?>
<h4 id="comments"><?php comments_number('No Responses', 'One Response', '% Responses' );?> to <span>&#8220;<?php the_title(); ?>&#8221;</span></h4>
<?php } else { ?>
<h4 id="comments">Comments and support for this post had been deactivated</h4>
<?php } ?>

<div id="commentlist">

<?php foreach ($bm_comments as $comment) : ?>

<div class="usercom<?php echo $oddcomment; ?>" id="comment-<?php comment_ID() ?>">
<div class="useravatar">
<?php if(function_exists("get_avatar")) { ?>
<?php echo get_avatar( $comment, 48 ); ?>
<?php } else if(function_exists("MyAvatars")) { ?>
<?php MyAvatars(); ?>
<?php } else { ?>
<a href="#"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/avatar.gif" alt="mygif"/></a>
<?php } ?>
</div>
<div class="usercomment">
<div class="user-n"><?php comment_author_link(); ?> <?php comment_date('F jS, Y') ?> at <a href="#comment-<?php comment_ID() ?>"><?php comment_time() ?></a>&nbsp;&nbsp;&nbsp;&nbsp;<?php edit_comment_link('edit','',''); ?></div>
<div class="user-t">
<?php if ($comment->comment_approved == '0') : ?>
<strong>Your Comment Is Under Moderation </strong>
<?php else: ?>
<?php comment_text(); ?>
<?php endif; ?>
</div>
</div>
<div class="clearfix"></div>
</div>

<?php if ('-alt' == $oddcomment) $oddcomment = ''; else $oddcomment = '-alt'; ?>
<?php endforeach; ?>

</div><!-- COMMENTLIST END -->

<?php if ( count( $bm_trackbacks ) > 0 ) { ?>

<h4 id="pings">Trackbacks/Pingbacks</h4>

<ul id="linking">

<?php foreach ($bm_trackbacks as $comment) : ?>

<li><?php comment_author_link(); ?></li>

<?php if ('-alt' == $oddcomment) $oddcomment = ''; else $oddcomment = '-alt'; ?>
<?php endforeach; ?>

<div class="clearfix"></div>
</ul>

<?php } ?>

<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>

<?php if (get_option('comment_registration') && !$user_ID) : ?>

<label>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</label>

<?php else : ?>

<h4>Leave Your Feedback</h4>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="cf">

<?php if (!$user_ID) : ?>
<label>Username</label>
<p><input name="author" type="text" class="tf" value="<?php echo $comment_author; ?>"/></p>

<label>Email Address</label>
<p><input name="email" type="text" class="tf" value="<?php echo $comment_author_email; ?>"/></p>

<label>Website</label>
<p><input name="url" type="text" class="tf" value="<?php echo $comment_author_url; ?>"/></p>
<?php endif; ?>


<?php if ( $user_ID ) : ?>
<label>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Logout &raquo;</a></label>
<?php else : ?>
<label>comments</label>
<?php endif; ?>

<p><textarea name="comment" id="comment" cols="50%" rows="8" class="af"></textarea></p>

<p><input name="sbm" type="submit" value="Submit My Comment" class="tinput"/><input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /> </p>

<p><?php do_action('comment_form', $post->ID); ?></p>

</form>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>

</div>