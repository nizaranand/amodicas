<?php include( TEMPLATEPATH . '/functions/get-options.php' ); /* include theme options */ ?>

<div id="footer">

    <div id="footer_border"></div>

    <div class="container_12">
        
        <div class="grid_3">
        
          <?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer 1') ) ?>
          
        </div><!--grid_3-->
        
        <div class="grid_3">
        
          <?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer 2') ) ?>
          
        </div><!--grid_3-->
        
        <div class="grid_3">
        
          <?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer 3') ) ?>
          
        </div><!--grid_3-->
        
        <div class="grid_3">
        
          <?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer 4') ) ?>
          
        </div><!--grid_3-->
        
        <div class="clear"></div>
    
    </div><!--container_12-->
    
    <div id="footer_bottom">

        <div class="container_12">
            
            <div class="grid_6">
            
                <p>&copy; <?php the_time( 'Y' ); ?> <a href="<?php bloginfo( 'url' ); ?>"><?php bloginfo( 'name' ); ?></a></p>
            
            </div><!--grid_6-->
            
            <div class="grid_6">
            
                <p class="right"><?php _e('Powered by', 'framework') ?> <a href="http://wordpress.org/"><?php _e('WordPress', 'framework') ?></a>. <a href="#">Repro Theme</a> by <a href="http://www.premiumpixels.com">Orman Clark</a></p>
            
            </div><!--grid_6-->
            
            <div class="clear"></div>
            
        </div><!--container_12-->

    </div><!--footer_bottom-->
  
</div><!--footer-->

<!-- Theme Hook -->
<?php wp_footer(); ?>

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/custom.php"></script>


<?php if ($tz_g_analytics) { /* if google analytics is set in theme options then show code */ echo stripslashes($tz_g_analytics); } ?>

</body>
</html>