<?php
if($$codename->option['slideCat'] !='Select a category:' && $$codename->option['slideCat'] !='' && $$codename->option['slideNum'] != 0 && $$codename->option['slideNum'] !=''):
$slidecat = $$codename->option['slideCat'];
$slidecount = $$codename->option['slideNum'];
$my_query = new WP_Query('category_name= '. $slidecat .'&showposts='.$slidecount.'');
if($my_query->have_posts()):
?>
<div id="image-gallery-wrapper">
	<script type="text/javascript">
	stepcarousel.setup({
		galleryid: 'image-gallery', //id of carousel DIV
		beltclass: 'belt', //class of inner "belt" DIV containing all the panel DIVs
		panelclass: 'panel', //class of panel DIVs each holding content
		panelbehavior: {speed:500, wraparound:true, persist:true},
		defaultbuttons: {enable: true, moveby: 4, leftnav: ['<?php bloginfo('template_directory'); ?>/images/sliding-prev-button.gif', -30, 75, 'slide-prev-nav'], rightnav: ['<?php bloginfo('template_directory'); ?>/images/sliding-next-button.gif', 20, 75, 'slide-next-nav']},
		statusvars: ['statusA', 'statusB', 'statusC'], //register 3 variables that contain current panel (start), current panel (last), and total panels
		contenttype: ['external'] //content setting ['inline'] or ['external', 'path_to_external_file']
	})
	</script>

	<div id="image-gallery" class="stepcarousel">
		<div class="belt">
		<?php while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID; ?>
			<div class="panel">
				<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" > <img src="<?php echo get_post_meta($post->ID,'thumbnail', true); ?>" width="200" height="156" alt="<?php the_title(); ?>"/> </a>
			</div>
		<?php endwhile; ?>
		</div>
	</div><!-- /image-gallery -->
</div><!-- /image-gallery-wrapper -->
<?php endif; endif; ?>
