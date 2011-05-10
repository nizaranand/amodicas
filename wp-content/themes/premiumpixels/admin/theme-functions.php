<?php

/* These are functions specific to the included option settings and this theme */


/*-----------------------------------------------------------------------------------*/
/* Output Custom CSS from theme options
/*-----------------------------------------------------------------------------------*/

function tz_head_css() {

		$shortname =  get_option('tz_shortname'); 
		$output = '';
		
		$custom_css = get_option('tz_custom_css');
		
		if ($custom_css <> '') {
			$output .= $custom_css . "\n";
		}
		
		// Output styles
		if ($output <> '') {
			$output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo $output;
		}
	
}

add_action('wp_head', 'tz_head_css');


/*-----------------------------------------------------------------------------------*/
/* Add Body Classes for Layout
/*-----------------------------------------------------------------------------------*/

add_filter('body_class','tz_body_class');
 
function tz_body_class($classes) {
	$shortname = get_option('tz_shortname');
	$layout = get_option($shortname .'_layout');
	if ($layout == '') {
		$layout = 'layout-2cr';
	}
	$classes[] = $layout;
	return $classes;
}


/*-----------------------------------------------------------------------------------*/
/* Add Favicon
/*-----------------------------------------------------------------------------------*/

function tz_favicon() {
	$shortname = get_option('tz_shortname');
	if (get_option($shortname . '_custom_favicon') != '') {
	echo '<link rel="shortcut icon" href="'. get_option('tz_custom_favicon') .'"/>'."\n";
	}
	else { ?>
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/admin/images/favicon.ico" />
	<?php }
}

add_action('wp_head', 'tz_favicon');


/*-----------------------------------------------------------------------------------*/
/* Show analytics code in footer */
/*-----------------------------------------------------------------------------------*/

function tz_analytics(){
	$shortname =  get_option('tz_shortname');
	$output = get_option($shortname . '_google_analytics');
	if ( $output <> "" ) 
		echo stripslashes($output) . "\n";
}
add_action('wp_footer','tz_analytics');


/*-----------------------------------------------------------------------------------*/
/*	Helpful function to see if a number is a multiple of another number
/*-----------------------------------------------------------------------------------*/

function is_multiple($number, $multiple) 
{ 
    return ($number % $multiple) == 0; 
}

/*-----------------------------------------------------------------------------------*/
/*	Realtive Time function for Twitter wdiget
/*-----------------------------------------------------------------------------------*/

function relativeTime($time)
{
	define("SECOND", 1);
	define("MINUTE", 60 * SECOND);
	define("HOUR", 60 * MINUTE);
	define("DAY", 24 * HOUR);
	define("MONTH", 30 * DAY);

	$delta = strtotime('+2 hours') - $time;
	if ($delta < 2 * MINUTE) {
		return "1 min ago";
	}
	if ($delta < 45 * MINUTE) {
		return floor($delta / MINUTE) . " min ago";
	}
	if ($delta < 90 * MINUTE) {
		return "1 hour ago";
	}
	if ($delta < 24 * HOUR) {
		return floor($delta / HOUR) . " hours ago";
	}
	if ($delta < 48 * HOUR) {
		return "yesterday";
	}
	if ($delta < 30 * DAY) {
		return floor($delta / DAY) . " days ago";
	}
	if ($delta < 12 * MONTH) {
		$months = floor($delta / DAY / 30);
		return $months <= 1 ? "1 month ago" : $months . " months ago";
	} else {
		$years = floor($delta / DAY / 365);
		return $years <= 1 ? "1 year ago" : $years . " years ago";
	}
}

/*-----------------------------------------------------------------------------------*/
/*	Twitter widget function
/*-----------------------------------------------------------------------------------*/

function tz_parse_cache_feed($usernames, $limit) {
	$username_for_feed = str_replace(" ", "+OR+from%3A", $usernames);
	$feed = "http://search.twitter.com/search.atom?q=from%3A" . $username_for_feed . "&rpp=" . $limit;
	$usernames_for_file = str_replace(" ", "-", $usernames);
	$cache_file = dirname(__FILE__).'/cache/' . $usernames_for_file . '-twitter-cache';
	$last = filemtime($cache_file);
	$now = time();
	$interval = 600; // ten minutes
	// check the cache file
	if ( !$last || (( $now - $last ) > $interval) ) {
		// cache file doesn't exist, or is old, so refresh it
		$cache_rss = file_get_contents($feed);
		if (!$cache_rss) {
			// we didn't get anything back from twitter
			echo "<!-- ERROR: Twitter feed was blank! Using cache file. -->";
		} else {
			// we got good results from twitter
			echo "<!-- SUCCESS: Twitter feed used to update cache file -->";
			$cache_static = fopen($cache_file, 'wb');
			fwrite($cache_static, serialize($cache_rss));
			fclose($cache_static);
		}
		// read from the cache file
		$rss = @unserialize(file_get_contents($cache_file));
	}
	else {
		// cache file is fresh enough, so read from it
		echo "<!-- SUCCESS: Cache file was recent enough to read from -->";
		$rss = @unserialize(file_get_contents($cache_file));
	}
	// clean up and output the twitter feed
	$feed = str_replace("&amp;", "&", $rss);
	$feed = str_replace("&lt;", "<", $feed);
	$feed = str_replace("&gt;", ">", $feed);
	$clean = explode("<entry>", $feed);
	$clean = str_replace("&quot;", "'", $clean);
	$clean = str_replace("&apos;", "'", $clean);
	$amount = count($clean) - 1;
	
	if ($amount) { // are there any tweets?
		
		?>
    <div id="twitter_div" class="clearfix">
          <ul id="twitter_update_list"> 
    <?php
		for ($i = 1; $i <= $amount; $i++) {
			$entry_close = explode("</entry>", $clean[$i]);
			$clean_content_1 = explode("<content type=\"html\">", $entry_close[0]);
			$clean_content = explode("</content>", $clean_content_1[1]);
			$clean_name_2 = explode("<name>", $entry_close[0]);
			$clean_name_1 = explode("(", $clean_name_2[1]);
			$clean_name = explode(")</name>", $clean_name_1[1]);
			$clean_user = explode(" (", $clean_name_2[1]);
			$clean_lower_user = strtolower($clean_user[0]);
			$clean_uri_1 = explode("<uri>", $entry_close[0]);
			$clean_uri = explode("</uri>", $clean_uri_1[1]);
			$clean_time_1 = explode("<published>", $entry_close[0]);
			$clean_time = explode("</published>", $clean_time_1[1]);
			$unix_time = strtotime($clean_time[0]);
			$pretty_time = relativeTime($unix_time);
			?>

                    <li><span><?php echo $clean_content[0]; ?></span> <small><a href="<?php echo $clean_uri[0]; ?>"><?php echo $pretty_time; ?></a></small></li>
			<?php
		}
		
		?>
    	</ul>
        
    </div>
    <?php
	}
	else 
	{
		?>
        <div id="twitter_div" class="clearfix">
            <ul id="twitter_update_list">
                <li><span>Twitter should be here, but it's not. Get over it.</span></li>
            </ul>
        </div>
        <?php
	}
}

?>
