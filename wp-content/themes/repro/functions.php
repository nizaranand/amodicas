<?php

/* 
	Here we have all the custom functions for the theme
	Please be extremely cautious editing this file,
	When things go wrong, they tend to go wrong in a big way.
	You have been warned!
*/

// Register the wp 3.0 Menus
add_action( 'init', 'register_my_menus' );

function register_my_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu' ),
			'secondary-menu' => __( 'Secondary Menu' )
		)
	);
}


// Ready for theme localisation
load_theme_textdomain ('framework');


// Register the sidebars and widget classes
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Main Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4><span>',
		'after_title' => '</span></h4>',
	));
	register_sidebar(array(
		'name' => 'Narrow Left',
		'before_widget' => '<div class="wrap">',
		'after_widget' => '</div>',
		'before_title' => '<h4><span>',
		'after_title' => '</span></h4>',
	));
	register_sidebar(array(
		'name' => 'Narrow Right',
		'before_widget' => '<div class="wrap">',
		'after_widget' => '</div>',
		'before_title' => '<h4><span>',
		'after_title' => '</span></h4>',
	));
	register_sidebar(array(
		'name' => 'Sidebar Page',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4><span>',
		'after_title' => '</span></h4>',
	));
	register_sidebar(array(
		'name' => 'Narrow Left Page',
		'before_widget' => '<div class="wrap">',
		'after_widget' => '</div>',
		'before_title' => '<h4><span>',
		'after_title' => '</span></h4>',
	));
	register_sidebar(array(
		'name' => 'Narrow Right Page',
		'before_widget' => '<div class="wrap">',
		'after_widget' => '</div>',
		'before_title' => '<h4><span>',
		'after_title' => '</span></h4>',
	));
	register_sidebar(array(
		'name' => 'Footer 1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4><span>',
		'after_title' => '</span></h4>',
	));
	register_sidebar(array(
		'name' => 'Footer 2',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4><span>',
		'after_title' => '</span></h4>',
	));
	register_sidebar(array(
		'name' => 'Footer 3',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4><span>',
		'after_title' => '</span></h4>',
	));
	register_sidebar(array(
		'name' => 'Footer 4',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4><span>',
		'after_title' => '</span></h4>',
	));
}


// Add support for WP 2.9 post thumbnails
if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'large', 610, '', true ); // default large size
	add_image_size( 'slider-preview', 275, 270, true ); // Slider large image
	add_image_size( 'slider-thumbnail', 85, 60, true ); // Slider thumbnail
	add_image_size( 'column-preview', 184, 144, true ); // Column size
	add_image_size( 'single-large', 604, 272, true ); // Single post/page large
	add_image_size( 'related-thumbnail', 130, 94, true ); // Single post/page large
	add_image_size( 'post-grid', 61, 61, true ); // Post grid
	add_image_size( 'category-thumbnail', 45, 45, true ); // Category list thumbnails
	add_image_size( 'archive-preview', 109, 109, true ); // Archive list thumbs
}


// Add option for custom gravatar
function tz_custom_gravatar( $avatar_defaults ) {
    $tz_avatar = get_bloginfo('template_directory') . '/images/gravatar.png';
    $avatar_defaults[$tz_avatar] = 'Custom Gravatar (/images/gravatar.png)';
    return $avatar_defaults;
}
add_filter( 'avatar_defaults', 'tz_custom_gravatar' );


// Change Excerpt Length
function tz_excerpt_length($length) {
return 30; }
add_filter('excerpt_length', 'tz_excerpt_length');


// Change Excerpt [...] to new string : WP2.8+
function tz_excerpt_more($excerpt) {
return str_replace('[...]', '...', $excerpt); }
add_filter('wp_trim_excerpt', 'tz_excerpt_more');


// Replace WP local jQuery with Google latest jQuery
function tz_google_jquery() {
	if (!is_admin()) {
		// comment out the next two lines to load the local copy of jQuery
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js', false, '1.4');
		wp_register_script('coda-slider', get_bloginfo('template_directory') . '/js/jquery.coda-slider-2.0.js', 'jquery');
		wp_register_script('superfish', get_bloginfo('template_directory') . '/js/superfish.js', 'jquery');
		wp_register_script('jquery-easing', get_bloginfo('template_directory') . '/js/jquery.easing.1.3.js', 'jquery');
		wp_register_script('poshytip', get_bloginfo('template_directory') . '/js/jquery.poshytip.min.js', 'jquery');
		wp_register_script('validation', get_bloginfo('template_directory') . '/js/jquery.validate.min.js', 'jquery');
		wp_register_script('jquery-ui-custom', get_bloginfo('template_directory') . '/js/jquery-ui-1.8.5.custom.min.js', 'jquery');
		
		if (is_page_template('template-contact.php')) { 
			wp_enqueue_script('validation');
		}
	}
}
add_action('init', 'tz_google_jquery');


// Add browser detection class to body tag
add_filter('body_class','tz_browser_body_class');
function tz_browser_body_class($classes) {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

	if($is_lynx) $classes[] = 'lynx';
	elseif($is_gecko) $classes[] = 'gecko';
	elseif($is_opera) $classes[] = 'opera';
	elseif($is_NS4) $classes[] = 'ns4';
	elseif($is_safari) $classes[] = 'safari';
	elseif($is_chrome) $classes[] = 'chrome';
	elseif($is_IE) $classes[] = 'ie';
	else $classes[] = 'unknown';

	if($is_iphone) $classes[] = 'iphone';
	return $classes;
}

// Output the styling for the seperated Pings
function tz_list_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment; ?>
<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
<?php }


// Make a custom login logo and link
function tz_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url('.get_bloginfo('template_directory').'/images/custom-login-logo.png) !important; }
    </style>';
}
function tz_wp_login_url() {
echo bloginfo('url');
}
function tz_wp_login_title() {
echo get_option('blogname');
}

add_action('login_head', 'tz_custom_login_logo');
add_filter('login_headerurl', 'tz_wp_login_url');
add_filter('login_headertitle', 'tz_wp_login_title');


// Find and close unclosed xhtml tags
function close_tags($text) {
    $patt_open    = "%((?<!</)(?<=<)[\s]*[^/!>\s]+(?=>|[\s]+[^>]*[^/]>)(?!/>))%";
    $patt_close    = "%((?<=</)([^>]+)(?=>))%";

    if (preg_match_all($patt_open,$text,$matches))
    {
        $m_open = $matches[1];
        if(!empty($m_open))
        {
            preg_match_all($patt_close,$text,$matches2);
            $m_close = $matches2[1];
            if (count($m_open) > count($m_close))
            {
                $m_open = array_reverse($m_open);
                foreach ($m_close as $tag) $c_tags[$tag]++;
                foreach ($m_open as $k => $tag)    if ($c_tags[$tag]--<=0) $text.='</'.$tag.'>';
            }
        }
    }
    return $text;
}

// Content Limit
function content($num, $more_link_text = '(more...)') {  
$theContent = get_the_content($more_link_text);  
$output = preg_replace('/<img[^>]+./','', $theContent);  
$limit = $num+1;  
$content = explode(' ', $output, $limit);  
array_pop($content);  
$content = implode(" ",$content);  
$content = strip_tags($content, '<p><a><address><a><abbr><acronym><b><big><blockquote><br><caption><cite><class><code><col><del><dd><div><dl><dt><em><font><h1><h2><h3><h4><h5><h6><hr><i><img><ins><kbd><li><ol><p><pre><q><s><span><strike><strong><sub><sup><table><tbody><td><tfoot><tr><tt><ul><var>');
echo close_tags($content);
}

// Custom Comments Display
function tz_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    	<div id="comment-<?php comment_ID(); ?>">
        
    	<div class="line"></div>
        <div class="image"><?php echo get_avatar($comment,$size='61'); ?></div>
        
        <div class="details">
        
            <div class="name"><span class="author"><?php comment_author_link(); ?></span> <span class="date"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?> &middot; <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span></div>
            
            <?php if ($comment->comment_approved == '0') : ?>
            <em><?php _e('Your comment is awaiting moderation.') ?></em>
            <br />
            <?php endif; ?>
                
            <?php comment_text() ?>
            
        </div><!--details-->
        
        </div><!--comment-<?php comment_ID(); ?>-->
        
    
<?php
        }

//work out how many posts within a category
function get_category_count($input = '') {
	global $wpdb;
	if($input == '')
	{
		$category = get_the_category();
		return $category[0]->category_count;
	}
	elseif(is_numeric($input))
	{
		$SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->term_taxonomy.term_id=$input";
		return $wpdb->get_var($SQL);
	}
	else
	{
		$SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->terms.slug='$input'";
		return $wpdb->get_var($SQL);
	}
}

// Add the 125x125 Ad Block Custom Widget
include("functions/widget-ad125.php");

// Add the 300x250 Ad Block Custom Widget
include("functions/widget-ad300x250.php");

// Add the 120x240 Ad Block Custom Widget
include("functions/widget-ad120x240.php");

// Add the Latest Tweets Custom Widget
include("functions/widget-tweets.php");

// Add the Flickr Photos Custom Widget
include("functions/widget-flickr.php");

// Add the Custom Video Widget
include("functions/widget-video.php");

// Add the Custom Tabbed Widget
include("functions/widget-tabbed.php");

// Add the Rss & Twitter Count Widget
include("functions/widget-rsstwitter.php");

// Add the Shortcodes
include("functions/theme-shortcodes.php");

// Add the Theme Options Pages
include("functions/theme-options.php");

?>