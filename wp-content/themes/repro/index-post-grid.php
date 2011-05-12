<?php include( TEMPLATEPATH . '/functions/get-options.php' ); /* include theme options */ ?>

<div class="post_grid">

    <h4><span><?php echo ($tz_post_grid_title); ?></span></h4>
    
   <?php $gc = 0; ?>

    <ul>
    	<?php 
		$query = new WP_Query();
		$query->query('caller_get_posts=1&showposts=' . $tz_post_grid_number .'&tag=grid');
		if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
		
		<?php $gc++; ?>
        
        <li<?php if($gc == 8 || $gc == 16 || $gc == 24 || $gc == 32 ) : ?> class="last"<?php endif; ?>>
		
		<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ ?>
        
        <a class="tooltip" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-grid'); ?></a>
        
        <?php endif; ?>
        
         </li>
        
        <?php endwhile; else: ?>
    
        <p><?php _e('No posts found.', 'framework'); ?></p>
        
        <?php endif; ?>
        
        <?php wp_reset_query(); ?>
        
    </ul>

</div><!--post_grid-->