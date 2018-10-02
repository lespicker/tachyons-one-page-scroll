	</div><!-- /content -->

	<div id="sidebar">
		<div id="primary">
		<ul>
			<li class="widget">
				<?php include(TEMPLATEPATH.'/includes/widget-tab.php'); ?>
			</li>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : ?>
			<li class="widget">
				<h4 class="widget-title">Meta</h4>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<li><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
					<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
					<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
					<?php wp_meta(); ?>
				</ul>
			</li>
			<?php endif ?>
		</ul>
		</div><!-- /primary -->

		<?php if ( function_exists('dynamic_sidebar')) : ?>
		<div id="secondary">
			<div id="sidebar-left" class="small-sidebar">
				<ul>
					<?php if (!dynamic_sidebar(2) ) : ?>
					<li class="widget">
						<h4 class="widget-title">Categories</h4>
						<ul>
						<?php wp_list_categories('orderby=name&show_count=0&title_li=&hierarchical=0'); ?>
						</ul>
					</li>
					<?php endif ?>
				</ul>
			</div>

			<div id="sidebar-right" class="small-sidebar">
				<ul>
					<?php if (!dynamic_sidebar(3) ) : ?>
					<li class="widget">
						<h4 class="widget-title">Blogroll</h4>
						<ul>
							<?php get_links(-1, '<li>', '</li>', 'between', FALSE, 'name', FALSE, FALSE, -1, FALSE); ?>
						</ul>
					</li>
					<?php endif ?>
				</ul>
			</div>
		</div><!-- /secondary -->
		<?php endif ?>	</div><!-- /sidebar -->
