<?php get_header(); ?>

		<div class="postWrap">
		
		<?php /* If this is a category archive */ if (is_category()) { ?>
        <div class="post archiveTitle">
            <div>
                <h2 class="currentCat">You are currently browsing <span><?php single_cat_title(); ?></span></h2>
                <?php echo category_description( $category ); ?>
                
                <h3>Browse archive...</h3>
                
                <ul class="list">
                <?php 
                wp_list_categories('title_li='); ?>
                </ul>
                
                <p class="back"><a href="<?php bloginfo('url'); ?>">&larr; Back to Homepage</a></p>
            </div>
        </div>
        
        <?php /* If this is a category archive */ } elseif (is_tag()) { ?>
        <div class="post archiveTitle">
            <div>
                <h2>Tagged <?php single_tag_title(); ?></h2>
                <p class="back"><a href="<?php bloginfo('url'); ?>">&larr; Back to Homepage</a></p>
            </div>
        </div>
        
        <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
        <div class="post archiveTitle">
            <div>
                <h2 class="spaced">Work from <?php the_time('F, Y'); ?></h2>
                
                <h3>Browse archive...</h3>
                
                <ul class="list">
                <?php wp_get_archives(); ?>
        
                </ul>
                
                <p class="back"><a href="<?php bloginfo('url'); ?>">&larr; Back to Homepage</a></p>
            </div>
        </div> <?php } ?>
        
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
                    	Filed under: <?php the_category(' | ') ?>
                        </small>
                    </div>
                </div>
        
            </div>

		<?php endwhile; ?>
        
        <?php next_posts_link('<div class="post archiveTitle "><div>&larr; Older</div></div>') ?>
        <?php previous_posts_link('<div class="post archiveTitle "><div>Newer &rarr;</div></div>') ?>

	<?php else : ?>
    
    <div class="post archiveTitle">
            <div><div>
                <h2>Not Found</h2>
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
