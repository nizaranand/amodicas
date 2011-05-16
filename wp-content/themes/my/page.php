<?php get_header(); ?>
<div id="page_wrap" class="wrapper">

	<div id="page">
    	<div id="content_wrap">
        	<div id="content">
                        	
		<?php if (is_page(get_option('id8'))) { ?>


		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
		<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
		<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
		</div>
        <?php comments_template(); ?>
		<?php endwhile; endif; ?>
 
	<?php } else { ?>


		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
			<div id="post-<?php the_ID(); ?>" class="post">
				<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
					<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
			</div>
		<?php endwhile; endif; } ?>
      
        	</div>
        </div>
        
        
        <?php get_sidebar(); ?>

        <div class="clear"></div>
    </div>
    
</div>

<?php include('bottom.php'); ?>
<?php get_footer(); ?>