<?php
/*
Template Name: Links
*/
?>

<?php get_header(); ?>

<div id="content">

<ul id="links">
<li>
<ul>
<?php wp_list_bookmarks('title_before=<h6>&title_after=</h6>'); ?>
</ul>		
</li>
</ul><!-- LINKS END -->

</div><!-- CONTENT END -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>