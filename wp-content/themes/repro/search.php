<?php include( TEMPLATEPATH . '/functions/get-options.php' ); /* include theme options */ ?>

<?php get_header(); ?>

<div id="the_body">
    
        <div class="container_12">
            
            <div class="grid_8" id="archive">
            	
                <div class="grid_8 alpha omega">
                	
                    <div class="description"><h1><?php _e('Search Results', 'framework') ?></h1></div>
                    
                    <div class="clear"></div>
                    
                </div><!--grid_8 alpha omega-->

                <div class="grid_8 alpha omega"> 	
                
                    <div class="full_posts">
                    
                    	<ul>
                        	
                            <?php $i = 1; ?>
                            
                        	<?php if (have_posts()) : ?>
            
               				<?php while (have_posts()) : the_post(); ?> 
                            
                            <li <?php if ($i == 1) : ?>class="first"<?php endif; ?>>
                                <?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : ?>
        
                                <div class="image"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('archive-preview'); ?></a></div>
                                
                                <?php endif; ?>
                                
                                <div class="details <?php if (  !has_post_thumbnail() ) : ?>no_thumb<?php endif; ?>">
                                    <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                    <span class="date"><?php the_time( get_option('date_format') ); ?>, <?php comments_popup_link(__('No comments', 'framework'), __('1 Comment', 'framework'), __('% Comments', 'framework')); ?></span>
                                    
                                    <p><?php echo substr(get_the_excerpt(), 0, 240); ?>
               						<?php if(strlen(get_the_excerpt()) > 240) : ?>...<?php endif; ?> </p>
                                    
                                </div><!--details-->
                                <div class="clear"></div>
                            </li>
							
                            <?php $i++; ?>
                            
                            <?php endwhile; ?>
                            
                            <?php else: ?>
                    		
                            <li class="first">
                            
                            	<div class="description">
                            
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
                            
                            	</div><!--description-->
                                
                            </li>
                            
                            <?php endif; ?>	
                            
                        </ul>

                        <div class="clear"></div>
                        
                    </div><!--full_posts-->

                
                
                </div><!--grid_8 alpha omega-->
                
                
                <?php wp_reset_query(); ?>
                
                <div class="grid_8 alpha omega">

                    <div class="pagination">
                        
                        <?php if ( function_exists('wp_pagenavi') ) { wp_pagenavi(); } else { ?>
                            <div class="nav-next"><?php next_posts_link(__('&larr; Older Entries', 'framework')) ?></div>
                            <div class="nav-previous"><?php previous_posts_link(__('Newer Entries &rarr;', 'framework')) ?></div>
                        <?php } ?>
                    
                    </div><!--pagination-->
                
                </div><!--grid_8 alpha omega-->
            
                <div class="clear"></div>
        
            </div><!--grid_8-->
            
            <div class="grid_4">
            
				<?php get_sidebar(); ?>
              
            </div><!--grid_4-->
    
            <div class="clear"></div>
            
        </div><!--container_12-->
    
    </div><!--the_body-->

<?php get_footer(); ?>