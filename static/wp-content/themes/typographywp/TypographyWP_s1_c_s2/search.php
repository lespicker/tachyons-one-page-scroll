<?php get_header(); ?>
<?php get_sidebar(); ?>
<div id="posts">
  <?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
  <div class="post" id="post-<?php the_ID(); ?>">
    <ul class="pinfo">
      <li class="lileft"><span>
        <?php the_time('j') ?>
        <br/>
        <em>
        <?php the_time('M') ?>
        </em></span></li>
      <li class="liright">
        <div><div><h1><a title='Permanent Link to <?php the_title(); ?>' href='<?php the_permalink() ?>' rel='bookmark'><?php the_title(); ?></a></h1></div></div>
      </li>
    </ul>
    <div class="postcontent">
      <?php the_content('<span>Read the rest of this entry...</span>'); ?>
      <span class="postcom"><?php comments_popup_link('none', 'one', '% com'); ?></span>
    </div>
  </div>
  <?php endwhile; ?>
  <div id="navigation">
    <?php posts_nav_link('','','<span class="prev">&laquo; Previous Entries</span>') ?>
    <?php posts_nav_link('','<span class="next">Next Entries &raquo;</span>','') ?>
  </div>
  <?php else : ?>
  <div class="post">
    <ul class="pinfo">
      <li class="lileft"><span>
        00		
        <br/>
        <em>
        day
        </em></span></li>
      <li class="liright">
        <div><div><h1>No articles yet!</h1></div></div>
      </li>
    </ul>
    <div class="postcontent">
    <?php _e('Sorry, no posts matched your criteria.'); ?>
    </div>
  </div>
  <?php endif; ?>
</div>
<?php include('rsidebar.php'); ?>
<?php get_footer(); ?>