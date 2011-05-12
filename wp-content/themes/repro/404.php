<?php
header("HTTP/1.1 404 Not Found");
header("Status: 404 Not Found");
?>
<?php get_header(); ?>

<div id="the_body">

    <div class="container_12">
        
        <div class="grid_8">
        	
            <div class="description"><h1><?php _e('Error 404 - Not Found', 'framework') ?></h1></div>
            
            <div class="error">
            	
                <p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>
				<?php get_search_form(); ?>
            
            </div>
    
        </div><!--grid_8-->
        
        <div class="grid_4">
        
            <?php get_sidebar(); ?>
          
        </div><!--grid_4-->

        <div class="clear"></div>
        
    </div><!--container_12-->

</div><!--the_body-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>