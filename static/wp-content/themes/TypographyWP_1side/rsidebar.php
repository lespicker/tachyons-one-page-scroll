<div id="rside">
  <div id="tabs_container">
    <ol class="idTabs">
      <li class="recent">Recent</li>
      <li><a href="#tab1">Articles</a></li>
      <li style="border:none;"><a href="#tab2">Comments</a></li>
    </ol>
    <div id="tab1">
      <ul>
        <?php mdv_recent_posts(); ?>
      </ul>
    </div>
    <div id="tab2">
      <ul>
        <?php mdv_recent_comments(); ?>
      </ul>
    </div>
  </div>
  <div class="searchbox">
    <form method="get" action="<?php bloginfo('url'); ?>/">
      <input type="text" value="<?php the_search_query(); ?>" name="s" class="searchformtop" />
      <input type="image" src="<?php bloginfo('template_url'); ?>/images/trans.png" class="gosearch" />
    </form>
  </div>
  <?php if (function_exists(aktt_sidebar_tweets)) : ?>
  <h2>my tweets</h2>
  <div class="aktt_tweets">
  <?php aktt_sidebar_tweets(); ?>
  </div>
  <?php endif; ?>
  <h2>archives</h2>
  <ul class="arhives">
    <?php wp_get_archives('type=monthly', 'format=custom', '<li>', '</li>'); ?>
  </ul>
  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar 300px right') ) : ?>
  <?php endif; ?>
  <h2>tag cloud</h2>
  <?php wp_tag_cloud('smallest=10&largest=14&format=list'); ?>
</div>
