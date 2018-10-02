<div id="postlist">

<ul class="spy">
<?php $my_query = new WP_Query('orderby=rand'); ?>
<?php while ($my_query->have_posts()) : $my_query->the_post();?>
<li>

<?php $screen = get_post_meta($post->ID, 'screen', $single = true); ?>
<img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo $screen; ?>&amp;h=60&amp;w=100&amp;zc=1" alt=""/> 

<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
<div class="fcats"><?php the_category(', '); ?> </div> 
<div class="auth"> Posted by <?php the_author(); ?> </div> 

</li>
<?php endwhile; ?>

</ul>
</div>
<div class="clear"></div>