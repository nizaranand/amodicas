<?php
/* Remove div from nav menu
/* ----------------------------------------------*/
function my_wp_nav_menu_args( $args = '' )
{
	$args['container'] = false;
	return $args;
} // function

add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );

/* CUSTOM SITE TITLE - FOR SEO
/* ----------------------------------------------*/
function themetation_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'my' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'my' ), $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'my' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'themetation_filter_wp_title', 10, 2 );

/* CUSTOM BREADCRUMB
/* ----------------------------------------------*/
function my_breadcrumb() {
         if ( !is_front_page() ) {
		echo '<div id="breadcrumb"><span class="breadcrumb_info">'.__('Browsing','my').' &raquo;</span> <a href="';
		echo get_option('home');
		echo '">';
		bloginfo('name');
		echo "</a> &raquo; ";
		}

		if ( is_category() || is_single() ) {
			$category = get_the_category();
			$ID = $category[0]->cat_ID;
			echo get_category_parents($ID, TRUE, ' &raquo; ', FALSE );
		}

		if(is_single() || is_page()) {the_title();}
		if(is_tag()){ echo "Tag: ".single_tag_title('',FALSE); }
		if(is_404()){ echo __('404 - Page not Found','my'); }
		if(is_search()){ echo __('Search','my'); }
		if(is_year()){ echo get_the_time('Y'); }

		echo "</div>";

          }

/* ATTACHMENT
 * Get the first image from post
/* ----------------------------------------------*/
//retrive first image with HTML
function get_first_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];
  $get_dir = get_bloginfo('template_directory');
  $title = get_the_title($post->ID);
  $default = "";
  
  if(empty($first_img)){ //Defines a default image
    echo $default;
  }
  else {
  	echo '<img src="' . $first_img . '" alt="'.$title.'" />';
  }
}

// with pre-defined sizes using timthumb
function my_image($w=200,$h=200) { 
if($w == "") { $w="200"; }
if($h == "") { $h="200"; }
if($zc == "") { $zc="1"; }
if($q == "") { $q="100"; }
global $post, $posts, $blog_id;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];
  $get_dir = get_bloginfo('template_directory');
  $default = '<img src="' . $get_dir . '/styles/default.png" width="'.$w.'px" height="'.$h.'px" />';
  
  if(empty($first_img)){ //Defines a default image
    echo $default;
  }
  
  else
  {
  // If under WPMU
  if (isset($blog_id) && $blog_id > 0)
  	{
		  $imageParts = explode('/files/', $first_img);
		  if (isset($imageParts[1]))
		  	{
		      $first_img = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1]; 
		  	}
		echo '<img src="'. $get_dir .'/inc/timthumb.php?src=' . $first_img . '&h='.$h.'&w='.$w.'&zc='.$zc.'" />';
    }
		//IF under WP
		else echo '<img src="'. $get_dir .'/inc/timthumb.php?src=' . $first_img . '&h='.$h.'&w='.$w.'&zc='.$zc.'" />';
		
		} 
}

// with pre-defined sizes w/o using timthumb
function my_image_no_resize($w=200,$h=200) {
if($w == "") { $w="200"; }
if($h == "") { $h="200"; }
if($zc == "") { $zc="1"; }
if($q == "") { $q="100"; }
global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];
  $get_dir = get_bloginfo('template_directory');
  $default = '<img src="' . $get_dir . '/styles/default.png" width="'.$w.'px" height="'.$h.'px" />';
  
  if(empty($first_img)){ //Defines a default image
    echo $default;
  }
  else {
  	echo '<img src="' . $first_img . '" height="'.$h.'" width="'.$w.'" />';
  } 

}

// to define if timthumb in used
function my_attachment_setting($w,$h){
	$myscript = get_option('myscript');
	if ($myscript == null || $myscript == '') {
				echo my_image_no_resize($w,$h); 
	} else { echo my_image($w,$h);
}}

// full image management usage with post-thumnail and sizes.
function image_management($post_thumb,$w,$h){
	if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { // check if there is post thumbnail selected
				the_post_thumbnail($post_thumb);
			} else {
				echo my_attachment_setting($w,$h);
			} 
}

/* ONLOAD DEFAULT VALUE
 * Get the default stylesheet
/* ----------------------------------------------*/
function stylesheet() {
global $shortname;
$alt_stylesheet = get_option($shortname.'_alt_stylesheet'); 
$urlcss = get_bloginfo('stylesheet_url');
$urlstyle = get_bloginfo('template_directory');

if( $alt_stylesheet == null || $alt_stylesheet == '') { 
echo '<link rel="stylesheet" href="' . $urlcss . '" type="text/css" media="screen, projection"/>';
 } else {
echo '<link rel="stylesheet" href="' . $urlstyle . '/styles/' . $alt_stylesheet . '" type="text/css" media="screen, projection"/>';
	} 
}

/* Get the default logo
/* ----------------------------------------------*/
function show_logo() {
	global $logo_path;
	$mylogo = get_option('mylogo');
	if( $mylogo == null || $mylogo = '') {
		echo stripslashes($logo_path);
	} else {
		echo stripslashes(get_option('mylogo'));
	}
}

/* Google Analytics
/* ----------------------------------------------*/
function themetation_google_analytics() {
	$analytics_code = get_option('analytics_code');
	
	if($analytics_code){
		
		echo "<script type=\"text/javascript\">
		/* <![CDATA[ */
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', '" .$analytics_code. "']);
		  _gaq.push(['_trackPageview']);

		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		/* ]]> */
		</script>";
	}
}

?>