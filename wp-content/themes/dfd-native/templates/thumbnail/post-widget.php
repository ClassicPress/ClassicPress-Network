<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if (has_post_thumbnail()) {
	$thumb_img = get_post_thumbnail_id();
	$img_url = wp_get_attachment_image_src($thumb_img, array(150,150)); //get img URL
	echo '<img src="'. esc_url($img_url[0]) .'" alt="'. esc_attr(get_the_title()) .'" />';
} else {
	get_template_part('templates/entry-meta/post-format-icon');
}
?>