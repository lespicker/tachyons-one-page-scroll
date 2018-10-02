<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>

<div id="footbg"><!--footer background 100% -->

<div id="footwrap"><!--align footer content with main content-->

	<div id="flickr"><!--flick photos at footer-->
	<?php get_flickrRSS(10); ?>
	</div>
	
	<div id="more"><a href="#" title="Placeholder" class="zoom" rel="gallery"><img src="<?php bloginfo('template_directory'); ?>/images/placeholder.jpg"></a></div><!--This is the last image of the series. Self defined and optional-->
	
 	
	<div class="footer-links">
	<h2>Recent Post</h2>
			  <ul>
              <?php get_archives('postbypost', '10', 'custom', '<li>', '</li>'); ?>
              </ul>
	</div>
	
	<div class="footer-links">
	<h2>Most Popular</h2>
<?php if (function_exists('todays_overall_count_widget')) { todays_overall_count_widget('views', 'ul'); } ?>
	</div>
	
	<div class="footer-links-r">
	<h2>Popular Today</h2>
	<?php if (function_exists('todays_count_widget')) { todays_count_widget('views', 'ul'); }?>
	</div>
	
 <br clear="all" />
	
	<div id="copyright">
	<ul>
		<li><strong><a href="#top-panel">Back to Top</a></strong></li>
		<li><a href="#">Contact</a>&nbsp;&nbsp;&nbsp;|</li>
		<li><a href="#admin">About</a>&nbsp;&nbsp;&nbsp;|</li>
		<li><a href="#">Mobile</a>&nbsp;&nbsp;&nbsp;|</li>
	</ul>
	Powered by <a href="http://www.wordpress.org">Wordpress</a> | Theme by <a href="http://www.blogohblog.com" title="Free WordPress Themes">Blog Oh! blog</a>
	
	</div>
</div><!--close footer wrap -->
	
</div><!--close footer -->

<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/neowster.json?callback=twitterCallback2&amp;count=5"></script>

</body>
</html>
