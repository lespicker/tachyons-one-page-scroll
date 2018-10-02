</div>

<!-- BEGIN footer -->

	<div id="footer">
   	<div id="footer_content">	
      <div class="about_us footer_con">
        <div class="footer_round2">
          <h4>About Us</h4>
          <p>Dorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse interdum. Donec tristique dolor nec nisi. Ut faucibus metus non orci. Pellentesque sapien orci, blandit quis, luctus et, vestibulum tristique, massa.</p>
          <ul>
          <?php wp_list_pages('title_li=&limit=5'); ?>
          </ul>
        </div>
      </div>

      <div class="footer_con">
				<div class="footer_round2">
          <h4>Categories</h4>
          <ul><?php wp_list_categories('title_li=&limit=10&show_count=1'); ?></ul>
				</div>
      </div>

			<div class="footer_con">
				<div class="footer_round2">
					<h4>Recent Posts </h4>
					<ul>
					  <?php wp_get_archives('title_li=&type=postbypost&limit=10'); ?><br>
					</ul>
				</div>
			</div>

		</div>
		       
    <div id="credits"> 
      <div class="ads_copyright">
        <a href="http://wpfrompsd.com">PSD to WP</a> | 
        <a href="http://www.warshafsky.com/">Milwaukee Personal Injury Attorney</a> | 
        <a href="http://www.kidstructures.com/">San Antonio Swing Sets</a>
        <p>Copyright <? the_date('Y'); ?> <a href="http://www.wordpressthemedesigner.com"> WordPress Theme Designer</a>. Powered by <a href="http://wordpress.org">WordPress</a>. All Rights Reserved. </p>
      </div>
				
      <div class="entries">
        <a href="<?php bloginfo('rss2_url'); ?>" class="rss">Entries RSS </a> 
        <a href="<?php bloginfo('comments_rss2_url'); ?>" class="rss">Comments RSS </a> 
        <span class="loginout"><?php wp_loginout(); ?></span>
      </div>
    </div>
            
  </div>
</div>
    

    <?php wp_footer(); ?>
	<!-- END footer -->

<!-- END wrapper -->

</body>

</html>
