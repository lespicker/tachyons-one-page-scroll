<?php $get_twitter = get_theme_option('twitter'); if($get_twitter == '') { ?>
<?php { /* nothing */ } ?>
<?php } else { ?>
<li class="widget_twitter">
<div id="twitter-heading">Follow <a href="http://twitter.com/<?php echo ($get_twitter); ?>" target="_blank"><?php echo ($get_twitter); ?></a> On Twitter<br />
Check Out What I'm Doing Below:</div>
<div id="twitter_update_list">
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/blogger.js"></script>
<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php echo ($get_twitter); ?>.json?callback=twitterCallback2&amp;count=<?php $twitter_count = get_theme_option('twitter_count'); echo ($twitter_count); ?>"></script>
</div>
</li><!-- TWITTER END -->
<?php } ?>