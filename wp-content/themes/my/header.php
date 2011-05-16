<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>
<?php
	/*
	* Print the <title> tag based on what is being viewed.
	* We filter the output of wp_title() a bit -- see
	* twentyten_filter_wp_title() in functions.php.
	*/
	wp_title( '&larr;', true, 'right' );

?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />

<!-- feeds and pingback -->
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS2 Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/styles/images/favicon.ico" />

<?php echo stylesheet(); // Load default stylesheet ?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/<?php echo get_option('mywp_layout');?>.css" media="screen, projection" type="text/css" />

<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>

<!--[if IE 6]>
<script src="<?php bloginfo('template_directory');?>/js/DD_belatedPNG.js"></script>
<script>
  /* EXAMPLE */
  DD_belatedPNG.fix('.png_bg');
  
  /* string argument can be any CSS selector */
  /* .png_bg example is unnecessary */
  /* change it to what suits you! */
</script>
<![endif]--> 
</head>
<body>
<div id="header">
	<div class="wrapper">
	<div class="menu">
    
    <span><?php _e('Subscribe to','my') ?> : 
    <?php  if(get_option('rss') == null && get_option('rss') == ''){ ?>
    <a href="<?php bloginfo('rss2_url'); ?>"><?php _e('RSS','my') ?></a> . <a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comment','my') ?></a>
		<?php } else { ?>
    <a href="http://feedproxy.google.com/<?php echo get_option('rss') ?>"><?php _e('RSS','my') ?></a> . <a href="http://feedburner.google.com/fb/a/mailverify?uri=<?php echo get_option('rss') ?>&loc=en_US"><?php _e('Email','my') ?></a>
		<?php }	?>
    </span><?php //subscription settings ?>
    
    <div class="dropmenu">
		<?php // Primary Nav Menu
  		if ( has_nav_menu( 'primary' ) ) { 
			wp_nav_menu( array( 
  		'theme_location' => 'primary',
  		'menu_class' => ''
  		) ); 
  		} else { ?>
				
			<ul>
     	 	<li><a href="<?php bloginfo('url'); ?>" title="Home" <?php echo (is_home() ? "class='current'" : "");?>>Home</a></li>
				<?php wp_list_pages('title_li='); ?>
      </ul>
		<?php } ?>
    </div>		
	</div><!-- end menu div-->
  
  <div class="brand">
  <div id="logo"> 
  <?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
		<<?php echo $heading_tag; ?> id="site-title">
	
		<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('blogname'); ?>">
			<?php $mylogo = get_option('mylogo'); ?>
  		<img src="<?php echo show_logo(); ?>" alt="" class="png_bg" />
  	</a>
  </<?php echo $heading_tag; ?>>
  </div>
    <form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
    	<input type="text" id="search_input" name="s" onblur="if ( this.value == '' ) { this.value = 'Type and Search'; }" onfocus="if ( this.value == 'Type and Search' ) { this.value = ''; }" value="<?php echo (strlen(get_search_query()) > 2) ? get_search_query() : 'Type and Search'; ?>"  />
      <input type="submit" id="search_submit" value="&nbsp;" />
    </form>
  </div>
	<div id="nav" class="dropmenu">
		<?php // Primary Nav Menu
  		if ( has_nav_menu( 'secondary' ) ) { 
			wp_nav_menu( array( 
  		'theme_location' => 'secondary',
  		'menu_class' => ''
  		) ); 
  		} else { ?>
				
			<ul>
       <?php wp_list_categories('title_li='); ?>
    	</ul>
		<?php } ?>
  	
  </div>
	</div></div>
	<div class="wrapper"> 
	<?php if( get_option('mywp_leaderboard') <> null ) { echo '<div class="big-ad">'. stripslashes(get_option('mywp_leaderboard')) . '</div>'; }?>
	
	<?php if(get_option('bread') <> null) { my_breadcrumb(); } ?>