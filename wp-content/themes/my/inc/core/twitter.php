<?php
/**
 * Twitter Functions
 *
 */
if ( !function_exists('relativeTime') ) :

function relativeTime( $original, $do_more = 0 ) {
        // array of time period chunks
        $chunks = array(
                array(60 * 60 * 24 * 365 , 'year'),
                array(60 * 60 * 24 * 30 , 'month'),
                array(60 * 60 * 24 * 7, 'week'),
                array(60 * 60 * 24 , 'day'),
                array(60 * 60 , 'hour'),
                array(60 , 'minute'),
        );

        $today = time();
        $since = $today - $original;

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
                $seconds = $chunks[$i][0];
                $name = $chunks[$i][1];

                if (($count = floor($since / $seconds)) != 0)
                        break;
        }

        $print = ($count == 1) ? '1 '.$name : "$count {$name}s";

        if ($i + 1 < $j) {
                $seconds2 = $chunks[$i + 1][0];
                $name2 = $chunks[$i + 1][1];

                // add second item if it's greater than 0
                if ( (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0) && $do_more )
                        $print .= ($count2 == 1) ? ', 1 '.$name2 : ", $count2 {$name2}s";
        }
        return $print;
}
endif;


define('MAGPIE_CACHE_ON', 1); //2.7 Cache Bug
define('MAGPIE_CACHE_AGE', 900);
define('MAGPIE_INPUT_ENCODING', 'UTF-8');
define('MAGPIE_OUTPUT_ENCODING', 'UTF-8');


function parse_cache_twitter_feed($usernames, $limit, $type) {
	
	include_once(ABSPATH . WPINC . '/rss.php');
	global $shortname;
	$tweet_count = get_option("widget_twitterwidget");
	$count = ($tweet_count) ? $tweet_count : '5';
	
	$messages = fetch_rss('http://twitter.com/statuses/user_timeline/'.$usernames.'.rss');
	
	if ($usernames == '') {
		$out .= '<p>Twitter not configured.</p>';
	} else {
			if ( empty($messages->items) ) {
				$out .= '<p>No public Twitter messages.</p>';
			} else {
        $i = 0;

		foreach ( $messages->items as $message ) {
			$msg = substr(strstr($message['description'],': '), 2, strlen($message['description']))." ";
			if($encode_utf8) $msg = utf8_encode($msg);
			$link = $message['link'];
			$time = $message['pubdate'];
			
			
			if($type == 'teaser') {
				$msg = hyperlinks($msg);
				$out .= '<p class="tweet">';
				$out .= $msg;
				$out .= '<small>(' . relativeTime(strtotime($time)) . '&nbsp;ago)</small>';
				$out .= '</p>';
			}
			
			if($type == 'widget') {
				$out .= '<li>';
				$out .= '<a class="target_blank" href="' .$link. '" title="' .relativeTime(strtotime($time)). '">' .$msg. '<small>(' . relativeTime(strtotime($time)) . '&nbsp;ago)</small></a>';
				$out .= '</li>';
			}

			$i++;
			if ( $i >= $limit ) break;
		}


			}
		}
		
	return $out;
}

function hyperlinks($text) {
    // Props to Allen Shaw & webmancers.com
    // match protocol://address/path/file.extension?some=variable&another=asf%
    $text = preg_replace('/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);
    // match www.something.domain/path/file.extension?some=variable&another=asf%
    $text = preg_replace('/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);    
    
    // match name@address
    $text = preg_replace("/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text);
        //mach #trendingtopics. Props to Michael Voigt
    $text = preg_replace('/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)#{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/#search?q=$2\" class=\"twitter-link\">#$2</a>$3 ", $text);
    return $text;
}

?>