</div>
<?php wp_footer(); ?>

<div id="footerboxes">
  <div class="box1">
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer SPOT1') ) : ?>
    <?php endif; ?>
  </div>
  <div class="box2">
    <?php if (function_exists(get_flickrRSS)) : ?>
    <h2>Flickr photos</h2>
    <?php get_flickrRSS(); ?>
    <?php else : ?>
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer SPOT2') ) : ?>
    <?php endif; ?>
    <?php endif; ?>
  </div>
  <div class="box3">
    <h2>Most commented</h2>
    <ul>
      <?php most_commented(); ?>
    </ul>
  </div>
</div>
<div id="footer">
  <h1>Copyright &copy; 2008 - <?php echo date('Y'); ?> <a href="<?php echo get_option('home'); ?>" title="<?php bloginfo('description'); ?>">
    <?php bloginfo('name'); ?>
    </a></h1>
  <p>Powered by WordPress | Using <a href="http://www.acosmin.com/typographywp-free-wordpress-theme/">TypographyWP</a> <a href="http://www.acosmin.com" title="Wordpress theme designed by Alexandru Cosmin">Wordpress theme</a></p>
</div>
</div>
</body></html>