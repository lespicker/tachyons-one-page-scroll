<?php get_header(); ?>
	
		<div class="postWrap">

        <?php if (have_posts()) : ?>

    		<?php while (have_posts()) : the_post(); ?>
    		  <div class="post">
                <div>
                    <div class="post-header"><a href="<?php the_permalink() ?>">
                    <?php if ( p75HasThumbnail($post->ID) ) { ?>
                        <img src='<?php echo p75GetThumbnail($post->ID, 200, 200); ?>' alt='<?php the_permalink() ?> thumbnail image' />
                    <?php  } ?>
					</a></div>
            
                    <div class="post-content">
                        <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                        <p><?php the_excerpt_reloaded(50, '', 'none', FALSE, '...', FALSE, 2); ?></p>
                       	<p><a href="<?php the_permalink() ?>">View <?php the_title(); ?></a></p>
                    </div>
            
                    <div class="post-footer">
                    	<small>Published on <?php the_time('M d, Y'); ?><br />
                    	Filed under: <?php the_category(' | ') ?></a>
                        </small>
                    </div>
                </div>
        
            </div>
            
			<?php
			/*
            <div class="postMeta">
        
			<?php if ('closed' == $post->comment_status) : ?>
    
              <div class="comments closed">
    
                <?php else : ?>
            
              <div class="comments">
            
              	<?php endif; ?>
    
                <?php comments_popup_link('leave a comment', '1 comment', '% comments', '', 'comments closed'); ?>
              </div>
            </div>
			*/
			?>

		<?php endwhile; ?>

	<?php else : ?>
    
    <div id="coreContent">
		<div class="whiteBlock clearfix">
            <div>
                <h1>Not Found</h1>
                <p>Sorry, but you are looking for something that isn't here.</p>
            </div>
        </div>
     </div>

	<?php endif; ?>
    
    <div class="post copyright">
        <div>
           <p>FolioGrid - a <a href="http://www.frogsthemes.com">Premium Wordpress Theme</a> by FrogsThemes.com</p>
        </div>
    </div>

	</div>

<?php get_footer(); ?>

