<div id="nav">
<ul>
<li class="Largenav"><h2><a title="Get back home" href="<?php echo get_settings('home'); ?>/"><?php _e('Home'); ?><br /><span>{frontpage}</span></a></h2></li>
<li class="Largenav"><h2><?php _e('Pages'); ?><br /><span>{more}</span></h2>
<ul><?php wp_list_pages('title_li=' ); ?></ul></li>

<li class="Largenav"><h2><?php _e('Archives'); ?><br /><span>{the past}</span></h2>
<ul><li><?php get_calendar(); ?></li></ul></li>

<li class="Largenav"><h2><?php _e('Recently'); ?><br /><span>{the present}</span></h2>
<ul><?php wp_get_archives('type=postbypost&limit=5'); ?></ul></li>

<li class="Largenav"><h2><?php _e('Topics'); ?><br /><span>{interest}</span></h2>
<ul><?php wp_list_cats('sort_column=name&hide_empty=0&optioncount=0&hierarchical=1'); ?></ul></li>
<li class="Largenav"><h2><a title="Get the feed" href="<?php bloginfo('rss2_url'); ?>"><?php _e('RSS'); ?><br /><span>{the feed}</span></a></h2></li>
</ul>
</div>