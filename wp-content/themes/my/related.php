<?php
if(get_option('related_type') == "tags_based") {
$tags = wp_get_post_tags($post->ID);
if ($tags) {
	$tag_ids = array();
	foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

	$args=array(
		'tag__in' => $tag_ids,
		'post__not_in' => array($post->ID),
		'showposts'=>6, // Number of related posts that will be shown.
		'caller_get_posts'=>1
	);
} else { echo 'not related posts.'; }}

if(get_option('related_type') == "cats_based") {
$categories = get_the_category($post->ID);
if ($categories) {
	$category_ids = array();
	foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

	$args = array(
		'category__in' => $category_ids,
		'post__not_in' => array($post->ID),
		'showposts'=>6, // Number of related posts that will be shown.
		'caller_get_posts'=>1
	);
} else { echo 'not related posts.'; }}

// OUTPUT
	$backup = $post;
	$my_query = new wp_query($args);
	while ($my_query->have_posts()) : $my_query->the_post();
	?>
	
	<li>
		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
		<?php if(get_option('index_layout') == null) { } else { ?> <?php image_management('thumb-post-thumbnail',50,50); } ?>
		<span><?php the_title(); ?></span>
		</a>
	</li>
	
<?php endwhile; $post = $backup; wp_reset_query(); ?>