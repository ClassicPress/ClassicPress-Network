<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$image_size = false;

$columns = DfdMetaBoxSettings::compared('portfolio_single_columns', '3');

if(DfdMetaBoxSettings::get('portfolio_single_reduce_image_size') == 'on') {
	$image_size = array(1920/(int)$columns,false,false,true,false);
}

$gallery = Dfd_Theme_Helpers::get_post_gallery_images('my_product', $image_size, 'full');

if(!empty($gallery)) {
	echo '<div class="media-cover">';
		echo '<div class="dfd-inside-gallery-wrap portfolio-masonry-gallery isotope-columns-'.esc_attr($columns).'" data-enable-isotope="1" data-layout-type="masonry" data-columns="'.esc_attr($columns).'" data-item-class="gallery-item">'. $gallery .'</div>';
	echo '</div>';
}