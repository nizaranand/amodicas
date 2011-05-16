<?php get_header(); ?>
<div id="page_wrap" class="wrapper">
    
	<div id="page">
    	<div id="content_wrap">
        	<div id="content">
    		<div class="post">
			<?php if (have_posts()) : ?>
	
            <ul class="search">
            <?php while (have_posts()) : the_post(); ?>
    
                
            <li>
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <?php if(get_option('index_layout') == null) { 
            } else { 
							image_management('thumb-post-thumbnail', 50, 50); }
						?>
            </a>
            <h3><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h3>
            <small><?php the_time('F jS, Y') ?></small>
            <div class="clear"></div>
            </li>
            <?php endwhile; ?>
            </ul>
		
		<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>

		<?php else : ?>
    
            <h2><?php _e('No posts found. Try a different search?','my')?></h2>
            
        <?php endif; ?>
        </div>        
        </div>
        </div>
        <?php get_sidebar(); ?>

        <div class="clear"></div>
    </div>
    
</div>

<?php include('bottom.php'); ?>
<?php get_footer(); ?>