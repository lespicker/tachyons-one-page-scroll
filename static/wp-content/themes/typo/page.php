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
  <h2 class="pagetitle">    <?php _e('Archive for')?>    <?php the_time('F jS, Y'); ?>  </h2>
  
  <?php  } elseif (is_month()) { ?>
  <h2 class="pagetitle">    <?php _e('Archive for')?>    <?php the_time('F, Y'); ?>  </h2>
  
  <?php } elseif (is_year()) { ?>
  <h2 class="pagetitle">    <?php _e('Archive for')?>    <?php the_time('Y'); ?>  </h2>
  
  <?php  } elseif (is_search()) { ?>
  <h2 class="pagetitle">    <?php _e('Search results for')?>    &#8216;&#8216;<?php echo($s); ?> &#8217;&#8217; </h2>
    <?php } ?>
  
  <?php while (have_posts()) : the_post(); ?>
  <div class="post" id="post-<?php the_ID(); ?>">
    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to')?> <?php the_title(); ?>">
      <?php the_title(); ?></a></h2>
      
    <?php if(!is_page()) {  ?>
    <small> 
    <?php _e('Written on')?>
    <?php the_time('M') ?> <?php the_time('d') ?>, <?php the_time('Y') ?>
    <?php _e('I')?> <?php the_category(', ') ?>.
    </small>
    
    <?php }  ?>
    <?php if(!is_search()) :  ?>
    <div class="entry">
      <?php the_content(__('Read more &raquo;')); ?>
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