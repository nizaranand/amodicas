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
	                  <em><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php _e('Continue Lendo','my') ?></a></em>
	                  </div>
                  <?php } ?>
                  
                  <div class="text <?php if(get_option('index_layout') == null) { echo "no"; } ?>">
                  <small><?php the_time('F jS') ?> <?php _e('em','my') ?> <?php the_category(', ') ?> <?php _e('por','my') ?> <?php the_author_posts_link(); ?><span class="comm"> . <?php comments_popup_link(__('nenhum comentário','my'), __('1 comment','my'), __('% comments','my')); ?></span> . <?php edit_post_link(__('Editar','my'), '', ' '); ?></small>
                  <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                  <em><?php the_excerpt(); ?></em>
                  <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>" class="comm"><?php _e('Continue Lendo','my') ?></a>
            			</div>
                        <div class="clear"></div>
                        </div>
		<?php endwhile; ?>
		<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
		
        
	<?php else :

		if ( is_category() ) { // If this is a category archive
			printf("<h2>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
		} else {
			echo("<h2 class='center'>No posts found.</h2>");
		}
		get_search_form();

	endif; ?>
      
        	</div>
        </div>
        
        
        <?php get_sidebar(); ?>

        <div class="clear"></div>
    </div>
    
</div>

<?php include('bottom.php'); ?>
<?php get_footer(); ?>
