		</div><!-- /content -->

		<div id="sidebar">
			<ul>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : ?>
			<li class="widget"><div class="widget-top">
				<h4 class="widget-title">Meta</h4><span class="toggle"></span>
				<div class="widget-content">
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<li><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
					<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
					<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
					<?php wp_meta(); ?>
				</ul>
				</div>
				</div>
				<div class="widget-bottom"></div>
			</li>
			<?php endif ?>
			</ul>
		</div><!-- /sidebar -->
