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
                    
                    <div class="meta">
                    
                    	<?php _e('Written by', 'framework') ?> <?php the_author_posts_link(); ?> <?php _e('on', 'framework') ?> <?php the_time( get_option('date_format') ); ?> <?php _e('in', 'framework'); ?> <?php the_category(', '); ?> - <?php comments_popup_link(__('No comments', 'framework'), __('1 Comment', 'framework'), __('% Comments', 'framework')); ?>
                    
                    </div><!--meta-->
                    
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
                
                
                <?php if /* if the author bio is checked in admin options then show the author bio box */ ($tz_author_bio == "true") : ?>
                
                <div class="grid_8 alpha omega">
                	
                    <div id="author">
                    
                		<h4><span><?php _e('About the Author', 'framework'); ?></span></h4>
                        
                        <div class="image"><?php echo get_avatar( get_the_author_email(), '80' ); ?></div>
                        
                        <p><?php the_author_meta("description"); ?></p>
                        
                        <div class="clear"></div>
                        
                	</div><!--author-->
                    
                </div><!--grid_8 alpha omega-->
                
                <?php endif; ?>
                
                <?php endwhile; else: ?>
                    
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
                </div>
                <?php endif; ?>	
                
                <?php wp_reset_query(); ?>
                
                <?php if /* if the author bio is checked in admin options then show the author bio box */ ($tz_show_related == "true") : ?>

                <div class="grid_8 alpha omega">
                	
                    <div id="related">
                    
                    	<h4><span><?php _e('Related Posts', 'framework'); ?></span></h4>
                        
                        <?php $i = 1; ?>

                        <?php if($tz_related_type == 'tags') : ?>
                        
						<?php
                        global $post;
                        $tags = wp_get_post_tags($post->ID);
                        if ($tags) :
                            $tag_ids = array();
                            foreach($tags as $individual_tag){ $tag_ids[] = $individual_tag->term_id;}
                        
                            $args=array(
                                'tag__in' => $tag_ids,
                                'post__not_in' => array($post->ID),
                                'showposts'=>$tz_related_number, // Number of related posts that will be shown.
                                'caller_get_posts'=>1
                            );
                            $my_query = new wp_query($args);
                            if( $my_query->have_posts() ) :
                                while ($my_query->have_posts()) :
                                    $my_query->the_post();
                        ?>
                        <div class="column <?php if($i == 4 || $i == 8 || $i == 12 ): ?>last<?php endif; ?>">
                        
                        	<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ ?>
        
							<div class="image"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('related-thumbnail'); ?></a></div>
                            
                            <?php endif; ?>
                            
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        
                        </div><!--column-->
                        
                        <?php $i++; ?>
                        
                        <?php endwhile; endif;// tags loop ?>
                        
                        <?php endif; // if have tags ?>

                        <?php else: // if type is categories ?>
                        
                        <?php
                        global $post;
                        $cats = get_the_category($post->ID);
                        if ($cats) :
                            $cat_ids = array();
                            foreach($cats as $individual_cat){ $cat_ids[] = $individual_cat->cat_ID;}
                        
                            $args=array(
                                'category__in' => $cat_ids,
                                'post__not_in' => array($post->ID),
                                'showposts'=>$tz_related_number, // Number of related posts that will be shown.
                                'caller_get_posts'=>1
                            );
                            $my_query = new wp_query($args);
                            if( $my_query->have_posts() ) :
                                while ($my_query->have_posts()) :
                                    $my_query->the_post(); 
						?>
                        
                        <div class="column <?php if($i == 4 || $i == 8 || $i == 12 ): ?>last<?php endif; ?>">
                        
                        	<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ ?>
        
							<div class="image"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('related-thumbnail'); ?></a></div>
                            
                            <?php endif; ?>
                            
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        
                        </div><!--column-->
                        
                        <?php $i++; ?>
                        
                        <?php endwhile; endif;// tags loop ?>
                        
                        <?php endif;// if cats ?>
                        
                        <?php endif;// if type is category ?>
                        
                        <?php wp_reset_query(); ?>
                    	
                   		<div class="clear"></div>
                    
                    </div><!--related-->
                    
                </div><!--grid_8 alpha omega-->
                
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