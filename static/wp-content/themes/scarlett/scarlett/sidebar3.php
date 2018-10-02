<?php if ( !function_exists('dynamic_sidebar')
|| !dynamic_sidebar(3) ) : ?>
 
 <div class="sidebar3">
<h2>Archives</h2>
<ul>
<?php wp_get_archives('type=monthly&limit=12'); ?>
</ul>
</div>

<?php endif; ?>
 <div class="sidebar3">
				<h2>Most Commented</h2>

	    <ul>
  
		 <?php if(function_exists('mdv_most_commented')) { mdv_most_commented(); } ?>

        </ul>
	
</div>