<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$main_images = Dfd_Theme_Helpers::get_post_gallery_images('gallery', false, 'full');

$thumbs = Dfd_Theme_Helpers::get_post_gallery_images('gallery', array(300,200,true,true,true), 'full', true);

if(!empty($main_images) && !empty($thumbs)) {
	echo '<div class="gallery-main-carousel-wrap">';
		echo '<div id="gallery-main-carousel">'. $main_images .'</div>';
		echo '<div class="slider-controls">'
				. '<a href="#" title="slick-prev" class="dfd-socicon-arrow-left-01 prev"><span class="count"></span></a>'
				. '<a href="#" title="slick-next" class="dfd-socicon-arrow-right-01 next"><span class="count"></span></a>'
			. '</div>';
		echo '</div>';
	echo '<div id="gallery-thumbs-carousel">'. $thumbs .'</div>';
}