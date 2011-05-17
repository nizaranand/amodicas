<?php
/* POST THUMBNAILS
/* ----------------------------------------------*/
add_theme_support('post-thumbnails', array('post')); // Add it for posts
set_post_thumbnail_size(600, 300, true); // Normal post thumbnails
add_image_size('med-post-thumbnail', 200, 100, true); 
add_image_size('thumb-post-thumbnail', 50, 50, true); 
add_image_size('normal-post-thumbnail',200,200,true);

register_nav_menus( array( // Register Nav Menu
	'primary' => __( 'Top Menu' ),
	'secondary' => __( 'Main Menu' ),
) );

/* CUSTOM EXCERPT
/* ----------------------------------------------*/
function themetation_excerpt_length( $length ) {
	
	global $ex_length;
	$ex_length = get_option('ex_length');
	return $ex_length;
}
add_filter( 'excerpt_length', 'themetation_excerpt_length' );

function themetation_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue lendo <span class=\"meta-nav\">&rarr;</span>', 'themetation' ) . '</a>';
}

function themetation_auto_excerpt_more( $more ) {
	return ' &hellip;'; //. themetation_continue_reading_link();
}
add_filter( 'excerpt_more', 'themetation_auto_excerpt_more' );

/* RECENT COMMENTS
/* ----------------------------------------------*/
function src_simple_recent_comments($src_count=5, $src_length=70, $pre_HTML='', $post_HTML='') {
	global $wpdb;
	$id8 = get_option('id8');
	$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_author_email, comment_type, 
			SUBSTRING(comment_content,1,$src_length) AS com_excerpt 
		FROM $wpdb->comments 
		LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) 
		WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' AND post_type='post'
		ORDER BY comment_date_gmt DESC 
		LIMIT $src_count";
	$comments = $wpdb->get_results($sql);
	$output = $pre_HTML;
	foreach ($comments as $comment) {
		$output .= "<li><a href=\"" . get_permalink($comment->ID) . "#comment-" . $comment->comment_ID  . "\" title=\"on " . $comment->post_title . "\"><div class=\"gra\">" . get_avatar($comment->comment_author_email, 25) .'</div><div class="co"><strong>' . $comment->comment_author . ' : </strong><br />' . strip_tags($comment->com_excerpt) ." ...</div></a></li>";
	}
	$output .= $post_HTML;
	echo $output;
}

// Adding Custom Comment Fields
/* ----------------------------------------------*/
add_action ('comment_post', 'add_meta_title', 1);
function add_meta_title($comment_id) {
	add_comment_meta($comment_id, 'art_title', $_POST['art_title'], true);
}

add_action ('comment_post', 'add_meta_url', 1);
function add_meta_url($comment_id) {
	add_comment_meta($comment_id, 'art_url', $_POST['art_url'], true);
}
?>