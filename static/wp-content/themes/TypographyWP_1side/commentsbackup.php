<div>
  <?php 
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Go back you freak!');

	if (!empty($post->post_password)) { 
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) { 
			?>
  <p class="nocomments">Password Protected!</p>
  <?php
			return;
		}
	}
	
	$oddcomment = 'class="alt" ';
?>
  <?php if ($comments) : ?>
  <h3>
    <?php comments_number('No Responses', 'One Response', '% Responses' );?>
    to
    <?php the_title('&#8220;','&#8221;'); ?>
  </h3>
  <ul id="listcomments">
    <?php foreach ($comments as $comment) : ?>
    <li>
      <div class="leftpart">
      <?php echo get_avatar( $comment, 30 ); ?>
      </div>
      <div class="rightpart"> <span>
        <?php comment_author_link() ?>
        </span>
        <p> <a href="#comment-<?php comment_ID() ?>" title="">
          <?php comment_date('F jS, Y') ?>
          </a> at
          <?php comment_time() ?>
          <?php edit_comment_link('edit','| ',''); ?>
        </p>
      </div>
      <div class="commenttext">
        <?php comment_text() ?>
        <small style="color:#FF0000;">
        <?php if ($comment->comment_approved == '0') : ?>
        Your comment is awaiting moderation.
        <?php endif; ?>
        </small> </div>
    </li>
    <?php $oddcomment = ( empty( $oddcomment ) ) ? 'class="alt" ' : '';	?>
    <?php endforeach; /* end for each comment */ ?>
  </ul>
  <?php else : // this is displayed if there are no comments so far ?>
  <?php if ('open' == $post->comment_status) : ?>
  <!-- If comments are open, but there are no comments. -->
  <?php else : // comments are closed ?>
  <!-- If comments are closed. -->
  <p class="nocomments">Comments are closed.</p>
  <?php endif; ?>
  <?php endif; ?>
  <?php if ('open' == $post->comment_status) : ?>
</div>
<h3>Leave a reply</h3>
<div id="form">
  <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
  <p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">logged in</a> to post a comment.</p>
  <?php else : ?>
  <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
    <?php if ( $user_ID ) : ?>
    <p style="display: block; margin-top: 5px; font-size: 10px; text-transform:uppercase; font-family:Arial, Helvetica, sans-serif;">Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account') ?>">Logout &raquo;</a> </p>
    <?php else : ?>
    <small>Name
    <?php if ($req) _e('(<strong>*</strong>)'); ?>
    </small> <br />
    <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" tabindex="1" class="TextField Name"  />
    <br />
    <small>E-mail (
    <?php if ($req) _e('<strong>*</strong>'); ?>
    )</small><br />
    <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" class="TextField"   />
    <br />
    <small><abbr title="Uniform Resource Identifier">URI</abbr></small><br />
    <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" tabindex="3" class="TextField URI"  />
    <br />
    <small>Message</small><br />
    <?php endif; ?>
    <textarea name="comment" id="comment" rows="6" tabindex="4" class="TextArea"  cols="7"></textarea>
    <br />
    <p>
      <input name="SubmitComment" type="image" class="submitcom"  title="Post Your Comment" src="<?php bloginfo('template_url'); ?>/images/trans.png" alt="Post Your Comment" />
      <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
    </p>
    <?php do_action('comment_form', $post->ID); ?>
  </form>
  <?php endif; // If registration required and not logged in ?>
  <?php endif; // if you delete this the sky will fall on your head ?>
</div>