/* this prevents dom flickering, needs to be outside of dom.ready event: */
document.documentElement.className += 'js_active';
/*end dom flickering =) */

jQuery.noConflict();

jQuery(document).ready(function($) {
	mainmenu();
	$('.tabs').tabs({ fx: { height: 'toggle', opacity: 'toggle', speed: 'fast' } });

});

function mainmenu(){
jQuery(".dropmenu a").removeAttr('title');
jQuery(".dropmenu ul ul").css({display: "none"}); // Opera Fix

jQuery(".dropmenu ul li").each(function()
	{	
		var $sublist = jQuery(this).find('ul:first');
		
		$sublist.find('>li:first').css('marginTop','0');
		$sublist.find('>li:last').css('marginBottom','0');
		
		jQuery(this).hover(function()
		{	
			$sublist.stop().css({overflow:"hidden", height:"auto", display:"none",'paddingTop':'0px','paddingBottom':'0px'}).slideDown(200, function()
			{
				jQuery(this).css({overflow:"visible", height:"auto"});
			});
		},
		function()
		{	
			$sublist.stop().slideUp(200, function()
			{	
				jQuery(this).css({overflow:"hidden", display:"none"});
			});
		});	
	});
} 