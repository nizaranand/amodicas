<div class="tabs col">
<ul class="sidetab-head">
<li><a href="#c1"><?php _e('Populares','my') ?></a></li>
<li><a href="#c2"><?php _e('Comentários','my') ?></a></li>
</ul>

<div id="c1" class="sidetabdiv">
  <ul>
  	<?php 
  	$popPosts = new WP_Query();
		$popPosts->query('showposts='.get_option('mc2').'&orderby=comment_count');
		while ($popPosts->have_posts()) : $popPosts->the_post(); ?>
		
			<li>
			<?php if(get_option('index_layout') == null) { } else { ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php image_management('thumb-post-thumbnail',50,50) ?></a>
			<?php } ?>
			<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
			<div class="clear"></div>
			</li>
		<?php endwhile; ?>
  </ul>
</div>

<div id="c2" class="sidetabdiv">
	<ul>
		<?php src_simple_recent_comments(get_option('rpn')); ?>
  </ul>
</div>

<div class="clear"></div>
</div>