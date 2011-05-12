<?php include( TEMPLATEPATH . '/functions/get-options.php' ); /* include theme options */ ?>

<?php /* Category credentials */
$category_name = $tz_cat_two_select;
$category_id = get_cat_ID( $category_name );
$category_link = get_category_link( $category_id ); 
?>

<div class="category_list">
                    
    <h4><span><a href="<?php echo ($category_link); ?>" title="<?php echo ($category_name); ?>"><?php echo ($category_name); ?></a></span></h4>
    
    <ul>
    	<?php 
		$query = new WP_Query();
		$query->query('caller_get_posts=1&posts_per_page=' . $tz_cat_two_number . '&cat=' . $category_id);
		if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
    
        <li>
        
			<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ ?>
            
            <div class="image"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('category-thumbnail'); ?></a></div>
            
            <?php endif; ?>
            
            <div class="details">
                <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <span class="date"><?php the_time( get_option('date_format') ); ?>, <?php comments_popup_link(__('No comments', 'framework'), __('1 Comment', 'framework'), __('% Comments', 'framework')); ?></span>
            </div><!--details-->
            
        </li>
        
        <?php endwhile; else: ?>
    
        <p><?php _e('No posts found.', 'framework'); ?></p>
        
        <?php endif; ?>
        
        <?php wp_reset_query(); ?>

    </ul>

</div><!--category_list-->