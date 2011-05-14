<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<?php include( TEMPLATEPATH . '/functions/get-options.php' ); /* include theme options */ ?>

<!-- BEGIN html -->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<!-- An Orman Clark design (http://www.premiumpixels.com) - Proudly powered by WordPress (http://wordpress.org) -->

<!-- BEGIN head -->
<head>

	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
	<!-- Title -->
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo ($tz_favicon_url); ?>" />
	
	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css" type="text/css" media="screen" />
    
    <!--[if IE 6]>
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie.css" />
    <![endif]-->
    
    <?php if(is_singular()) :?>
    <!--[if IE 7]>
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie7.css" />
    <![endif]-->
    <?php endif; ?>
    
    <!-- Colour -->
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/colour.php" type="text/css" media="screen" />
	
	<!-- RSS, Atom & Pingbacks -->
	<?php if ($tz_feedburner) { /* if FeedBurner URL is set in theme options */ ?>
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php echo ($tz_feedburner); ?>" />
	<?php } else { /* if not then use the standard WP feed */ ?>
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php bloginfo( 'rss2_url' ); ?>" />
	<?php } ?>
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo( 'rss_url' ); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo( 'atom_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<!-- Theme Hook -->
	<?php wp_enqueue_script("jquery"); // load JQuery (modified to use Google over WP Bundle) ?>
    <?php 
		wp_enqueue_script('coda-slider');
		wp_enqueue_script('superfish');
		wp_enqueue_script('poshytip');
		wp_enqueue_script('jquery-ui-custom');
		wp_enqueue_script('validation');
	?>

    <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); // loads the javascript required for threaded comments ?>
	<?php wp_head(); ?>
    
    <?php if (is_page_template('template-contact.php')) : /* if the page uses the contact form template then load validation js */ ?>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery("#contactForm").validate();
			});
	  	</script>
	<?php endif; ?>

<!-- END head -->
</head>

<!-- BEGIN body -->
<body <?php body_class(); ?>>

<div id="header">
        
    <div id="top">
    
        <div class="container_12">
        
            <div class="grid_3">
            
                <div id="rss">
                
                <span><?php _e('Subscribe', 'framework') ?></span> 
				<?php _e('By', 'framework') ?> <a href="<?php echo $tz_feedburner; ?>"><?php _e('RSS', 'framework') ?></a> <?php _e('or', 'framework') ?> 
                <a href="<?php echo $tz_feedburner_email;?>"><?php _e('Email', 'framework') ?></a>
                
                </div><!--rss-->
            
            </div><!--grid_3-->
            
            <div class="grid_9">
            
                <div id="second_nav">
                
                    <?php if ( has_nav_menu( 'secondary-menu' ) ) : /* if menu location 'secondary-menu' exists then use custom menu */ ?>
					<?php wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'menu_class' => 'sf-menu', 'container' => '' ) ); ?>
					<?php else: /* else use wp_page_menu
					if the home link is set to true in theme options then show "home" button
					if excluded categories are set in theme options then exclude from menu */
					?>
                    <ul class="sf-menu">
                    
                    	<?php if ($tz_home_link == "true") : ?>
                    	<li><a href="<?php bloginfo('url'); ?>"><?php _e('Home', 'framework'); ?></a></li>
                        <?php endif; ?>
                        
                        <?php wp_list_pages( array( 'exclude' => $tz_nav_exclude, 'title_li' => '', 'sort_column' => $tz_nav_order, )); ?>
                        
                    </ul>
                    <?php endif; ?>
                
                </div><!--second_nav-->
            
            </div><!--grid_9-->
            
            <div class="clear"></div>

        </div><!--container_12-->
    
    </div><!--top-->
    
    <div id="bottom">
    
        <div class="container_12">
        
            <div class="grid_5">
            
              <div id="logo">
                
                <?php /*
				If "plain text logo" is set in theme options then use text
				if a logo url has been set in theme options then use that
				if none of the above then use the default logo.png */
				if ($tz_plain_logo == "true") : ?>
                
				<h1><a href="<?php bloginfo( 'url' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
				<p id="tagline"><?php bloginfo( 'description' ); ?></p>
                
				<?php elseif ($tz_logo_url) : ?>
                
				<a href="<?php bloginfo( 'url' ); ?>"><img src="<?php echo ($tz_logo_url); ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
                
				<?php else : ?>
                
				<a href="<?php bloginfo( 'url' ); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
                
				<?php endif; ?>
              
              </div><!--logo-->
              
            </div><!--grid_5-->
			
            <?php if ($tz_banner_header == "true") : /* Display 468x60 banner if checked in theme options */ ?>
            
            <div class="grid_7">
            
              <div id="header_advert">
              	
                <?php if($tz_banner_adsense == '') : // if there is no adsense data, then just display the image?>
                
                <script type="text/javascript"><!--
								google_ad_client = "ca-pub-4000242548128639";
								/* Banner Top */
								google_ad_slot = "3484824362";
								google_ad_width = 468;
								google_ad_height = 60;
								//-->
								</script>
								<script type="text/javascript"
								src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
								</script>
                
                <?php else: ?>
                
                <?php echo $tz_banner_adsense; // display adsense ?>
                
                <?php endif; ?>
                
              </div><!--header_advert-->
              
            </div><!--grid_7-->
            
            <?php endif; ?>
            
            <div class="grid_12">
            
                <div id="nav">
                
                    <?php if ( has_nav_menu( 'primary-menu' ) ) : /* if menu location 'primary-menu' exists then use custom menu */ ?>
					<?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'sf-menu', 'container' => '' ) ); ?>
                    <?php else : /* else use wp_list_categories */ ?>
                    <ul class="sf-menu">
                        <?php wp_list_categories( array( 'exclude' => $tz_primary_nav_exclude, 'title_li' => '' )); ?>
                    </ul>
                    <?php endif; ?>
                    
                    <div class="clear"></div>
                
                </div><!--nav-->
            
            </div><!--grid_12-->
            
            <div class="clear"></div>
            
        </div><!--container_12-->
    
    </div><!--bottom-->
    
</div><!--header-->
