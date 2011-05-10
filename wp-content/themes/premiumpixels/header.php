<!DOCTYPE html>

<!-- BEGIN html -->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<!-- An Orman Clark design (http://www.ormanclark.com) - Proudly powered by WordPress (http://wordpress.org) -->

<!-- BEGIN head -->
<head>

	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
	<!-- Title -->
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
	
	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	
	<!-- RSS & Pingbacks -->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php if (get_option('tz_feedburner')) { echo get_option('tz_feedburner'); } else { bloginfo( 'rss2_url' ); } ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    
    <!-- Theme Hook -->
	<?php wp_head(); ?>

<!-- END head -->
</head>

<!-- BEGIN body -->
<body <?php body_class(); ?>>

	<!-- BEGIN #container -->
	<div id="container">
	
		<!-- BEGIN #header -->
		<div id="header">	
			
			<!-- BEGIN .inner -->
			<div class="inner">
			
				<p class="welcome-message"><?php echo stripslashes(get_option('tz_welcome_message')); ?></p>
                
                <div id="top-nav">
                
					<?php if ( has_nav_menu( 'primary-menu' ) ) { /* if menu location 'primary-menu' exists then use custom menu */ ?>
                    <?php wp_nav_menu( array( 'theme_location' => 'primary-menu') ); ?>
                    <?php } else { /* else use wp_list_categories */
                    $primary_exclude = get_option('tz_primary_nav_exclude'); ?>
                    
                    <ul>
                        <?php wp_list_pages( array( 'exclude' => $primary_exclude, 'title_li' => '' )); ?>
                    </ul>
                    <?php } ?>
                
				</div>
                
			<!-- END .inner -->
			</div>

		<!--END #header-->
		</div>

		<!--BEGIN #content -->
		<div id="content" class="clearfix">
		