<div id="sidebar">
	<ul>
		<li class="page_item"><a title="Home" href="<?php echo get_option('home'); ?>/">Home</a></li>
		<?php wp_list_pages('title_li=&depth=1'); ?>
	</ul>
	<br />
		
	
	<?php 	/* Widgetized sidebar */
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
					
		<b>Hi there.</b> I am BlueBubble, a brandnew minimal &amp; elegant wordpress portfolio theme 
		exclusive designed for <strong>you</strong> <br /> - by <a href="http://www.thomasveit.com">Thomas Veit</a> with love on mac. <br />
		<hr />
					
		<?php endif; ?>
	Feel free to get in touch with me. <br /> <br />
		<div id="form_status" style="display:none; height:20px;"></div>
          	<form action="<?php echo get_bloginfo('template_directory'); ?>/scripts/mail.php" method="post" id="emailme">
                <input type="text" tabindex="1" value="What is your name?" name="yourname" id="fromName"/> <br />
                <input type="text" tabindex="2" value="Please enter your email" name="youremail" id="emailTo"/> <br />
                <textarea tabindex="3" rows="6" cols="25" name="yourmessage" id="message">Your Message ...</textarea> <br />
                <input type="submit" value="Send message" tabindex="4" name="submit" class="sendmessage" id="emailmebtn"/>
                <input type="hidden" value="negative" name="javacheck" id="javacheck"/>
            </form>
            <br />
            <hr />
Other ways to reach me: <br /><br />
<a href="http://www.facebook.com"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/facebook.png" alt="Facebook" /></a> &nbsp; <a href="http://www.twitter.com"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/twitter.png" alt="Twitter " /></a> &nbsp; <a href="http://www.delicious.com"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/delicious.png" alt="Delicious " /></a> 
		
		
		
</div>
