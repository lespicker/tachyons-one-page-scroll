<?php get_header(); ?>

<div id="content">

  <?php if (have_posts()) : ?>
  <?php $post = $posts[0];  ?>
  <?php if (is_category()) { ?>
  
  <h2 class="pagetitle">&#8216;
    <?php single_cat_title(); ?>
    &#8217;
    <?php _e('Category')?>
  </h2>
  
  
  <?php  } elseif (is_day()) { ?>
  <h2 class="pagetitle">    <?php _e('Archive for')?>    <?php the_time('F jS, y'); ?>  </h2>
  
  <?php  } elseif (is_month()) { ?>
  <h2 class="pagetitle">    <?php _e('Archive for')?>    <?php the_time('F, y'); ?>  </h2>
  
  <?php } elseif (is_year()) { ?>
  <h2 class="pagetitle">    <?php _e('Archive for')?>    <?php the_time('y'); ?>  </h2>
  
  <?php  } elseif (is_search()) { ?>
  <h2 class="pagetitle">    <?php _e('Search results for')?>    &#8216;&#8216; <?php echo($s); ?> &#8217;&#8217; </h2>
    <?php } ?>
  
  
  <?php while (have_posts()) : the_post(); ?>
  <div class="post" id="post-<?php the_ID(); ?>">
<span class="macky"><?php the_category(', ') ?></span>
    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to')?> <?php the_title(); ?>">
      <?php the_title(); ?></a></h2>
      
    <?php if(!is_page()) {  ?>
    
    <small><span class="sigdate">{</span>  <span class="post-comments"><?php comments_popup_link('No Comment', '1 Comment', '% Comments'); ?></span> \ <?php if(function_exists('the_tags')) {$my_tags = get_the_tags();if ( $my_tags != "" ){ the_tags('Tags: ', ', ', ''); } else {echo "Tags: None";} }?> <?php if(function_exists('UTW_ShowTagsForCurrentPost')) { echo 'Tags: ';UTW_ShowTagsForCurrentPost("commalist");echo ''; } ?> \ 
    <?php the_time('M'); ?><span class="bigdate"><?php the_time('j'); ?> }</span></small>
   
    <div class="clear"></div>
    <?php }  ?>
    <?php if(!is_search()) :  ?>
    <div class="entry">
<div class="left">
<?php get_the_image(array('width' => '80', 'height' => '80', 'image_scan' => true)); ?>
</div>

      <?php the_content_rss('', FALSE, '', 40); ?>
<div class="clear"></div>
<div class="more"><span class="bigdate">{</span> <a href="<?php the_permalink() ?>" rel="bookmark" title="Read the article: <?php the_title(); ?>">Read the article &#187; &#187;</a> <span class="bigdate">}</span></div>

<?php edit_post_link('{Edit this entry}','',''); ?>
    </div>
    <?php endif;  ?>
    <?php if(!is_page()) {  ?>
    <?php if(is_single()) : ?>
 
    
    <?php else :  ?>

   
    <?php endif; ?>
    <?php }  ?>
  </div>
  <?php if(is_single()) :   ?>
  <?php comments_template(); ?>
  <?php endif;  ?>
  <?php endwhile; ?>
  <?php if(is_single() || is_page() ) :  ?>
  <?php else: ?>

<?php if(function_exists('wp_pagenavi')) { wp_pagenavi('', '', '', '', 3, false);} ?>
  
  <?php endif;  ?>
  <?php else : ?>
  <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
  <?php endif; ?>
</div>

<?php include(TEMPLATEPATH . '/inc/sidebar.php'); ?>
<?php include(TEMPLATEPATH . '/inc/footer.php'); ?>