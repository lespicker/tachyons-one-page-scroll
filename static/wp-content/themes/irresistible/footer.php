
	</div><!-- / #wrap -->

	<div id="footer">
		
		<div id="footerWrap">
		
			<p id="copy"><?php _e('Copyright',woothemes); ?> &copy; <?php echo date('Y'); ?> <a href="#"><?php bloginfo('name'); ?></a>. <?php _e('All rights reserved',woothemes); ?>.</p>
			<?php
			if ( function_exists('has_nav_menu') && has_nav_menu('footer-menu') ) {
				wp_nav_menu( array( 'depth' => 1, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'footerNav', 'theme_location' => 'footer-menu' ) );
			} else {
			?>
			<ul id="footerNav">
				<?php 
                if ( get_option('woo_custom_nav_menu') == 'true' ) {
                    if ( function_exists('woo_custom_navigation_output') )
                        woo_custom_navigation_output('name=Woo Menu 2');
    
                } else { ?>
				<?php wp_list_pages('sort_column=menu_order&title_li=&depth=1'); ?>
				<?php } ?>
				<li><a href="http://www.woothemes.com" title="Irresistible Theme by WooThemes"><img src="<?php bloginfo('template_directory'); ?>/images/img_woothemes.jpg" width="87" height="21" alt="WooThemes" /></a></li>			
			</ul>
			<?php } ?>
		</div><!-- / #footerWrap -->
	
	</div><!-- / #footer -->

<?php wp_footer(); ?>


</body>
</html>