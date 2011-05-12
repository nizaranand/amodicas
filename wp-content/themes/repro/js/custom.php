<?php include '../../../../wp-load.php';
header("Content-type: text/javascript"); ?>

<?php include( TEMPLATEPATH . '/functions/get-options.php' ); /* include theme options */ ?>


<?php ob_flush(); ?>

// Custom Javascript

jQuery(document).ready(function() {
	
	// Secondary Navigation
	jQuery("ul.sf-menu").superfish({
		delay: 500,
		animation: {opacity:'show'},
		speed: 200,
		autoArrows: false,
		dropShadows: false
	});
	
    <?php // Second nav styling ?>
	jQuery("#second_nav li li:first, #second_nav li li li:first, #second_nav li li li li:first").addClass('first');
	jQuery("#second_nav li:last-child").addClass('last');
	
    <?php // Main nav styling ?>
	jQuery("#nav li:first, #nav li li:first, #nav li li li:first, #nav li li li li:first").addClass('first');
	jQuery("#nav li:last-child").addClass('last');
    
    <?php // Flickr styling ?>
    jQuery("#sidebar .flickr div:nth-child(5), #sidebar .flickr div:nth-child(9), #sidebar .flickr div:nth-child(13)").addClass('last');
    jQuery("#footer .flickr div:nth-child(4), #footer .flickr div:nth-child(7), #footer .flickr div:nth-child(10)").addClass('last');
    
    <?php // Tab styling ?>
    jQuery(".tab li:last-child").addClass('last');
    
    <?php // Twtitter styling ?>
    jQuery("#twitter_update_list li:last-child").addClass('last');
    jQuery("#twitter_update_list li:first").addClass('first');
    
    <?php // Category list styling ?>
    jQuery(".category_list li:last-child").addClass('last');
    
    <?php // Advert styling ?>
    jQuery(".advert li:even").addClass('left');
    
    jQuery('.s').each(
    
    	function() {
        	
            if(jQuery(this).val() === '' || jQuery(this).val() === '<?php _e('to search, type and hit enter', 'framework'); ?>')
            {
                jQuery(this).val('<?php _e('to search, type and hit enter', 'framework'); ?>');
        
                jQuery(this).blur( 
                    function () {
                       jQuery(this).val('<?php _e('to search, type and hit enter', 'framework'); ?>');
                    });
                    
                jQuery(this).focus( 
                    function () {
                       jQuery(this).val('');
                    });
            }
            
        }
        
    );

	
	// Main Navigation
	jQuery('#nav ul.sf-menu').superfish({ 
		delay: 200,
		animation: {opacity:'show', height:'show'},
		speed: 'fast',
		autoArrows: false,
		dropShadows: false
	});
	
	// Coda Slider
	jQuery('#coda-slider-1').codaSlider({
    	<?php if($tz_slider_autostart == 'true') : ?>
        autoSlide: true,
        autoSlideInterval: <?php echo $tz_slider_delay; ?>,
        <?php endif; ?>
		dynamicArrows: false,
		dynamicTabs: false,
		slideEaseDuration: 1000
	});
	
	// Post Grid Tooltips
	jQuery('.tooltip').poshytip({
		className: 'tip-twitter',
		showTimeout: 1,
		alignTo: 'target',
		alignX: 'center',
		offsetY: 5,
		allowTipHover: false,
		fade: false,
		slide: false
	});
	
	// Tab Widget
	jQuery(".tabs").tabs({ 
		fx: { opacity: 'toggle' } 
	});

	// Opacity change for clicked thumbnails
	jQuery('#slider_nav li a').click( 
		function () {
			jQuery('#slider_nav li a').css('opacity', 0.5);
			jQuery(this).css('opacity', 1);
		}
	);
	
	// Opacity change for hovered thumbnails
	jQuery('#slider_nav li a').hover( 
		function () {
			jQuery(this).not(".current").stop(true, true).animate({opacity: 1}, 300);
		}, function () {
			jQuery(this).not(".current").stop(true, true).animate({opacity: 0.5}, 300);
		}
	);
	
	// Input focus css change
	jQuery('input').focus( 
		function () {
			jQuery(this).css('border', '1px solid #d2d2d2');
			jQuery(this).css('colo	r', '#444444');
		}
	);
	
	// Input blur css change
	jQuery('input').blur( 
		function () {
			jQuery(this).css({
				border: '1px solid #e0e0e0',
				color: '#999999'
			});
		}
	);
	
	// Submit buttons
	jQuery('#respond input.btn, #content button').hover( 
		function () {
			jQuery(this).css({background: '#fff'});
		}, function () {
			jQuery(this).css({background: 'url(images/button_bg.gif) repeat-x'});
		}
	);

}); 

<?php ob_end_flush(); ?>