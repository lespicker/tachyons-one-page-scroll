

<script type="text/javascript">
stepcarousel.setup({
	galleryid: 'mygallery', //id of carousel DIV
	beltclass: 'belt', //class of inner "belt" DIV containing all the panel DIVs
	panelclass: 'panel', //class of panel DIVs each holding content
	panelbehavior: {speed:500, wraparound:true, persist:true},
	defaultbuttons: {enable: true, moveby: 2, leftnav: ['<?php bloginfo('template_url'); ?>/images/scar2.jpg', -14, 68], rightnav: ['<?php bloginfo('template_url'); ?>/images/scar1.jpg', -2, 68]},
	statusvars: ['statusA', 'statusB', 'statusC'], //register 3 variables that contain current panel (start), current panel (last), and total panels
	contenttype: ['external'] //content setting ['inline'] or ['external', 'path_to_external_file']
})

	
</script>


<div id="myslides">
<div id="mygallery" class="stepcarousel">
<div class="belt">
<?php 
	$slidecat = get_option('scar_gldcat'); 
	$slidecount = get_option('scar_gldct');
	
	$my_query = new WP_Query('category_name= '. $slidecat .'&showposts='.$slidecount.'');
while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID;
?>


<div class="panel">

<?php $screen = get_post_meta($post->ID, 'screen', $single = true); ?>
<img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo $screen; ?>&amp;h=100&amp;w=200&amp;zc=1" alt=""/> 
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
</div>

<?php endwhile; ?>



</div>
</div>
</div>
