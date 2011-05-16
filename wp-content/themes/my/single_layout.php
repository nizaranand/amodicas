<?php  
	if(get_option('single_layout') == "normal-single-layout"){ 
// Layout - thumbnail > excerpt > author box > content	
?>

<div class="thumb">
<?php image_management('normal-post-thumbnail',200,200) ?>
</div>

<div class="text">
<small><?php the_time('F jS') ?> <?php _e('in','my')?> <?php the_category(', ') ?> <?php _e('by','my') ?> <?php the_author_posts_link(); ?> . <?php edit_post_link('Edit', '', ' '); ?></small>
<h1><?php the_title(); ?></h1>
<p><em><?php the_excerpt(); ?></em></p>
</div>
<div class="clear"></div>

<div class="author">
	<?php echo get_avatar( get_the_author_id(), '80', 'http://www.gravatar.com/avatar/46c25d7d8f2e19fa2bec248f763a11bd?s=80'); ?>
  <div class="author-text">
  	<strong><?php the_author_posts_link(); ?></strong>
    <p><?php the_author_meta('description'); ?></p> 
    <?php if (get_the_author_url() <> null ) { ?><p><small><a href="<?php the_author_meta('url'); ?>"><?php _e('VIsit','my')?> <?php the_author(); ?>'<?php _e('s website','my')?></a></small></p><?php } ?>
    </div>
    <div class="clear"></div>
</div>

<?php the_content(); ?>

<?php } 

elseif(get_option('single_layout') == "author-bottom-with-excerpt") { // Layout - thumbnail > excerpt > content > author box  ?>

<div class="thumb">
<?php image_management('normal-post-thumbnail',200,200) ?>
</div>

<div class="text">
<small><?php the_time('F jS') ?> <?php _e('in','my')?> <?php the_category(', ') ?> <?php _e('by','my') ?> <?php the_author_posts_link(); ?> . <?php edit_post_link('Edit', '', ' '); ?></small>
<h1><?php the_title(); ?></h1>
<p><em><?php the_excerpt(); ?></em></p>
</div>
<div class="clear"></div>

<?php the_content(); ?>
<div class="author">
  <?php echo get_avatar( get_the_author_id(), '80', 'http://www.gravatar.com/avatar/46c25d7d8f2e19fa2bec248f763a11bd?s=80'); ?>
  <div class="author-text">
    <strong><?php the_author_posts_link(); ?></strong>
    <p><?php the_author_meta('description'); ?></p> 
    <?php if (get_the_author_url() <> null ) { ?><p><small><a href="<?php the_author_meta('url'); ?>"><?php _e('VIsit','my')?> <?php the_author(); ?>'<?php _e('s website','my')?></a></small></p><?php } ?>
  </div>
  <div class="clear"></div>
</div>

<?php } 

elseif(get_option('single_layout') == "without-author-box-and-excerpt") { // Layout - thumbnail > content ?>

<div class="thumb">
<?php image_management('normal-post-thumbnail',200,200) ?>
</div>

<div class="text">
<small><?php the_time('F jS') ?> <?php _e('in','my')?> <?php the_category(', ') ?> <?php _e('by','my') ?> <?php the_author_posts_link(); ?> . <?php edit_post_link('Edit', '', ' '); ?></small>
<h1><?php the_title(); ?></h1>
</div>

<?php the_content(); ?>

<?php } 

elseif(get_option('single_layout') == "without-thumbnail-excerpt-and-author-box") { // Layout - content  ?>

<div class="text no">
<small><?php the_time('F jS') ?> <?php _e('in','my')?> <?php the_category(', ') ?> <?php _e('by','my') ?> <?php the_author_posts_link(); ?> . <?php edit_post_link('Edit', '', ' '); ?></small>
<h1><?php the_title(); ?></h1>
</div>

<?php the_content(); ?>

<?php } 

elseif(get_option('single_layout') == "without-thumbnail-and-excerpt") { // Layout - content > author box ?>

<div class="text no">
<small><?php the_time('F jS') ?> <?php _e('in','my')?> <?php the_category(', ') ?> <?php _e('by','my') ?> <?php the_author_posts_link(); ?> . <?php edit_post_link('Edit', '', ' '); ?></small>
<h1><?php the_title(); ?></h1>

</div>

<?php the_content(); ?>

<div class="author">
	<?php echo get_avatar( get_the_author_id(), '80', 'http://www.gravatar.com/avatar/46c25d7d8f2e19fa2bec248f763a11bd?s=80'); ?>
  <div class="author-text">
  	<strong><?php the_author_posts_link(); ?></strong>
    <p><?php the_author_meta('description'); ?></p> 
    <?php if (get_the_author_url() <> null ) { ?><p><small><a href="<?php the_author_meta('url'); ?>"><?php _e('VIsit','my')?> <?php the_author(); ?>'<?php _e('s website','my')?></a></small></p><?php } ?>
  </div>
  <div class="clear"></div>
</div>

<?php } ?>