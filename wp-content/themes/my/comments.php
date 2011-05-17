<?php
if ($post->ID != get_option('id8')) { // To check if it is for user link feed page

if ( post_password_required() ) : ?>
	<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'my' ); ?></p>
<?php
/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>
<!-- You can start editing here. -->

<div id="comment_wrap">
<?php if ( have_comments() ) : ?> 
	<h3><?php comments_number('Seja o primeiro a comentar', 'One Comment', '% Comments' );?></h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'my' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'my' ) ); ?></div>
				<div class="clear"></div>
			</div> <!-- .navigation -->

			<?php endif; // check for comment navigation ?> 
    	<ul class="commentlist">
      	<?php wp_list_comments( array( 'callback' => 'my_comment' ) ); ?>
      </ul>
      
    </div>
<?php else : // or, if we don't have comments:
?></div><?php
	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
	<p class="nocomments"><?php _e( 'Comments are closed.', 'my' ); ?></p>

<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php 
$fields =  array(
	'author' => '<p><label for="author"><small>Name (required)</small></label><br /><input id="author2" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' /></p>',
	'email'  => '<p><label for="email"><small>Mail (will not be published) (required)</small></label><br /><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' /></p>',
	'url'    => '<p><label for="url"><small>Website</small></label><br /><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></p>',
);

$defaults = array(
	'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
	'comment_field'        => '<p><label for="comment"><small>Message</small></label><br /><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
	'comment_notes_before' => '',
	'comment_notes_after' => '',
	'id_form'              => 'commentform',
	'id_submit'            => 'submit-comment',
	'title_reply'          => __( 'Leave a Reply' ),
	'title_reply_to'       => __( 'Leave a Reply to %s' ),
	'cancel_reply_link'    => __( 'Cancel reply' ),
	'label_submit'         => __( 'Post Comment' ),
);

comment_form($defaults); ?>

<?php } else { ?> 

<?php // Do not delete these lines
	if ( post_password_required() ) : ?>
	<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'my' ); ?></p>
<?php
/* Stop the rest of comments.php from being processed,
* but don't kill the script entirely -- we still have
* to fully load the template.
*/
		return;
	endif;
$oddcomment = 'class="alt" ';
?>

<!-- You can start editing here. -->
<div id="comment_wrap" class="widget spe">
<?php if ($comments) : ?>
	<ul>
	<?php wp_list_comments( array( 'callback' => 'magazine_news', 'reverse_top_level' => true ) ); ?>
	</ul>
	
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<div class="navigation">
			<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Antigos Comentários', 'my' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Novos Comentários <span class="meta-nav">&rarr;</span>', 'my' ) ); ?></div>
			<div class="clear"></div>
		</div> <!-- .navigation -->

	<?php endif; // check for comment navigation ?> 

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e('Comentários Desativados.','my') ?></p>

	<?php endif; ?>
   
<?php endif; ?>
</div>

<?php if ('open' == $post->comment_status) : ?>
<div id="respond">
<h3 class="ulf"><?php _e('Submit News','my') ?></h3>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php _e('You must be','my') ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in','my') ?></a> <?php _e('to post a comment.','my') ?></p></div>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<?php if ( $user_ID ) : ?>

<p><label for="art_title"><?php _e('News Title', 'my') ?> :</label><br /><input type="text" name="art_title" id="author2" value="<?php echo $art_title; ?>" tabindex="1" class="required" /></p>

<p><label for="art_url"><?php _e('News URL','my') ?> :</label><br /><input type="text" name="art_url" id="url" value="<?php echo $art_url; ?>" tabindex="2" class="required" /></p>

<p><label for="email"><?php _e('Your Email', 'my') ?> : </label><br /><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="3" class="required" /></p>

<p><label for="author"><?php _e('Your Name', 'my') ?></label><br /><input id="author2" name="author" type="text" value="<?php echo $comment_author; ?>" /></p>

<?php else : ?>

<p><label for="art_title"><?php _e('News Title', 'my') ?> :</label><br /><input type="text" name="art_title" id="author2" value="<?php echo $art_title; ?>" tabindex="1" class="required" /></p>

<p><label for="art_url"><?php _e('News URL','my') ?> :</label><br /><input type="text" name="art_url" id="url" value="<?php echo $art_url; ?>" tabindex="2" class="required" /></p>

<p><label for="email"><?php _e('Your Email', 'my') ?> : </label><br /><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="3" class="required" /></p>

<p><label for="author"><?php _e('Your Name', 'my') ?></label><br /><input id="author2" name="author" type="text" value="<?php echo $comment_author; ?>" /></p>

<?php endif; ?>

<p><label><?php _e('Web Design News', 'my') ?>  :</label><br /><textarea name="comment" id="comment" tabindex="4" maxlength="255" rows="20"></textarea></p>



<p><input name="submit" type="submit" id="submit-comment" value="Submit" tabindex="5" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>
<?php do_action('', $post->ID); ?>

</form>
</div>
<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>

<?php } ?> 