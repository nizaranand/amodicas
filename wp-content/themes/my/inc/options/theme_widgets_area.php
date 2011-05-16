<?php 
/* Widget
/* ----------------------------------------------*/
function themetation_widgets_init() {

	register_sidebar(array(
	'name' => 'Sidebar',
	'id' => 'sidebar-1',
	'description' => __( 'widget area in Sidebar', 'my' ),
	'before_widget' => '<div class="widget">',
  'after_widget' => '</div>',
  'before_title' => '<h3>',
  'after_title' => '</h3>',
	));
	
	register_sidebar(array(
	'name' => 'Top Sidebar',
	'id' => 'sidebar-3',
	'description' => __( 'widget area in sidebar, above tabs', 'my' ),
	'before_widget' => '<div class="widget">',
  'after_widget' => '</div>',
  'before_title' => '<h3>',
  'after_title' => '</h3>',
	));
	
	register_sidebar(array(
	'name' => 'Bottom Sidebar',
	'id' => 'sidebar-2',
	'description' => __( 'widget area in the right of bottom area', 'my' ),
	'before_widget' => '',
  'after_widget' => '',
  'before_title' => '<h3>',
  'after_title' => '</h3>',
	));
	

}

/** Register sidebars by running themetation_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'themetation_widgets_init' );
?>