<?php get_header(); ?>
<div id="content">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="post" id="post-<?php the_ID(); ?>">

<span class="macky"><?php the_category(', ') ?> <span class="big">{<?php comments_number('0', '1', '%' );?>}</span> <a href="#respond"><?php _e('Add your reply?')?></a></span>

<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to')?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
      
<small><span class="sigdate">{</span> <?php if(function_exists('the_tags')) {$my_tags = get_the_tags();if ( $my_tags != "" ){ the_tags('Tags: ', ', ', ''); } else {echo "Tags: None";} }?> <?php if(function_exists('UTW_ShowTagsForCurrentPost')) { echo 'Tags: ';UTW_ShowTagsForCurrentPost("commalist");echo ''; } ?> \ 
<?php the_time('M'); ?><span class="bigdate"><?php the_time('j'); ?> }</span></small>
    
 
<div class="entry">
<?php the_content(__('Read more &raquo;')); ?>
<div class="clear"></div>
</div>

<?php edit_post_link('{Edit this entry}','',''); ?>

<div id="relposts">
<h3>Related Posts</h3>
<?php
if( function_exists('cattag_related_posts') ) { echo '<ul>' . cattag_related_posts() . '</ul>'; }
?>
</div>
</div>
<div class="clear"></div>
<?php comments_template(); ?>
<div class="clear"></div>

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>
<div class="navigation">
<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
</div>
</div>

<?php include(TEMPLATEPATH . '/inc/sidebar.php'); ?>
<?php include(TEMPLATEPATH . '/inc/footer.php'); ?>