<?php if(!is_page()) : ?>

<div id="sidebar">

    <?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Main Sidebar') ) ?>
    
    <div class="widget">
        
        <div class="half">
        	
            <?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Narrow Left') ) ?>

        </div><!--half-->
        
        <div class="half last">
            
            <?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Narrow Right') ) ?>
            
        </div><!--half-->
        
    </div><!--widget-->

</div><!--sidebar-->

<?php else: ?>

<div id="sidebar">

    <?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Sidebar Page') ) ?>
    
    <div class="widget">
        
        <div class="half">
        	
            <?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Narrow Left Page') ) ?>

        </div><!--half-->
        
        <div class="half last">
            
            <?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Narrow Right Page') ) ?>
            
        </div><!--half-->
        
    </div><!--widget-->

</div><!--sidebar-->

<?php endif; ?>