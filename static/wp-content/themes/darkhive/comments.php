<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->
<div id="commentpost">

<?php if ( have_comments() ) : ?>
<?php if ( ! empty($comments_by_type['comment']) ) : ?>
<h4 id="comments"><?php comments_number('No Responses', 'One Response', '% Responses' );?> to <span>&#8220;<?php the_title(); ?>&#8221;</span></h4>

<div class="pnav">
<div class="alignleft"><?php previous_comments_link(); ?></div>
<div class="alignright"><?php next_comments_link(); ?></div>
<div class="clearfix"></div>
</div>

<ol class="commentlist">
<?php wp_list_comments('type=comment'); ?>
</ol>

<div class="pnav">
<div class="alignleft"><?php previous_comments_link(); ?></div>
<div class="alignright"><?php next_comments_link(); ?></div>
<div class="clearfix"></div>
</div>

<?php endif; ?>

<?php if ( ! empty($comments_by_type['pings']) ) : ?>
<div id="pingbox">
<h4 id="pings">Trackbacks/Pingbacks</h4>
<ol class="pinglist">
<?php wp_list_comments('type=pings&callback=list_pings'); ?>
</ol>
</div>
<?php endif; ?>

<?php else : // this is displayed if there are no comments so far ?>

<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

<?php else : // comments are closed ?>
		<!-- If comments are closed. -->
<p class="nocomments">Comments are closed.</p>

<?php endif; ?>

<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

<div id="respond">

<h4><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h4>

<div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="cf">

<?php if ( $user_ID ) : ?>

<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>

<?php else : ?>

<p><input type="text" class="tf" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
<label for="author"><small>Name <?php if ($req) echo "(required)"; ?></small></label></p>

<p><input type="text" class="tf" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
<label for="email"><small>E-Mail (will not be published) <?php if ($req) echo "(required)"; ?></small></label></p>

<p><input type="text" class="tf" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
<label for="url"><small>Website</small></label></p>

<?php endif; ?>

<?php /*<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>*/ ?>

<p><textarea name="comment" id="comment" cols="50%" rows="8" class="af"></textarea></p>

<p><input name="submit" type="submit" class="tinput" id="submit" value="Submit Comment" />
<?php comment_id_fields(); ?>
</p>
<?php do_action('comment_form', $post->ID); ?>


</form>

<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>
<div class="clearfix"></div>
</div>
