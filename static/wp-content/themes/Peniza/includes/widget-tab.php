<div id="tab-content" class="clearfix">
	<ul class="tabnav">
		<li><a href="#recent-entries"><span>recent entries</span></a></li>
		<li><a href="#recent-comments"><span>recent comments</span></a></li>
		<li class="last"><a href="#archives"><span>archives</span></a></li>
	</ul>

	<div id="recent-entries">
		<ul>
			<?php mdv_recent_posts(9) ?>
		</ul>
	</div><!--/recent-entries-->

	<div id="recent-comments">
		<ul>
			<?php src_simple_recent_comments(9) ?>
		</ul>
	</div><!--/recent-comments-->

	<div id="archives">
		<ul>
			<?php wp_get_archives('type=monthly&limit=9'); ?>
		</ul>
	</div><!-- /archives -->
</div><!-- /tab-content -->
