<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$image_size = array(1200,false,false,true,false);

$columns = DfdMetaBoxSettings::compared('gallery_single_columns', '3');

$gallery = Dfd_Theme_Helpers::get_post_gallery_images('gallery', $image_size);

if(!empty($gallery)) {
	echo '<div class="media-cover">';
		echo '<div class="dfd-inside-gallery-wrap portfolio-masonry-gallery isotope-columns-'.esc_attr($columns).'" data-enable-isotope="1" data-layout-type="masonry" data-columns="'.esc_attr($columns).'" data-item-class="gallery-item">'. $gallery .'</div>';
	echo '</div>';
}