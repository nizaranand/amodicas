</div>
<div id="bottom">
<?php
	$cat1Posts = new WP_Query();
	$cat1Posts->query('showposts=1&orderby='.get_option('mywp_mode').'&cat='.get_cat_id(get_option('cat1')));
	$cat1bPosts = new WP_Query();
	$cat1bPosts->query('showposts=5&orderby='.get_option('mywp_mode').'&cat='.get_cat_id(get_option('cat1')));
	$cat2Posts = new WP_Query();
	$cat2Posts->query('showposts=1&orderby='.get_option('mywp_mode').'&cat='.get_cat_id(get_option('cat2')));
	$cat2bPosts = new WP_Query();
	$cat2bPosts->query('showposts=5&orderby='.get_option('mywp_mode').'&cat='.get_cat_id(get_option('cat2')));
?>
	<div class="wrapper">
  	<div id="sub">
  		<?php function bottom_logo() { if(get_option('mywp_bottom_logo') <> null ) { echo get_option('mywp_bottom_logo'); } else { echo show_logo(); }} ?>
  		<a href="<?php bloginfo('url'); ?>" id="logo2"><img src="<?php echo bottom_logo(); ?>" alt="<?php bloginfo('blogname'); ?>" /></a>
      
      <?php  if(get_option('mywp_quote') <> null )
      	{
          echo '<span>';
          echo stripslashes(get_option('mywp_quote'));
          echo '</span>';
          }
      ?>
            
		</div>
    
    <div id="all">
    	
      <div class="random">
      	<h3><?php echo get_option('cat1'); ?></h3>
      	<?php if(get_option('index_layout') == null) { } else { ?>
        <?php while ($cat1Posts->have_posts()) : $cat1Posts->the_post(); ?> 
        
        
        <div class="first">
        	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        		<?php image_management('med-post-thumbnail',200,100) ?>
        	</a>
        </div>
        
        <?php endwhile; } ?>
        
        <ul>
        	<?php while ($cat1bPosts->have_posts()) : $cat1bPosts->the_post();?>
        		<li>
        			<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a>
        		</li>
        	<?php endwhile; ?>
        </ul>
      </div>
      
      <div class="random">
      	<h3><?php echo get_option('cat2'); ?></h3>
      	<?php if(get_option('index_layout') == null) { } else { ?>
        <?php while ($cat2Posts->have_posts()) : $cat2Posts->the_post(); ?> 
        
        
        <div class="first">
        	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        		<?php image_management('med-post-thumbnail',200,100) ?>
        	</a>
        </div>
        <?php endwhile; } ?>
        
        <ul>
        	<?php while ($cat2bPosts->have_posts()) : $cat2bPosts->the_post(); ?>
        		<li>
       		 		<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a>
       	 		</li>
        	<?php endwhile; ?>
        </ul>
      </div>
      <div class="random">
      <?php
			  if ( is_active_sidebar( 'sidebar-2' ) ) : 
			  	dynamic_sidebar( 'sidebar-2' );
			  endif;
			?>
     </div>
    </div>
    
    <div class="clear"></div>
</div>