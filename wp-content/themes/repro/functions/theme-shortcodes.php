<?php


// Add left 50% column
function one_half($atts, $content = null) {
	return '<span class="one_half">'.$content.'</span>';
}

add_shortcode('one_half', 'one_half');

// Add right 50% column
function one_half_last($atts, $content = null) {
	return '<span class="one_half last">'.$content.'</span>';
}

add_shortcode('one_half_last', 'one_half_last');

// Add left 33% column
function one_third($atts, $content = null) {
	return '<span class="one_third">'.$content.'</span>';
}

add_shortcode('one_third', 'one_third');

// Add right 33% column
function one_third_last($atts, $content = null) {
	return '<span class="one_third last">'.$content.'</span>';
}

add_shortcode('one_third_last', 'one_third_last');


?>