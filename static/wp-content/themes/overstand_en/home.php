<?php get_header() ?>

<div id="container">
		<div id="content">
		
<!-- Begin editing categories below here. -->
		
<ul class="latest2">
<?php $feature_post = get_posts( 'category=3&numberposts=1' ); ?>
<?php foreach( $feature_post as $post ) : setup_postdata( $post ); ?>
<li><h2 class="latest"><?php the_category(' '); ?></h2></li>
<?php endforeach; ?>
<?php $feature_post = get_posts( 'category=3&numberposts=4' ); ?>
<?php foreach( $feature_post as $post ) : setup_postdata( $post ); ?>
<?php if (function_exists('c2c_get_custom')) : ?>
 <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		<?php echo c2c_get_custom('post-image','<img src="','" alt="<?php the_title(); ?>" class="post-image" />',''); ?></a></li>
<?php endif; ?>

  		<li class="list-time"><?php the_time('d'); ?>.<?php the_time('M'); ?></li>
  		<li class="list-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></li>
  		<li class="latest-excerpt2"><?php the_excerpt(); ?></li>
<?php endforeach; ?>
</ul>


<ul class="latestoneandhalf">
<?php $feature_post = get_posts( 'category=1&numberposts=1' ); ?>
<?php foreach( $feature_post as $post ) : setup_postdata( $post ); ?>
<li><h2 class="latest"><?php the_category(' '); ?></h2></li>
<?php endforeach; ?>
<?php $feature_post = get_posts( 'category=1&numberposts=2' ); ?>
<?php foreach( $feature_post as $post ) : setup_postdata( $post ); ?>
<?php if (function_exists('c2c_get_custom')) : ?>
 <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		<?php echo c2c_get_custom('post-image','<img src="','" alt="<?php the_title(); ?>" class="post-image"/>',''); ?></a></li>
<?php endif; ?>
  		<li class="list-time"><?php the_time('d'); ?>.<?php the_time('M'); ?></li>
  		<li class="list-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></li>
  		<li class="latest-excerptoneandhalf"><?php the_excerpt(); ?></li>
<?php endforeach; ?>
</ul>

<ul class="latestoneandhalf">
<?php $feature_post = get_posts( 'category=4&numberposts=1' ); ?>
<?php foreach( $feature_post as $post ) : setup_postdata( $post ); ?>
<li><h2 class="latest"><?php the_category(' '); ?></h2></li>
<?php endforeach; ?>
<?php $feature_post = get_posts( 'category=4&numberposts=2' ); ?>
<?php foreach( $feature_post as $post ) : setup_postdata( $post ); ?>
<?php if (function_exists('c2c_get_custom')) : ?>
 <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		<?php echo c2c_get_custom('post-image','<img src="','" alt="<?php the_title(); ?>" class="post-image" />',''); ?></a></li>
<?php endif; ?>
  		<li class="list-time"><?php the_time('d'); ?>.<?php the_time('M'); ?></li>
  		<li class="list-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></li>
  		<li class="latest-excerptoneandhalf"><?php the_excerpt(); ?></li>
<?php endforeach; ?>
</ul>

<!-- Stop editing categories here. -->

  
 <div class="clear"></div>
 
<!-- You can edit this part, but be careful. See Presentation > Altera Options & Help in your WordPress Admin for more information. -->
 
 <div class="three-col">
 <h2 class="start">SOME WORDS?</h2>
<p>You can put some words about your blog here. You can edit these words in "home.php"</p>
</div>
 
  <div class="oneandhalf-col">
  <h2 class="start">JOIN</h2>
<p><strong>Join <?php bloginfo('blog_name'); ?></strong>. Post comments and submit stories&mdash;engage, converse, create. Login, or join now.</p>

				<ul>
					<?php wp_register() ?>

					<li><?php wp_loginout() ?></li>
					<?php wp_meta() ?>

				</ul>

 </div>
 

 
  <div class="oneandhalf-col">
  <h2 class="start">FEEDS</h2>
<p>Get updated regularly via our RSS Feeds</p>
				<ul>
					<li><a href="<?php bloginfo('rss2_url') ?>" title="<?php echo wp_specialchars(get_bloginfo('name'), 1) ?> <?php _e('Posts RSS feed', 'sandbox'); ?>" rel="alternate" type="application/rss+xml"><?php _e('Artikel RSS Feed', 'sandbox') ?></a></li>
					<li><a href="<?php bloginfo('comments_rss2_url') ?>" title="<?php echo wp_specialchars(bloginfo('name'), 1) ?> <?php _e('Comments RSS feed', 'sandbox'); ?>" rel="alternate" type="application/rss+xml"><?php _e('Kommentare RSS Feed', 'sandbox') ?></a></li>
				</ul>

				
 </div>
 

 
  <div class="clear"></div>
 
 <div class="four-col"><h2 class="start">Story beside</h2>
 
 <!-- Edit this with the path to the image you want to feature. -->
 <img src="<?php bloginfo('template_url'); ?>/images/test.jpg" alt="Featured picture" class="amrande"/>
 <!-- End edit. -->
 
 <ul class="sited">
<?php $feature_post = get_posts( 'category=3&numberposts=1' ); ?>
<?php foreach( $feature_post as $post ) : setup_postdata( $post ); ?>
  		<li><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a><br /><?php the_excerpt(); ?></li>
<?php endforeach; ?>
</ul>
</div>

<div class="oneandhalf-col">
        <h2 class="start">COMMENTS</h2>
        
        <?php if (function_exists('get_recent_comments')) : ?>
				<ul>
              <?php get_recent_comments(); ?>
              </ul>
		<?php endif; ?>

              </div>

<!-- Stop editing here. -->
 		</div><!-- #content -->
	</div><!-- #container -->
<?php include (TEMPLATEPATH . '/bottom.php'); ?>
	<?php get_footer() ?>