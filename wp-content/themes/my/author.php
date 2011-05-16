<?php get_header(); ?>
<div id="page_wrap" class="wrapper">
 
	<div id="page">
    	<div id="content_wrap">
        	<div id="content">
    	<?php while (have_posts()) : the_post(); $loopcounter++; ?>
    	<?php if ($loopcounter <= 1) { ?>
        <div class="post">
        <div class="author">
			<?php 
            echo get_avatar( get_the_author_id(), '80', 'http://www.gravatar.com/avatar/46c25d7d8f2e19fa2bec248f763a11bd?s=80'); ?>
            <div class="author-text">
                <strong><?php the_author_posts_link(); ?></strong>
                <p><?php the_author_meta('description'); ?></p> 
                <p><small><?php if (get_the_author_meta('url')) { ?><a href="<?php the_author_meta('url'); ?>"><?php _e('VIsit','my')?> <?php the_author(); ?>'<?php _e('s website','my')?></a><?php } else { } ?></small></p>
                
        </div>
        <div class="clear"></div>
        </div>
        </div> 
        <div class="post">  
        <ul class="search">
	<?php } ?>
    	<li>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php image_management('thumb-post-thumbnail', 50, 50) ?>
        </a>
        <h3><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h3>
        <small><?php the_time('F jS, Y') ?></small>
        <div class="clear"></div>
        </li>
    <?php endwhile; ?> 
    
    </ul> 
    </div>
    <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>  
           		</div>
        </div>
        <?php get_sidebar(); ?>

        <div class="clear"></div>
    </div>
    
</div>

<?php include('bottom.php'); ?>
<?php get_footer(); ?>