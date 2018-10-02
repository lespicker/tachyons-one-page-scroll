<?php get_header(); ?>

	<div class="postWrap">

    <?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
        
        <div class="post">
            <div>
                <div class="post-header"><a href="<?php the_permalink() ?>">
                <?php if ( p75HasThumbnail($post->ID) ) { ?>
                    <img src="<?php echo p75GetThumbnail($post->ID, 200, 200); ?>" alt="<?php the_title(); ?> thumbnail image" width="200px" height="200" />
                <?php  } ?>
                </a></div>
        
                <div class="post-content">
                    <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                    <p><?php the_excerpt_reloaded(50, 'none', TRUE, '...', FALSE, 1); ?></p>
                    <p><a href="<?php the_permalink() ?>">View <?php the_title(); ?></a></p>
                </div>
        
                <div class="post-footer">
                    <small>Published on <?php the_time('M d, Y'); ?><br />
                    Filed under: <?php the_category(' | ') ?>
                    </small>
                </div>
            </div>
    
        </div>
        <!--    -->


    <?php endwhile; ?>
    
    
    <?php next_posts_link('<div class="post archiveTitle "><div>&larr; Older</div></div>') ?>
    <?php previous_posts_link('<div class="post archiveTitle "><div>Newer &rarr;</div></div>') ?>
        

	<?php else : ?>
    
    <div class="post">
        <div>
            <h1>Not Found</h1>
            <p>Sorry, but you are looking for something that isn't here.</p>
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
