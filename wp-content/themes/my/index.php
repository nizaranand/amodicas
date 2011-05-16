<?php get_header(); ?>

<div id="page_wrap" class="wrapper">

	<div id="page">
    	<div id="content_wrap">
        	<div id="content">
						<?php if (have_posts()) : ?>
            
              <?php while (have_posts()) : the_post(); ?>
      
              <div class="post" id="post-<?php the_ID(); ?>">
              
                  <?php if(get_option('index_layout') <> null) { ?>
	                  <div class="thumb">
	                  <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
	                  <?php image_management('normal-post-thumbnail',200,200); ?>
	                  </a>
	                  
	                  <span><?php comments_popup_link('0', '1', '%'); ?></span>
	                  <em><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php _e('Continue Reading','my') ?></a></em>
	                  </div>
                  <?php } ?>
                  
                  <div class="text <?php if(get_option('index_layout') == null) { echo "no"; } ?>">
                  <small><?php the_time('F jS') ?> <?php _e('in','my') ?> <?php the_category(', ') ?> <?php _e('by','my') ?> <?php the_author_posts_link(); ?><span class="comm"> . <?php comments_popup_link(__('no comment','my'), __('1 comment','my'), __('% comments','my')); ?></span> . <?php edit_post_link(__('Edit','my'), '', ' '); ?></small>
                  <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                  <em><?php the_excerpt(); ?></em>
                  <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>" class="comm"><?php _e('Continue Reading','my') ?></a>
				
      				</div>
              <div class="clear"></div>
              </div>
              <?php endwhile; ?>
						<?php endif; ?>
            <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
          </div><!-- end content div -->
        </div><!-- end content_wrap div -->
        
        <?php get_sidebar(); ?>

        <div class="clear"></div>
    </div><!-- end page div -->
    
</div><!-- end page_wrap div -->

<?php include('bottom.php'); //bottome 3 colomns ?>
<?php get_footer(); ?>