<?php get_header(); ?>

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
        <div>
          <div>
            <h1><a title='Permanent Link to <?php the_title(); ?>' href='<?php the_permalink() ?>' rel='bookmark'>
              <?php the_title(); ?>
              </a></h1>
          </div>
        </div>
      </li>
    </ul>
    <div class="postcontent">
      <?php the_content('<span>Read the rest of this entry...</span>'); ?>
    </div>
    <div id="singleinfo">
      <div class="social">
        <ul>
          <li>Submit to:</li>
          <li><a href="http://digg.com/submit?url=<?php the_permalink() ?>&title=<?php the_title() ?>" rel="nofollow">Digg.com</a></li>
          <li><a href="http://www.mixx.com/submit?page_url=<?php the_permalink() ?>" rel="nofollow">Mixx.com</a></li>
          <li><a href="http://technorati.com/ping/?url=<?php the_permalink() ?>" rel="nofollow">Technorati</a></li>
          <li><a href="http://delicious.com/save?url=<?php the_permalink() ?>&title=<?php the_title() ?>" rel="nofollow">del.icio.us</a></li>
          <li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink() ?>" rel="nofollow">Facebook.com</a></li>
          <li><a href="http://www.stumbleupon.com/submit?url=<?php the_permalink() ?>&title=<?php the_title() ?>" rel="nofollow">StumbleUpon</a></li>
          <li><a href="http://www.reddit.com/submit?url=<?php the_permalink() ?>" rel="nofollow">reddit.com</a></li>
        </ul>
      </div>
      <ul>
        <li class="tags">Tagged as:
          <?php the_tags('',', ','<br />');?>
        </li>
        <li class="categorie">Published by
          <?php the_author() ?>
          in:
          <?php the_category(' '); ?>
        </li>
        <li class="rss">If you like this blog please take a second from your precious time and subscribe to <a href="http://feeds2.feedburner.com/TechySociety">my rss feed</a>!</li>
      </ul>
    </div>
  </div>
  <?php endwhile; ?>
  <?php else : ?>
  <div class="post">
    <ul class="pinfo">
      <li class="lileft"><span> 44 <br/>
        <em> day </em></span></li>
      <li class="liright">
        <div>
          <div>
            <h1>Hmm! To bad this is a 404 error</h1>
          </div>
        </div>
      </li>
    </ul>
    <div class="postcontent">
      <?php _e('Sorry, no posts matched your criteria.'); ?>
    </div>
  </div>
  <?php endif; ?>
  <div id="comments">
    <?php comments_template(); ?>
  </div>
</div>
<?php include('rsidebar.php'); ?>

<?php get_footer(); ?>
