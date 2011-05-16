<?php /* COMMENT AREA
/* ----------------------------------------------*/
if ( ! function_exists( 'my_comment' ) ) :
function my_comment($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
    <div id="div-comment-<?php comment_ID(); ?>" class="s">
    
        <div class="comment-author vcard ava">
        <?php echo get_avatar( $comment, 80 ); ?> 
        </div>
		
        <div class="comment-meta commentmetadata commentdata">
        <div class="reply">
        
        <?php comment_reply_link(array_merge( $args, array('add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        <small><?php printf(__('%s'), get_comment_author_link()) ?> . <?php printf(__('%1$s'), get_comment_date()) ?> . <?php edit_comment_link(__('(Edit)'),'  ','') ?></small>
        
        </div>        
        
		<?php if ($comment->comment_approved == '0') : ?>
        <p><em><?php _e('Your comment is awaiting moderation.') ?></em></p>
        <br />
        <?php endif; ?>

		<?php comment_text() ?>


    	</div>

	</div>

<?php
} endif;
 

        
if ( ! function_exists( 'magazine_news' ) ) : 
function magazine_news($comment, $args, $depth) {
$GLOBALS['comment'] = $comment;

    	$GLOBALS['comment'] = $comment;
			$art_title_array = get_comment_meta(get_comment_ID(),"art_title");
			$art_title = $art_title_array[0];
			$art_url_array = get_comment_meta(get_comment_ID(),"art_url");
			$art_url = $art_url_array[0];
			
			?>
    <li <?php echo $oddcomment; ?>id="comment-<?php comment_ID() ?>">
    <small class="alignright"><?php echo get_avatar( $comment, 40 ); ?></small>
    <strong><a href="<?php echo $art_url; ?>" target="_blank"><?php echo $art_title; ?></a></strong>
    <br /><small><?php comment_date() ?></small>
    <?php comment_text() ?>
    <?php if ($comment->comment_approved == '0') : ?>
	  <em><?php _e('Your comment is awaiting moderation.','my') ?></em>
		<?php endif; ?>
		<div class="clear"></div>
		</li>
<?php } endif; ?>