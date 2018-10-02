<div class="sub">
<h4>Subscribe via mail</h4>
<?php $feed = get_option('typo_feed')?>
<form style="border:0;padding:3px;text-align:left;" action="http://www.feedburner.com/fb/a/emailverify" method="post" target="popupwindow" onsubmit="window.open('http://www.feedburner.com/fb/a/emailverifySubmit?feedId=<?php echo($feed); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
<p>Enter your email address:</p>
<p><input type="text" style="width:90%" name="email"/></p>
<input type="hidden" value="http://feeds.feedburner.com/~e?ffid=<?php echo($feed); ?>" name="url"/>
<input type="hidden" value="milo" name="title"/>
<input type="hidden" name="loc" value="en_US"/>
<input type="submit" value="Subscribe" />
</form>	

<h4>Bookmark</h4>
<ul>
<li><a title="Stumble it" href="http://www.stumbleupon.com/submit?url=<?php echo get_option('home'); ?>&#38;title=<?php bloginfo('name'); ?>">
Stumble it</a></li>
<li><a title="Submit it to Digg" href="http://digg.com/submit?phase=2&#38;url=<?php echo get_option('home'); ?>&#38;title=<?php bloginfo('name'); ?>">Digg it</a></li>
<li><a title="Add to del.icio.us" href="http://del.icio.us/post?url=<?php echo get_option('home'); ?>&#38;title=<?php bloginfo('name'); ?>">Deli.icio.us</a></li>
<li><a title="Links in Technorati" href="http://technorati.com/search/<?php bloginfo('url'); ?>">Technorati</a></li>
</ul>
</div>
