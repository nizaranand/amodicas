<?php include( TEMPLATEPATH . '/functions/get-options.php' ); /* include theme options */ ?>

<?php get_header(); ?>

<div id="the_body">
    
    <div class="container_12">
        
        <div class="grid_8" id="archive">
            
            <div class="grid_8 alpha omega">
                
                <?php if ( function_exists('yoast_breadcrumb') ) : ?> <div class="breadcrumb"><?php yoast_breadcrumb(); ?></div><!--breadcrumb-->
                
                <?php else : /* if yoast_breadcrumb is not available, use a generic title */ ?> 
                
                <?php /* If this is a category archive */ if (is_category()) { ?>
                    <div class="description"><h1><?php printf(__('All posts in %s', 'framework'), single_cat_title('',false)); ?></h1></div>
                <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
                    <div class="description"><h1><?php printf(__('All posts tagged %s', 'framework'), single_tag_title('',false)); ?></h1></div>
                <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
                    <div class="description"><h1><?php _e('Archive for', 'framework') ?> <?php the_time('F jS, Y'); ?></h1></div>
                 <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
                    <div class="description"><h1><?php _e('Archive for', 'framework') ?> <?php the_time('F, Y'); ?></h1></div>
                <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
                    <div class="description"><h1><?php _e('Archive for', 'framework') ?> <?php the_time('Y'); ?></h1></div>
                <?php /* If this is an author archive */ } elseif (is_author()) { ?>
                    <div class="description"><h1><?php _e('All posts by', 'framework') ?> <?php echo $curauth->display_name; ?></h1></div>
                <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                    <div class="description"><h1><?php _e('Blog Archives', 'framework') ?></h1></div>
                <?php } ?>
                
                <?php endif; ?>
                
                <div class="description archive">
                
                    <?php echo category_description(); ?>
                     
                </div><!--description-->
                
                <div class="clear"></div>
                
            </div><!--grid_8 alpha omega-->
            
            <?php $first = 1; // This variable applies a class further down the line. ?>
            <?php $i = 1; // This variable will help us display three different styles of posts ?>

            <div class="grid_8 alpha omega">
                
                <?php if (have_posts()) : ?>
            
                <?php while (have_posts()) : the_post(); ?> 
                
                <?php if($i == 1 && $paged < 2): // If this is the first post and on the first page then display the large pox style ?>
            
                <div id="slider">

                    <div class="item">
                                
                        <?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ ?>
                
                        <div class="slider_image">
                
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('slider-preview'); ?></a>
                        
                        </div><!--slider_image-->
                        
                        <?php endif; ?>
                        
                        <div class="details">
                        
                            <div class="cats"><span><?php _e('Latest', 'framework'); ?></span></div><!--cats-->
                            
                            <div class="header"><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2></div><!--header-->
                            
                            <div class="date"><?php the_time( get_option('date_format') ); ?>, <?php comments_popup_link(__('No comments', 'framework'), __('1 Comment', 'framework'), __('% Comments', 'framework')); ?> </div><!--date-->
                            
                            <div class="excerpt">
                                <?php the_excerpt(); ?>
                            </div><!--excerpt-->
                        
                        </div><!--details-->
                       
                    </div><!--item-->
                    
                </div><!--slider-->

                <?php elseif($i > 1 && $i < 5 && $paged < 2): // If this is the second, third or fourth post and on the first page, then display in columns. ?>
                
                <div class="post_columns">
                
                    <div class="column <?php if($i == 4) : ?>last<?php endif; ?>">
                    
                        <?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ ?>
    
                        <div class="image"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('column-preview'); ?></a></div>
                        
                        <?php endif; ?>
                        
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        
                        <div class="date"><?php the_time( get_option('date_format') ); ?>, <?php comments_popup_link(__('No comments', 'framework'), __('1 Comment', 'framework'), __('% Comments', 'framework')); ?></div>
                        
                        <div class="excerpt">
                            <p><?php echo substr(get_the_excerpt(), 0, 500); ?>
                               <?php if(strlen(get_the_excerpt()) > 500) : ?>...<?php endif; ?> </p>
                        </div><!--excerpt-->
                    
                    </div><!--column-->
                
                </div><!--post_columns-->
                    
                <?php elseif($i > 4 || $paged > 1): // If this is the fifth or more post OR is NOT on the first page then display as normal. ?>

                    <div class="full_posts">
                
                    <ul>
                        <li <?php if($first == 1): // Apply first class ?>class="first"<?php endif; ?>>
                            <?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ ?>
    
                            <div class="image"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('archive-preview'); ?></a></div>
                            
                            <?php endif; ?>
                            
                            <div class="details">
                                <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                <span class="date"><?php the_time( get_option('date_format') ); ?>, <?php comments_popup_link(__('No comments', 'framework'), __('1 Comment', 'framework'), __('% Comments', 'framework')); ?></span>
                                
                                <p><?php echo substr(get_the_excerpt(), 0, 500); ?>
                                <?php if(strlen(get_the_excerpt()) > 500) : ?>...<?php endif; ?> </p>
                                
                            </div><!--details-->
                            <div class="clear"></div>
                        </li>

                    </ul>

                    <div class="clear"></div>
                    
                </div><!--full_posts-->
                
                <?php $first++; // Add one count to the first variable ?>
                
                <?php endif; ?>

                <?php $i++; ?>

            	<?php endwhile; else: ?>
                
                <div class="description"><h1><?php _e('Error 404 - Not Found', 'framework') ?></h1></div>
        
                <div class="error">
                    
                    <p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>
                    <?php get_search_form(); ?>
                
                </div>
            
            	<?php endif; ?>
                
                <?php wp_reset_query(); ?>
            
            	<div class="grid_8 alpha omega">

                    <div class="pagination">
                        
                        <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
                            <div class="nav-next"><?php next_posts_link(__('&larr; Older Entries', 'framework')) ?></div>
                            <div class="nav-previous"><?php previous_posts_link(__('Newer Entries &rarr;', 'framework')) ?></div>
                        <?php } ?>
                    
                    </div><!--pagination-->
                
                </div><!--grid_8 alpha omega-->

        		<div class="clear"></div>
        
        	</div><!--grid_8 alpha omega-->
        
        </div><!--grid_8-->
        
        <div class="grid_4">
        
            <?php get_sidebar(); ?>
          
        </div><!--grid_4-->

        <div class="clear"></div>
        
    </div><!--container_12-->

</div><!--the_body-->

<?php get_footer(); ?>