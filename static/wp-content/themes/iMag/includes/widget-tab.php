<div id="tab-content">
	<ul class="tabnav">
		<li><a href="#recent-entries"><span>recent entries</span></a></li>
		<li><a href="#recent-comments"><span>recent comments</span></a></li>
		<li class="last"><a href="#archieves"><span>archieves</span></a></li>
	</ul>

	<div id="recent-entries"><div class="tabs-container-top">
		<ul>
			<?php mdv_recent_posts(9) ?>
		</ul>
	</div>
	<div class="tabs-container-bottom"></div>
	</div><!--/recent-entries-->

	<div id="recent-comments"><div class="tabs-container-top">
		<ul>
			<?php src_simple_recent_comments(9) ?>
		</ul>
	</div>
	<div class="tabs-container-bottom"></div>
	</div><!--/recent-comments-->

	<div id="archieves"><div class="tabs-container-top">
		<ul>
			<?php wp_get_archives('type=monthly&limit=9'); ?>
		</ul>
	</div>
	<div class="tabs-container-bottom"></div>
	</div><!-- /archieves -->
	<div class="clear"></div>
</div><!-- /tab-content -->
