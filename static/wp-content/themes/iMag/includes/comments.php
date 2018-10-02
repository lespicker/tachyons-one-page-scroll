<?php
function wpjunction_comment($comment) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="div-comment-<?php comment_ID() ?>">
		<div class="comment-list" id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php printf(__('<span class="author-name">Posted by <cite class="fn">%s</cite></span>'), get_comment_author_link()) ?> 
				<a class="comment-date" href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('On %1$s'), get_comment_date()) ?></a>
			</div>
			<?php if ($comment->comment_approved == '0') : ?>
				<em><?php _e('Your comment is awaiting moderation.') ?></em>
			<?php endif; ?>

			<div class="comment-text">
				<?php comment_text() ?>
				<?php edit_comment_link(__('(Edit)'),'  ','') ?>
			</div>
		</div>
		<div class="comment-bottom"></div>
<?php
}
?>