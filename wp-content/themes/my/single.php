<?php get_header(); ?>
<div id="page_wrap" class="wrapper">
   
	<div id="page">
    	<div id="content_wrap">
        	<div id="content">
            
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
                <div id="post-<?php the_ID(); ?>" class="post">
                    	
                        <?php include('single_layout.php'); ?>
                        
                        <div id="extra">
                        	<div class="related">
                            	<h3><?php _e('Posts Relacionados','my') ?></h3>
                                <ul><?php include('related.php'); ?></ul>
                          </div>
                          <div class="clear"></div>
                        </div>
                        
                        
                </div>
        
                <?php comments_template('', true); ?>
        
                <?php endwhile; else: ?>
                    <div class="post">
                    <p><?php _e('Sorry, no posts matched your criteria.','my') ?></p>
                    </div>
                <?php endif; ?>
           	</div>
        </div>
        <?php get_sidebar(); ?>

        <div class="clear"></div>
    </div>
    
</div>
<?php include('bottom.php'); ?>
<?php get_footer(); ?>
