jQuery(document).ready(function($){
		$("#tabs, .t_r, .fade").hide();
		$("#tabs, .t_r").fadeIn(800);
		$("#tabs").tabs({ fx: { opacity: 'toggle', duration: 'fast' } }).find(".ui-tabs-nav").sortable({axis:'y'});
		
		$(".fade").delay(600).slideDown(400);
});