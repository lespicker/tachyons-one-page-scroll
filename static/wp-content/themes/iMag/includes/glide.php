<?php
if ($$codename->option['featuredCat'] != '' && $$codename->option['featuredCat'] != 'Select a category:'  && $$codename->option['featuredNum'] != '0' && $$codename->option['featuredNum'] !=''):
$glidecat = $$codename->option['featuredCat'];
$my_query = new WP_Query('category_name='. $glidecat .'&showposts=5');
if ($my_query->have_posts()):
?>
<script type="text/javascript">
featuredcontentglider.init({
	gliderid: "featured-posts",
	contentclass: "featured-post",
	togglerid: "togglebox",
	remotecontent: "", 
	selected: 1,
	persiststate: true,
	speed: 300,
	direction: "leftright",
	autorotate: true, 
	autorotateconfig: [10000, 9999] //if auto rotate enabled, set [milliseconds_btw_rotations, cycles_before_stopping]
})
</script>
<div id="featured-posts-wrapper">
	<div id="featured-posts" class="glidecontentwrapper">
	<?php while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID; ?>
		<div class="featured-post">
			<h3 class="title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
			<div class="meta icon">
				Posted by <?php the_author() ?> on <?php the_time('F-j-Y') ?> <a href="<?php the_permalink() ?>#comment"><?php comments_number('Add Comments','one Commented','% Commented'); ?></a>
			</div>
			<div class="entry">
				<p><?php the_content_rss('', TRUE, '', 240); ?></p>
			</div>
		</div>
	<?php endwhile; ?>
	</div>
	<div id="togglebox" class="glidecontenttoggler">
		<a href="#" class="prev"><span></span></a>
		<a href="#" class="next"><span></span></a>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div><!-- /featured-posts-wrapper -->
<?php endif; endif; ?>