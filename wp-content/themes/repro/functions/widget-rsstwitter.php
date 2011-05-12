<?php
/*
 * Plugin Name: Custom RSS & Twitter Count
 * Plugin URI: http://www.premiumpixels.com
 * Description: A widget that allows the selection and configuration of a single 120x240 Banner
 * Version: 1.0
 * Author: Orman Clark
 * Author URI: http://www.premiumpixels.com
 */

/*
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'tz_rsstwitter_widgets' );

/*
 * Register widget.
 */
function tz_rsstwitter_widgets() {
	register_widget( 'TZ_RssTwitter_Widget' );
}

/*
 * Widget class.
 */
class tz_rsstwitter_widget extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */
	
	function TZ_RssTwitter_Widget() {
	
		/* Widget settings */
		$widget_ops = array( 'classname' => 'tz_rsstwitter_widget', 'description' => __('A widget that counts how many RSS subscribers and Twitter followers you have.', 'framework') );

		/* Widget control settings */
		//$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'tz_ad300_widget' );

		/* Create the widget */
		$this->WP_Widget( 'tz_rsstwitter_widget', __('Custom RSS and Twitter counter', 'framework'), $widget_ops, $control_ops );
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$username = $instance['username'];
		$refresh_text = $instance['refresh_text'];
		$twitter = $instance['twitter'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
		
		// RSS Code
		$theurl = file_get_contents('https://feedburner.google.com/api/awareness/1.0/GetFeedData?uri='. $username);
		$begin = 'circulation="'; $end = '"';
		$page = $theurl;
		$parts = explode($begin,$page);
		$page = $parts[1];
		$parts = explode($end,$page);
		$fbcount = $parts[0];
		if($fbcount == '0' || $fbcount == '' ) { $fbcount = $refresh_text; }
		
		
		//Twitter code
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://www.twitter.com/$twitter");
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_PORT, 80);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_REFERER, $referer);
		//curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		$document = curl_exec($ch);
		curl_close($ch);
		preg_match_all('#<span id="follower_count" class="stats_count numeric">(.*?)</span>#is', $document, $urlmatches);
	   
	?>
        <div class="rss_widget">
        
            <span class="icon"><a href="http://feeds.feedburner.com/<?php echo $username; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/rss_icon.png" alt="rss" /></a></span>
                                
            <div class="details">
                
                <a href="http://feeds.feedburner.com/<?php echo $username; ?>">
                <span class="count"><?php echo $fbcount; ?></span>
                <span class="desc"><?php _e('Subscribers', 'framework'); ?></span>
                </a>
                
            </div><!--details-->
            
        </div><!--rss_widget-->
        
        <?php
		
		?>
        <div class="twitter_widget">
            
            <span class="icon"><a href="<?php echo "http://www.twitter.com/$twitter"; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/twitter_icon.png" alt="twitter" /></a></span>
            
            <div class="details">
                
                <a href="<?php echo "http://www.twitter.com/$twitter"; ?>">
                <span class="count"><?php echo $urlmatches[1][0]; ?></span>
                <span class="desc"><?php _e('Followers', 'framework'); ?></span>
                </a>
                
            </div><!--details-->
            
        </div><!--twitter_widget-->
                        
        <?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/* ---------------------------- */
	/* ------- Update Widget -------- */
	/* ---------------------------- */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );

		/* No need to strip tags */
		$instance['username'] = $new_instance['username'];
		$instance['refresh_text'] = $new_instance['refresh_text'];
		
		$instance['twitter'] = $new_instance['twitter'];

		return $instance;
	}
	
	/* ---------------------------- */
	/* ------- Widget Settings ------- */
	/* ---------------------------- */
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	
	function form( $instance ) {
	
		/* Set up some default widget settings. */
		$defaults = array(
		'title' => '',
		'username' => "premiumpixels",
		'refresh_text' => '1000+',
		'twitter' => 'ormanclark',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<!-- Ad image url: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('RSS Acount:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
		</p>
        
        <!-- Ad image url: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'refresh_text' ); ?>"><?php _e('RSS Refresh Text:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'refresh_text' ); ?>" name="<?php echo $this->get_field_name( 'refresh_text' ); ?>" value="<?php echo $instance['refresh_text']; ?>" />
		</p>
		
		<!-- Ad twitter url: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e('Twitter Acount:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $instance['twitter']; ?>" />
		</p>
		
	<?php
	}
}
?>