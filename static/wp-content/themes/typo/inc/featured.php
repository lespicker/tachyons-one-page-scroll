<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/pts.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/homepage.js"></script>
<div class="h-col fl">
<div id="imageslide">
<div class="scroller">
<div class="content">


<div class="section" id="section1">
<?php 
	$slidecat = get_option('typo_slide_category'); 
	$my_query = new WP_Query('category_name= '. $slidecat .'&showposts=1&offset=0');
while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID;
?>

<?php $image = get_post_meta($post->ID, 'lead_image', true); ?>
<div class="pi" style="background: transparent url(<?php echo $image ?>) no-repeat scroll 0pt;">
<div class="mi">
<h3><a title="<?php the_content_rss('', FALSE, '', 40); ?>" href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
<?php the_content_rss('', FALSE, '', 10); ?>
<?php endwhile; ?>
</div>
</div>
</div>


<div class="section" id="section2">
<?php 
	$slidecat = get_option('typo_slide_category'); 
	$my_query = new WP_Query('category_name= '. $slidecat .'&showposts=1&offset=1');
while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID;
?>
<?php $image = get_post_meta($post->ID, 'lead_image', true); ?>
<div class="pi" style="background: transparent url(<?php echo $image ?>) no-repeat scroll 0pt;">
<div class="mi">
<h3><a title="<?php the_content_rss('', FALSE, '', 40); ?>" href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
<?php the_content_rss('', FALSE, '', 10); ?>
<?php endwhile; ?>
</div>
              </div>
            </div>

<div class="section" id="section3">
<?php 
	$slidecat = get_option('typo_slide_category'); 
	$my_query = new WP_Query('category_name= '. $slidecat .'&showposts=1&offset=2');
while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID;
?>
<?php $image = get_post_meta($post->ID, 'lead_image', true); ?>
<div class="pi" style="background: transparent url(<?php echo $image ?>) no-repeat scroll 0pt;">
<div class="mi">
<h3><a title="<?php the_content_rss('', FALSE, '', 40); ?>" href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
<?php the_content_rss('', FALSE, '', 10); ?>
<?php endwhile; ?>
</div>
              </div>
            </div>


<div class="section" id="section4">
<?php 
	$slidecat = get_option('typo_slide_category'); 
	$my_query = new WP_Query('category_name= '. $slidecat .'&showposts=1&offset=3');
while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID;
?>
<?php $image = get_post_meta($post->ID, 'lead_image', true); ?>
<div class="pi" style="background: transparent url(<?php echo $image ?>) no-repeat scroll 0pt;">
<div class="mi">
<h3><a title="<?php the_content_rss('', FALSE, '', 40); ?>" href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
<?php the_content_rss('', FALSE, '', 10); ?>
<?php endwhile; ?>
</div>
              </div>
            </div>


<div class="section" id="section5">
<?php 
	$slidecat = get_option('typo_slide_category'); 
	$my_query = new WP_Query('category_name= '. $slidecat .'&showposts=1&offset=4');
while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID;
?>
<?php $image = get_post_meta($post->ID, 'lead_image', true); ?>
<div class="pi" style="background: transparent url(<?php echo $image ?>) no-repeat scroll 0pt;">
<div class="mi">
<h3><a title="<?php the_content_rss('', FALSE, '', 40); ?>" href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
<?php the_content_rss('', FALSE, '', 10); ?>
<?php endwhile; ?>
</div>
              </div>
            </div>


            <div class="section" id="section6">
<?php 
	$slidecat = get_option('typo_slide_category'); 
	$my_query = new WP_Query('category_name= '. $slidecat .'&showposts=1&offset=5');
while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID;
?>
<?php $image = get_post_meta($post->ID, 'lead_image', true); ?>
<div class="pi" style="background: transparent url(<?php echo $image ?>) no-repeat scroll 0pt;">
<div class="mi">
<h3><a title="<?php the_content_rss('', FALSE, '', 40); ?>" href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
<?php the_content_rss('', FALSE, '', 10); ?>
<?php endwhile; ?>
</div>
              </div>
            </div>

<div class="section" id="section7">
<?php 
	$slidecat = get_option('typo_slide_category'); 
	$my_query = new WP_Query('category_name= '. $slidecat .'&showposts=1&offset=6');
while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID;
?>
<?php $image = get_post_meta($post->ID, 'lead_image', true); ?>
<div class="pi" style="background: transparent url(<?php echo $image ?>) no-repeat scroll 0pt;">
<div class="mi">
<h3><a title="<?php the_content_rss('', FALSE, '', 40); ?>" href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
<?php the_content_rss('', FALSE, '', 10); ?>
<?php endwhile; ?>
</div>
              </div>
            </div>

	</div>
            </div>	 

<div class="controls">
<a title="slide me" href="#section1" class="on" id="icon1" onclick="switchOn(1);">
 <b style="background: transparent url(<?php bloginfo('template_url'); ?>/images/01.jpg) no-repeat scroll  0 0;">1</b></a>

  <a title="slide me" href="#section2" id="icon2" onclick="switchOn(2);">
  <b style="background: transparent url(<?php bloginfo('template_url'); ?>/images/02.jpg) no-repeat scroll  0 0;">2</b></a>

  <a title="slide me" href="#section3" id="icon3" onclick="switchOn(3);">
  <b style="background: transparent url(<?php bloginfo('template_url'); ?>/images/03.jpg) no-repeat scroll  0 0;">3</b></a>

  <a title="slide me" href="#section4" id="icon4" onclick="switchOn(4);">
  <b style="background: transparent url(<?php bloginfo('template_url'); ?>/images/04.jpg) no-repeat scroll 0 0;">4</b></a>

  <a title="slide me" href="#section5" id="icon5" onclick="switchOn(5);">
  <b style="background: transparent url(<?php bloginfo('template_url'); ?>/images/05.jpg) no-repeat scroll  0 0;">5</b></a>

  <a title="slide me" href="#section6" id="icon6" onclick="switchOn(6);">
  <b style="background: transparent url(<?php bloginfo('template_url'); ?>/images/06.jpg) no-repeat scroll  0 0;">6</b></a>

<a title="slide me" href="#section7" id="icon7" onclick="switchOn(7);">
<b style="background: transparent url(<?php bloginfo('template_url'); ?>/images/07.jpg) no-repeat scroll  0 0;">7</b></a>

  </div>
      </div>
      <script type="text/javascript" charset="utf-8">
		var imageslide = new Glider('imageslide', {duration:0.2});
	</script>
    </div>