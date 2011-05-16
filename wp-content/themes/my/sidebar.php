<div id="sidebar">
<?php if(get_option('mywp_top_ad') <> null) { 
  echo '<div class="side-big-ad col">';
	echo stripslashes(get_option('mywp_top_ad'));
  echo '</div>';
}	?>

<?php include('banner.php'); ?> 

<?php
  if ( is_active_sidebar( 'sidebar-3' ) ) : 
  	dynamic_sidebar( 'sidebar-3' );
  endif;
?>

<?php include('tab.php'); ?>

<?php if(get_option('id8') <> null ){ ?>
  <div id="us" class="widget">
    <h3><?php _e('User Link Feed','my') ?></h3>
    <ul>
  	<?php 
		$comment_array = array_reverse(get_approved_comments(get_option('id8')));  
		$count = 0; 
    
    foreach($comment_array as $comment){ 
    
    	$GLOBALS['comment'] = $comment;
			$art_title_array = get_comment_meta(get_comment_ID(),"art_title");
			$art_title = $art_title_array[0];
			$art_url_array = get_comment_meta(get_comment_ID(),"art_url");
			$art_url = $art_url_array[0];
			
    	if ($count++ < get_option('wdn_count')) { ?>  
     	<li>
     		<a href="<?php echo $art_url; ?>"><?php echo $art_title; ?></a>
     		<br /><?php comment_text(); ?>
     	</li>  
 			
 		<?php } } ?> 
  	</ul>
    <a href="<?php bloginfo('url'); ?>/?page_id=<?php echo get_option('id8'); ?>" class="button"><?php _e('More','my') ?></a>
    <a href="<?php bloginfo('url'); ?>/?page_id=<?php echo get_option('id8'); ?>/#respond" class="button"><?php _e('Submit','my') ?></a>
  </div>          
<?php }	?>

<?php
  if ( is_active_sidebar( 'sidebar-1' ) ) : 
  	dynamic_sidebar( 'sidebar-1' );
  endif;
?>
   
<?php  
	if(get_option('mywp_bottom_ad') <> null )
	{ 
    echo '<div class="side-big-ad col">';
		echo stripslashes(get_option('mywp_bottom_ad'));
  	echo '</div>';
  }	
?>    
</div>