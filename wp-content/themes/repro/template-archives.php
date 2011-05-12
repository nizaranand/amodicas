<?php
/*
Template Name: Archives
*/
?>

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

                        <?php the_content(); ?>
                        
                        <h4><?php _e('Last 30 Posts', 'framework') ?></h4>
						
						<ul>
						<?php $archive_30 = get_posts('numberposts=30');
						foreach($archive_30 as $post) : ?>
							<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
						<?php endforeach; ?>
						</ul>
						
						<h4><?php _e('Archives by Month:', 'framework') ?></h4>
						
						<ul>
							<?php wp_get_archives('type=monthly'); ?>
						</ul>
			
						<h4><?php _e('Archives by Subject:', 'framework') ?></h4>
						
						<ul>
					 		<?php wp_list_categories( 'title_li=' ); ?>
						</ul>
                        
                        <div class="clear"></div>
                    
                    </div><!--content-->

                </div><!--grid_8 alpha omega-->
                
                <?php endwhile; else: ?>
                
                <div class="error">
                    
				<?php
                
                if ( is_category() ) { // If this is a category archive
                    printf(__('<h1>Sorry, but there aren\'t any posts in the %s category yet.</h1>', 'framework'), single_cat_title('',false));
                } else if ( is_date() ) { // If this is a date archive
                    echo(__('<h1>Sorry, but there aren\'t any posts with this date.</h1>', 'framework'));
                } else if ( is_author() ) { // If this is a category archive
                    $userdata = get_userdatabylogin(get_query_var('author_name'));
                    printf(__('<h1>Sorry, but there aren\'t any posts by %s yet.</h1>', 'framework'), $userdata->display_name);
                } else {
                    echo(__('<h1>No posts found.</h1>', 'framework'));
                }
                get_search_form();
                ?>
                </div>
                
                <?php endif; ?>	
                
                <?php wp_reset_query(); ?>

            </div><!--grid_8-->
            
            <div class="grid_4">
            
				<?php get_sidebar(); ?>
              
            </div><!--grid_4-->
    
            <div class="clear"></div>
            
        </div><!--container_12-->
    
    </div><!--the_body-->

<?php get_footer(); ?>