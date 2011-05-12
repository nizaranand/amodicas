<div id="slider">
    
    <div id="coda_slider">
        
        <div class="item">
        
            <div class="coda-slider preload" id="coda-slider-1">
                
                <?php 
				$query = new WP_Query();
				$query->query('tag=slider&posts_per_page=6');
				if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                
                <div class="panel">
                    
                    <?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ ?>
                    
                    <div class="slider_image">
            
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('slider-preview'); ?></a>
                    
                    </div><!--slider_image-->
                    
                    <?php endif; ?>
                    
                    <div class="details">
                    
                        <div class="cats"><span><?php _e('Featured', 'framework'); ?></span></div><!--cats-->
                        
                        <div class="header"><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2></div><!--header-->
                        
                        <div class="date"><?php the_time( get_option('date_format') ); ?>, <?php comments_popup_link(__('No comments', 'framework'), __('1 Comment', 'framework'), __('% Comments', 'framework')); ?> </div><!--date-->
                        
                        <div class="excerpt">
                            <?php the_excerpt(); ?>
                        </div><!--excerpt-->
                    
                    </div><!--details-->
                    
                </div><!--panel-->
                
                <?php endwhile; endif; ?>
                
                <?php wp_reset_query(); ?>
                
                <div class="clear"></div>
                
            </div><!--coda-slider-->
                
            <div class="clear"></div>
                
        </div><!--item-->
        
        <div class="clear"></div>
        
    </div><!--coda_slider-->
    
    <div id="slider_nav">
        
        <div id="coda-nav-1" class="coda-nav">
        
            <ul>
            
            	<?php 
				$count = 1;
				if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                
                <?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ ?>
                
                <li class="tab<?php echo $count; ?>">
                
                    <a href="#<?php echo $count; ?>"><?php the_post_thumbnail('slider-thumbnail'); ?></a>
                    
                </li>
                
                <?php $count++; ?>
                
                <?php endif; ?>
                
                <?php endwhile; else: ?>
    
                <p><?php _e('No posts found.', 'framework'); ?></p>
                
                <?php endif; ?>
                
                <?php wp_reset_query(); ?>
                
            </ul>
            
        </div><!--coda-nav-5-->
        
    </div><!--slider_nav-->
    
    <div class="clear"></div>
    
</div><!--slider-->