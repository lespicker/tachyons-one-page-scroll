<div id="lside">
  <h2>Categories</h2>
  <ul>
    <?php wp_list_cats(); ?>
  </ul>
  <div class="adsideleft">
  <h3 class="ad160"><span>Adverising</span></h3>
  <a href="http://ad"><img src="<?php bloginfo('template_url'); ?>/images/ad160.png" border="0" width="160" height="600" alt="sal" /></a>
  </div>
  <h2>Blogroll</h2>
  <ul>
    <?php get_links('-1', '<li class="arrow">', '</li>', '', FALSE, 'id', FALSE, FALSE, -1, FALSE); ?>
  </ul>
  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar 160px right') ) : ?>
  <?php endif; ?>
</div>
