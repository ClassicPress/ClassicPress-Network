<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$tags = wp_get_post_tags($post->ID);

if(isset($tags[0]->slug) && $tags[0]->slug != '') {
	/*
	*/
	get_template_part('inc/loop/posts/post');
	
	$options = array(
		//'not_single' => false,
	);
	
	$post_content = new Dfd_post($options);
	
	$wp_query = new WP_Query(array(
		'post_tyle' => 'post',
		'posts_per_page' => 5,
		'post__not_in' => array($post->ID),
		'tag' => $tags[0]->slug
	));
	
	while ($wp_query->have_posts()) : $wp_query->the_post();
		$post_content->post();
	endwhile;
	
	wp_reset_postdata();
}