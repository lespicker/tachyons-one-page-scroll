<!-- BEGIN sidebar -->
<div id="sidebar">
	<!-- begin subscribe -->	
	<div class="social rss">
		<div class="rss_icon alignleft"></div>
		<div class="alignleft">
			<h3>RSS Feed Reader</h3>
			<a class="rss" href="<?php bloginfo('rss2_url'); ?>">Visit Here</a>
		</div>
	</div>
	<div class="social newsletter">
		<div class="news_icon alignleft"></div>
		<div class="alignleft">
			<h3>Grab Our Newsletter!</h3>
			<form>
        <input class="email" type="text" name="email" value="Enter your email..." onfocus="if(this.value =='Enter your email...'){ this.value='';}" onblur="if(this.value ==''){ this.value='Enter your email...';}"/>
        <button class="submit" type="submit">Subscribe</button>
      </form>
		</div>
	</div>
	<div class="cutting_line"></div>
	<!-- end subscribe -->

	<!-- begin featured video -->
	<div class="video">
		<script type="text/javascript">showVideo("<?php echo dp_settings('youtube'); ?>");</script>
	</div>
	<div class="cutting_line"></div>
	<!-- end featured video -->

	<!-- begin flickr photos -->
	<div class="flickr-whitebg">
		<div class="flickr">
			<h2>Flickr Photos</h2>
			<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=6&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=95572727@N00"></script>
		</div>
	</div>
	<div class="cutting_line"></div>
	<!-- end flickr photos -->
	
	<!-- begin left -->
	<div class="whitebg">
		<div class="l">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : ?>
			<!-- begin pages -->
			<h2>Pages</h2>
			<ul><?php dp_list_pages(); ?></ul>
			<!-- end pages -->
			
			<!-- begin blogroll -->
			<?php wp_list_bookmarks('category_before=&category_after=&title_before=<h2>&title_after=</h2>'); ?>
			<!-- end blogroll -->
			
			<!-- begin categories 
			<h2>Categories</h2>
			<ul><?php wp_list_categories('title_li=&depth=-1'); ?>	</ul>
			end categories -->
		<?php endif; ?>
		</div>
		<!-- end left -->
		
		<!-- begin right -->
		<div class="r">
		<?php if ( !function_exists('dynamic_sidebar')
		|| !dynamic_sidebar(2) ) : ?>
			<!-- begin archive -->
			<h2>Archive</h2>
			<ul><?php wp_get_archives('type=monthly'); ?></ul>
			<!-- end archive -->
			
			<!-- begin meta -->
			
			<h2>Meta</h2>
			<ul>
			<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<li><a href="http://jigsaw.w3.org/css-validator/validator?uri=<?php bloginfo('stylesheet_url'); ?>">Valid CSS</a></li>
				<li><a href="http://validator.w3.org/check/referer">Valid XHTML</a></li>
				<li><a href="http://www.wordpress.org">Wordpress</a></li>
			<?php wp_meta(); ?>
			</ul>
			
			<!-- end meta -->
		<?php endif; ?>
		</div>
		<!-- end right -->
    <div class="break"></div> 
	</div>
	
<!-- END sidebar -->
