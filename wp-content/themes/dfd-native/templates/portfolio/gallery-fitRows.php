<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$img_width = 1200;

$custom_width = DfdMetaBoxSettings::get('portfolio_single_carousel_img_width');

if($custom_width && !empty($custom_width)) {
	$img_width = $custom_width;
}

$img_height = 1200;

$custom_height = DfdMetaBoxSettings::get('portfolio_single_carousel_img_height');

if($custom_height && !empty($custom_height)) {
	$img_height = $custom_height;
}

$image_size = array($img_width,$img_height,true,true,true);

$columns = DfdMetaBoxSettings::compared('portfolio_single_columns', '3');

$gallery = Dfd_Theme_Helpers::get_post_gallery_images('my_product', $image_size);

if(!empty($gallery)) {
	echo '<div class="media-cover">';
		echo '<div class="dfd-inside-gallery-wrap portfolio-masonry-gallery isotope-columns-'.esc_attr($columns).'" data-enable-isotope="1" data-layout-type="fitRows" data-columns="'.esc_attr($columns).'" data-item-class="gallery-item">'. $gallery .'</div>';
	echo '</div>';
}