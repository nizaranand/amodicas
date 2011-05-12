<?php include( TEMPLATEPATH . '/functions/get-options.php' ); /* include theme options */ ?>

<?php get_header(); ?>

<div id="the_body">
    
        <div class="container_12">
            
            <div class="grid_8" id="archive">
            	
                <?php if (have_posts()) : while (have_posts()) : the_post();?>
                
                <div class="grid_8 alpha omega">
                
                    <?php if ( function_exists('yoast_breadcrumb') ) : ?> <div class="breadcrumb"><?php yoast_breadcrumb(); ?></div><!--breadcrumb--><?php endif; ?>
                    
                    <div class="description">
                    
                        <h1><?php the_title(); ?></h1>
                         
                    </div><!--description-->
                    
                    <div class="clear"></div>
                    
                </div><!--grid_8 alpha omeg-->
            	
                <div class="grid_8 alpha omega">
                
                	<div id="content">
                    	
                        <?php if($tz_image_display == 'true') : ?>
                        
                    	<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ ?>
        
                        <?php the_post_thumbnail('single-large'); ?>
                        
                        <?php endif; ?>
                        
                        <?php endif; ?>
                        
                        <?php the_content(); ?>
                        
                        <div class="clear"></div>
                    
                    </div><!--content-->

                </div><!--grid_8 alpha omega-->
                
                <?php endwhile; else: ?>
                
                <?php wp_reset_query(); ?>
                
                <?php endif; ?>
                                
                <?php comments_template('', true); ?>

            </div><!--grid_8-->
            
            <div class="grid_4">
            
				<?php get_sidebar(); ?>
              
            </div><!--grid_4-->
    
            <div class="clear"></div>
            
        </div><!--container_12-->
    
    </div><!--the_body-->

<?php get_footer(); ?>