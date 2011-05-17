<?php

/**
 * Flickr Widget Class
 */
class Themetation_Flickr_Widget extends WP_Widget {
    /** constructor */
    function Themetation_Flickr_Widget() {
		global $themename;
		$widget_ops = array('classname' => 'Themetation_flickr_widget', 'description' => __( "Pulls in images from your Flickr account.") );
		$control_ops = array('width' => 400, 'height' => 200);
		$this->WP_Widget('flickr', __($themename.' - Flickr'), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {	
        extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Photos on flickr') : $instance['title'], $instance, $this->id_base);
		$id = $instance['id'];
		
		if ( !$number = (int) $instance['number'] )
			$number = 3;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
        ?>

			<?php echo $before_widget; ?>
				<?php echo $before_title . $title . $after_title; ?>
				<div class="flickr_wrap">
					<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $id; ?>"></script> 
				</div>
			<?php echo $after_widget; ?>

        <?php
    }

    function update($new_instance, $old_instance) {				
        $instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['id'] = strip_tags($new_instance['id']);
		$instance['number'] = (int) $new_instance['number'];

		return $instance;
    }

    function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$id = isset($instance['id']) ? esc_attr($instance['id']) : '';
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 3;
        ?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('id'); ?>">Flickr ID (<a href="http://www.idgettr.com" target="_blank">idGettr</a>):</label>
		<input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo $id; ?>" /></p>
			
		<p><label for="<?php echo $this->get_field_id('number'); ?>">Number of photos:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></p>

        <?php 
    }

}

/**
 * Twitter Widget Class
 */
class Themetation_Twitter_Widget extends WP_Widget {
    /** constructor */
    function Themetation_Twitter_Widget() {
		global $themename;
		$widget_ops = array('classname' => 'Themetation_twitter_widget', 'description' => __( "Pulls in your most recent tweet from Twitter.") );
		$control_ops = array('width' => 250, 'height' => 200);
		$this->WP_Widget('twitter', __($themename.' - Twitter'), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
		global $shortname;
        extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Tweets') : $instance['title'], $instance, $this->id_base);
		$id = $instance['id'];
		
		if ( !$number = (int) $instance['number'] )
			$number = 5;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
		
		$limit = $number;
		$type = 'widget';
        ?>

			<?php echo $before_widget; ?>
				<?php echo $before_title . $title . $after_title; ?>
					<div class="twitter_bird">
						<ul>
							<?php echo parse_cache_twitter_feed($id, $limit, $type); ?>
						</ul>
					</div>
			<?php echo $after_widget; ?>

        <?php
    }

    function update($new_instance, $old_instance) {	
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['id'] = strip_tags($new_instance['id']);
		$instance['number'] = (int) $new_instance['number'];
				
        return $instance;
	
				
    }

    function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$id = isset($instance['id']) ? esc_attr($instance['id']) : '';
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 5;
        ?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('id'); ?>">Enter your twitter username:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo $id; ?>" /></p>
			
		<p><label for="<?php echo $this->get_field_id('number'); ?>">Enter the number of tweets you'd like to display:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></p>

        <?php 
    }

}


/*
 * Twitter e RSS Count Widget class.
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
		$twit = file_get_contents("http://twitter.com/users/show/".$twitter.".xml");
		$begin = '<followers_count>'; $end = '</followers_count>';
		$page = $twit;
		$parts = explode($begin,$page);
		$page = $parts[1];
		$parts = explode($end,$page);
		$tcount = $parts[0];
		if($tcount == '') { $tcount = '0'; }
	
	
	?>
        <div class="rss_widget">
        
            <span class="icon"><a href="http://feeds.feedburner.com/<?php echo $username; ?>"><img src="<?php bloginfo('template_directory'); ?>/styles/images/rss_icon.png" alt="rss" /></a></span>
                                
            <div class="details">
                
                <a href="http://feeds.feedburner.com/<?php echo $username; ?>">
                <span class="count"><?php echo $fbcount; ?></span>
                <span class="desc"><?php _e('Assinar', 'framework'); ?></span>
                </a>
                
            </div><!--details-->
            
        </div><!--rss_widget-->
        
        <?php
		
		?>
        <div class="twitter_widget">
            
            <span class="icon"><a href="<?php echo "http://www.twitter.com/$twitter"; ?>"><img src="<?php bloginfo('template_directory'); ?>/styles/images/twitter_icon.png" alt="twitter" /></a></span>
            
            <div class="details">
                
                <a href="<?php echo "http://www.twitter.com/$twitter"; ?>">
                <span class="count"><?php echo $tcount; ?></span>
                <span class="desc"><?php _e('Siga-nós', 'framework'); ?></span>
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

// register widget classess
add_action('widgets_init', create_function('', 'return register_widget("Themetation_Flickr_Widget");'));
add_action('widgets_init', create_function('', 'return register_widget("Themetation_Twitter_Widget");'));
add_action('widgets_init', create_function('', 'return register_widget("tz_rsstwitter_widget");'));
?>