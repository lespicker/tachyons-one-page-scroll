<?php get_header(); ?>
<div id="site_content">
	<div id="content" class="narrowcolumn">
<?php
 //Code automatically inserted by Featurific for Wordpress plugin
 if(is_home())                             //If we're generating the home page (remove this line to make Featurific appear on all pages)...
  if(function_exists('insert_featurific')) //If the Featurific plugin is activated...
   insert_featurific();                    //Insert the HTML code to embed Featurific
?>
	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

                    <div class="post">
				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				<p class="comment_edit"> <?php edit_post_link('Edit', '<span class="edit_link">', '</span>'); ?>  <span class="comment_link"><?php comments_popup_link('0 Comments', '1 Comment', '% Comments'); ?> </span></p>
				<div class="time_link"><?php the_time('F jS, Y') ?> in <?php the_category(', ') ?>  by <?php the_author() ?></div>


				<div class="entry">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
				</div>
				<?php the_tags('Tags: ', ', ', ''); ?>
				<p class="postmetadata"></p>
			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
