<div id="sidebar">
	<ul>
		<li class="page_item"><a title="Home" href="<?php echo get_option('home'); ?>/">Home</a></li>
		<?php wp_list_pages('title_li=&depth=1'); ?>
	</ul>
	<br />
		
	
		<?php 	/* Widgetized sidebar */
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('blog') ) : ?>
					
		This is de dynamic blog sidebar, just add here all the blog stuff you want.
								
		<?php endif; ?>
			
		<br />
		<br />
</div>
