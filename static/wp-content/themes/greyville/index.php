<?php 
get_header();
?>
<div id="post">	
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="commenti_top"><?php comments_popup_link('0', '1', '%'); ?></div>
Posted by <?php the_author() ?> on <?php the_time('F jS, Y') ?> :: Filed under <?php the_category(',') ?><?php the_tags('<br />Tags :: '); ?> <!-- by <?php the_author() ?> --><?php edit_post_link('<br /><b>Edit This</b>'); ?>
<hr size="1" color="#eeeeee" noshade>
<div class="clear"></div>
<div id="navigatore">
<div class="right"><?php next_posts_link('Previous Articles') ?></div>
<div class="left"><?php previous_posts_link('Next Articles') ?></div>
</div>
</div>