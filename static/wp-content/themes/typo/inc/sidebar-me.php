<div id="random">
<a title="click me to open" id="openB" href="javascript:void(0);" >Find out who am I</a>
<a title="click me to close" id="closeB" href="javascript:void(0);" style="display:none;">Shut me down</a>
</div>

<div id="b" style="display:none;">
<div id="sidebar-me">
<p><img src="<?php bloginfo('template_url'); ?>/images/<?php echo $curauth->user_login; ?>.jpg" alt="The Author" class="right" width="90" height="90" />
<?php if ( (is_home())  ) { ?>
<?php query_posts('pagename=about');?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php the_content_rss('', FALSE, 'more_file', 20); ?>
<br /><a title="read more about me" href="/about/">&#8594; Read more...</a>
<?php endwhile; endif; ?>  		
<?php } ?> </p></div>


</div>

