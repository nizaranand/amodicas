<?php get_header(); ?>
<div id="page_wrap" class="wrapper">
   
	<div id="page">
    	<div id="content_wrap">
        	<div id="content">
            
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
                <div id="post-<?php the_ID(); ?>" class="post">
                    	
                        <?php include('single_layout.php'); ?>
                        
                        <div id="extra">
                        	<div class="related">
                            	<h3><?php _e('Related Posts','my') ?></h3>
                                <ul><?php include('related.php'); ?></ul>
                          </div>
                          <div class="social">

                          	<a href="http://del.icio.us/post?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" id="delicious-button" title="Delicious"><?php _e('Delicious','my')?></a>
                              <a href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" id="stumble-button" title="Stumble"><?php _e('Stumble','my')?></a>
                              <a href="http://digg.com/submit?phase=2&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" id="digg-button" title="Digg"><?php _e('digg<','my')?>/a>
                              <a href="http://www.reddit.com/submit?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" id="redd-button" title="Reddit"><?php _e('Reddit','my')?></a>
                              <a href="http://www.mixx.com/submit?page_url=<?php the_permalink(); ?>" id="mixx-button" title="Mixx"><?php _e('Mixx','my')?></a>
                              <a href="http://twitter.com/home?status=<?php the_permalink(); ?>" id="twitt-button" title="Twitter"><?php _e('Twitter','my')?></a>
                              <a href="<?php the_permalink(); ?>feed" id="rss2-button" title="Subscribe"><?php _e('Subscribe','my')?></a>

                          </div>
                          <div class="clear"></div>
                        </div>
                        
                        
                </div>
        
                <?php comments_template('', true); ?>
        
                <?php endwhile; else: ?>
                    <div class="post">
                    <p><?php _e('Sorry, no posts matched your criteria.','my') ?></p>
                    </div>
                <?php endif; ?>
           	</div>
        </div>
        <?php get_sidebar(); ?>

        <div class="clear"></div>
    </div>
    
</div>
<?php include('bottom.php'); ?>
<?php get_footer(); ?>
