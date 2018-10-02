<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) { ?>
			<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
			<?php return;
		}
	}
	/* This variable is for alternating comment background */
	$oddcomment = ' alt';
?>

<!-- Start editing here. -->

<?php if ($comments) : ?>

					<div class="commentlist">
						<h3 style="margin-bottom:14px;">Responses</h3>


						<?php foreach ($comments as $comment) : ?>

						<div class="<?php echo $oddcomment; ?>" id="comment-<?php comment_ID() ?>">
		
						
							<div class="text">
								
								<?php if ($comment->comment_approved == '0') : echo "<em>Your comment is awaiting moderation.</em>"; endif; ?>
								
								<div class="avatar_<?php if (1 == $comment->user_id) $oddcomment = "admincomment"; echo $oddcomment; ?>">
								<?php if(function_exists('get_avatar')) { echo get_avatar($comment, '60'); } ?>
								</div>
								
								<div class="commenttext">
								<strong><?php comment_author_link() ?></strong> on <?php comment_time('l, F jS, Y') ?> <br />
								<br />
								<?php comment_text() ?>
								</div>
								
								<div class="clearfix"></div>
								
								
								
								
							</div>
							
							

						</div>

						<?php $oddcomment = ( empty( $oddcomment ) ) ? ' alt' : ''; ?>

						<?php endforeach; ?>

					</div>

	<?php else : // this is displayed if there are no comments so far ?>

		<?php if ('open' == $post->comment_status) : ?>

		<?php else : ?>
		<p class="nocomments">Comments are closed.</p>

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

<h3 style="margin:20px 0 15px 0;">What do you think?</h3>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>

<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

	<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Log out &raquo;</a></p>

<?php else : ?>


	<p><div style="margin-bottom:5px;">Name</div><input type="text" name="author" id="author" size="22" tabindex="1" /></p>
	<p><div style="margin-bottom:5px;">E-Mail</div><input type="text" name="email" id="email" size="22" tabindex="2" /></p>
	<p><div style="margin-bottom:5px;">Website</div><input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" /></p>
<?php endif; ?>

	<p><div style="margin-bottom:5px;">Message</div><textarea name="comment" id="comment" cols="5" rows="5" tabindex="3"></textarea></p>

	<p class="clearfix"><input name="submit" type="submit" id="submit" tabindex="5" class="submit" value="Submit" />
	<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /></p>

<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; endif; ?>
