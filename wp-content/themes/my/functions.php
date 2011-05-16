<?php
include('wp-pagenavi.php');
// Load Jquery
/* ----------------------------------------------*/
function my_init() { 
	$template_dir = get_bloginfo('template_directory');
	if (!is_admin()) {
		wp_deregister_script('jquery');

		// load the local copy of jQuery in the footer
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js', false, '1.4.2', false);

		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery_ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js', array('jquery'), '1.8.0', false);
		wp_enqueue_script('my_script', $template_dir . '/js/custom.js', array('jquery'), '2.0', false);
		
	}
}

add_action('init', 'my_init');

// Localization
/* ----------------------------------------------*/	
// Make theme available for translation
// Translations can be filed in the /languages/ directory
load_theme_textdomain( 'my', TEMPLATEPATH . '/languages' );

// Load Framework Files
/* ----------------------------------------------*/
require_once('inc/core/update_notifier.php'); // option panel interface
require_once('inc/core/admin_functions.php'); // core function
require_once('inc/core/admin_layout.php'); // option panel interface

// Load Option files
/* ----------------------------------------------*/
require_once('inc/core/twitter.php'); // twitter function
require_once('inc/core/widgets.php'); // custom widgets
require_once('inc/options/theme_comment.php');  //custom comment layout
require_once('inc/options/theme_functions.php'); // custom theme functions
require_once('inc/options/theme_widgets_area.php'); // widgets area registration
require_once('inc/options/theme_options.php'); // custom theme options

// Redirect To Theme Options Page on Activation
/* ----------------------------------------------*/
if ($_GET['activated']){
global $shortname;
wp_redirect(admin_url("admin.php?page=$shortname&upgraded=true"));
}
?>