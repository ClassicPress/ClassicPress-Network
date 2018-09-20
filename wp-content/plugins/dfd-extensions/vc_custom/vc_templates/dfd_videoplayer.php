<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $dfd_native, $content_width, $wp_embed;

$main_style = $el_class = $title_font_options = $subtitle_font_options = $video_animation = $full_screen_video_data = $module_animation = $animation_data = $an_class  = '';
$title = $subtitle = $video_thumb = $video_link = $button_align = $full_width_background = $main_border = $icon_color = $icon_background = $icon_border = $icon_x_offset = '';
$lightbox_background_color = $output = $title_html = $thumb_html = $subtitle_html = $button_html = $content_html = $link_css = $unique_id_shortcode = $unique_id = '';
$main_border_css = $border_radius = $icon_border_css = $main_background = $size = $main_background_hover = $main_border_hover = $use_google_fonts = $icon_bg_size = '';
$custom_fonts = $icon_hover_color = $icon_hover_background = $icon_hover_border = $gen_border_radius = $shadow = $shadow_class = $video_box_shadow = $icon_font_size = '';
$video_html = '';

$atts = vc_map_get_attributes( 'dfd_videoplayer', $atts );
extract( $atts );

$size = (isset($content_width)) ? (int)$content_width : 600;
if(isset($dfd_native['dev_mode']) && $dfd_native['dev_mode'] == 'on' && defined('DFD_DEBUG_MODE') && DFD_DEBUG_MODE) {
	wp_enqueue_script( 'video-module-js', get_template_directory_uri() .'/assets/js/dfd-video-module.js', array( 'jquery' ), false, true );
}

$unique_id_shortcode = uniqid('video-player-') .'-'.rand(1,9999);
$unique_id = uniqid('module_video_');

if($module_animation != '') {
	$animation_data = ' data-animate="1" data-animate-type = "'.esc_attr($module_animation).'" ';
}

if(isset($video_animation) && $video_animation != '') {
	$full_screen_video_data = 'data-animation="'.esc_attr($video_animation).'"';
}

if(!empty($title)) {
	$title_options = _dfd_parse_text_shortcode_params( $title_font_options, 'dfd-widget-post-title', $use_google_fonts, $custom_fonts);
	$title_html = '<'.$title_options['tag'].' class="' .$title_options['class'].'" ' . $title_options['style'] . '>' . esc_html( $title ) . '</'.$title_options['tag'].'>';
}
if (!empty($subtitle)) {
	$subtitle_options = _dfd_parse_text_shortcode_params($subtitle_font_options, 'dfd-content-subtitle');
	$subtitle_html = '<'.$subtitle_options['tag'].' class="' . $subtitle_options['class'] . '" ' . $subtitle_options['style'] . '>' . esc_html( $subtitle ) . '</'.$subtitle_options['tag'].'>';
}

$el_class .= ' '.$button_align.' '.$main_style.' ';

if(isset($video_thumb) && !empty($video_thumb)) {
	$el_class .= ' with-thumb';
}

if(isset($icon_bg_size) && $icon_bg_size != '') {
	$link_css .= '#'.esc_js($unique_id_shortcode).'.style-1 .container-play {width: '.esc_attr($icon_bg_size).'px; height: '.esc_attr($icon_bg_size).'px; line-height: '.esc_attr($icon_bg_size).'px; margin-top: -'.(esc_attr($icon_bg_size) / 2).'px; margin-left: -'.(esc_attr($icon_bg_size) / 2).'px;}';
	$link_css .= '#'.esc_js($unique_id_shortcode).' .dfd-video-button {width: '.esc_attr($icon_bg_size).'px; height: '.esc_attr($icon_bg_size).'px; line-height: '.esc_attr($icon_bg_size).'px;}';
	$link_css .= '#'.esc_js($unique_id_shortcode).'.style-1 .dfd-video-image-thumb i {font-size: '.(esc_attr($icon_bg_size) / 2.5).'px;}';
	if($icon_bg_size <= 60) {
		$link_css .= '#'.esc_js($unique_id_shortcode).'.style-1 .dfd-video-image-thumb i:before {left: 2px;}';
	}
	if(isset($icon_font_size) && $icon_font_size != '') {
		$link_css .= '#'.esc_js($unique_id_shortcode).'.style-1 .dfd-video-image-thumb i, #'.esc_js($unique_id_shortcode).' .dfd-video-button {font-size: '.esc_attr($icon_font_size).'px;}';
	}
	if(isset($icon_x_offset) && $icon_x_offset != '') {
		$link_css .= '#'.esc_js($unique_id_shortcode).'.style-1 .dfd-video-image-thumb i:before, #'.esc_js($unique_id_shortcode).' .dfd-video-button i:before {left: '.esc_attr($icon_x_offset).'px;}';
	}
}

if(substr_count($video_box_shadow, 'disable') == 0) {
	$video_box_shadow = Dfd_Box_Shadow_Param::box_shadow_css($video_box_shadow);
}
if(isset($shadow) && $shadow =='permanent') {
	$shadow_class = esc_attr($shadow);
	$link_css .= '#'.esc_js($unique_id_shortcode).'.style-1 .dfd-video-content.permanent:before {'.esc_attr($video_box_shadow).'}';
}elseif(isset($shadow) && $shadow =='on-hover') {
	$shadow_class = esc_attr($shadow);
	$link_css .= '#'.esc_js($unique_id_shortcode).'.style-1 .dfd-video-content.on-hover:hover:before {'.esc_attr($video_box_shadow).'}';
}

if(isset($full_width_background) && strcmp($full_width_background, 'full_width') === 0) {
	$link_css .= '#'.esc_js($unique_id_shortcode).' .button-wrap {display: block;}';
}
if($main_border != '') {
	$main_border_css = Dfd_Border_Param::border_css($main_border);
	if(substr_count($main_border_css,'border-radius:') > 0) {
		$border_radius = substr($main_border_css,stripos($main_border_css,'border-radius:'));
		if($border_radius != '') {
			$link_css .= '#'.esc_js($unique_id_shortcode).' .decoration-mask, #'.esc_js($unique_id_shortcode).' .dfd-video-button {' . $border_radius . '}';
		}
	}
	$link_css .= '#'.esc_js($unique_id_shortcode).' .decoration-mask {' . $main_border_css . '}';
}
if($main_border_hover != '') {
	$main_border_hover_css = Dfd_Border_Param::border_css($main_border_hover);
	if(substr_count($main_border_hover_css,'border-radius:') > 0) {
		$border_radius = substr($main_border_hover_css,stripos($main_border_hover_css,'border-radius:'));
		if($border_radius != '') {
			$link_css .= '#'.esc_js($unique_id_shortcode).' .button-wrap:hover .decoration-mask, #'.esc_js($unique_id_shortcode).' .button-wrap:hover .dfd-video-button .decoration-icon {' . $border_radius . '}';
		}
	}
	$link_css .= '#'.esc_js($unique_id_shortcode).' .button-wrap:hover .decoration-mask {' . $main_border_hover_css . '}';
}
if(isset($main_background) && !empty($main_background)) {
	$link_css .= '#'.esc_js($unique_id_shortcode).' .decoration-mask {background: '.esc_attr($main_background).';}';
}
if(isset($main_background_hover) && !empty($main_background_hover)) {
	$link_css .= '#'.esc_js($unique_id_shortcode).' .button-wrap:hover .decoration-mask {background: '.esc_attr($main_background_hover).';}';
}
if(isset($icon_color) && !empty($icon_color)) {
	$link_css .= '#'.esc_js($unique_id_shortcode).' .dfd-video-button, #'.esc_js($unique_id_shortcode).'.style-1 .dfd-video-image-thumb i {color: '.esc_attr($icon_color).';}';
}
if(isset($icon_hover_color) && !empty($icon_hover_color)) {
	$link_css .= '#'.esc_js($unique_id_shortcode).' .button-wrap:hover .dfd-video-button, #'.esc_js($unique_id_shortcode).'.style-1 .dfd-video-image-thumb .container-play:hover i {color: '.esc_attr($icon_hover_color).';}';
}
if(isset($icon_background) && !empty($icon_background)) {
	$link_css .= '#'.esc_js($unique_id_shortcode).' .decoration-icon {background: '.esc_attr($icon_background).';}';
}
if(isset($icon_hover_background) && !empty($icon_hover_background)) {
	$link_css .= '#'.esc_js($unique_id_shortcode).'.style-2 .button-wrap:hover .decoration-icon, #'.esc_js($unique_id_shortcode).'.style-1 .container-play:hover .decoration-icon {background: '.esc_attr($icon_hover_background).';}';
}
if($icon_border != '') {
	$icon_border_css = Dfd_Border_Param::border_css($icon_border);
	$link_css .= '#'.esc_js($unique_id_shortcode).' .decoration-icon {' . $icon_border_css . '}';
}
if($icon_hover_border != '') {
	$icon_hover_border_css = Dfd_Border_Param::border_css($icon_hover_border);
	$link_css .= '#'.esc_js($unique_id_shortcode).'.style-1 .container-play:hover .decoration-icon, #'.esc_js($unique_id_shortcode).'.style-2 .button-wrap:hover .decoration-icon {' . $icon_hover_border_css . '}';
}
if(isset($gen_border_radius) && $gen_border_radius != '') {
	$link_css .= '#'.esc_js($unique_id_shortcode).' .dfd-video-content {border-radius: '.$gen_border_radius.'px;}';
}

//global $wp_embed;
$video_w = $size;
$video_h = $size / 1.61; //1.61 golden ratio
/** @var WP_Embed $wp_embed  */
$embed = $wp_embed->run_shortcode( '[embed width="' . $video_w . '"' . $video_h . ']' . $video_link . '[/embed]' );

$button_html .= '<div class="button-wrap">';
	$button_html .= '<span class="decoration-mask"></span>';
	
	$button_html .= '<div class="dfd-video-alignment-block" >';
		$button_html .= '<div class="dfd-video-button" >';
//			$button_html .= '<span class="decoration-icon"></span>';
			$button_html .= '<i class="dfd-socicon-icon-play"><span class="decoration-icon"></span></i>';
		$button_html .= '</div>';
		if($title || $subtitle) {
			$button_html .= '<div class="title-wrap">';
				$button_html .= $title_html;
				$button_html .= $subtitle_html;
			$button_html .= '</div>';
		}
	$button_html .= '</div>';
	
	$button_html .= '<a href="'.esc_url($video_link).'?width=1200&height=675" data-rel="prettyPhoto" class="dfd-video-link" '.$full_screen_video_data.'></a>';
$button_html .= '</div>';

if(isset($main_style) && strcmp($main_style, 'style-1') === 0 ) {
	$content_html .= '<div class="dfd-video-content video-content '.$shadow_class.'" id="'.esc_js($unique_id).'">';
		if(isset($video_thumb) && !empty($video_thumb)) {
			$thumb_image_url = wp_get_attachment_image_src($video_thumb, 'full');
			$image_src = dfd_aq_resize($thumb_image_url[0], $video_w, $video_h, true, true, true);
			if(!$image_src) {
				$image_src = $thumb_image_url[0];
			}
			$img_atts = Dfd_Theme_Helpers::get_image_attrs($image_src, $video_thumb, $video_w, $video_h, '');
			//global $dfd_native;
			$extra_class = '';
			if(isset($dfd_native['enable_images_lazy_load']) && $dfd_native['enable_images_lazy_load'] == 'on') {
				$extra_class = 'dfd-img-lazy-load';
				$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $video_w $video_h'%2F%3E";
				$img_html = '<img src="'.$loading_img_src.'" data-src="'.esc_url($image_src).'" '.$img_atts.' />';
			} else {
				$img_html = '<img src="'.esc_url($image_src).'" '.$img_atts.' />';
			}
				$thumb_html .= '<a href="#'.esc_js($unique_id).'" class="dfd-video-image-thumb '.esc_attr($extra_class).'" title="'.esc_html__('Play video','dfd-native').'">';
					$thumb_html .= '<span class="container-play">';
						$thumb_html .= '<span class="decoration-icon"></span>';
						$thumb_html .= '<i class="dfd-socicon-icon-play"></i>';
					$thumb_html .= '</span>';
					$thumb_html .= $img_html;
				$thumb_html .= '</a>';
			
		}
		if(isset($video_options) && $video_options === 'selfhosted') {
			if(isset($video_link) && !empty($video_link)) {
				$atts = array(
					'src'      => $video_link,
//					'poster'   => $image_src,
					'height'   => '',
					'width'    => '',
				);
				$video_html = wp_video_shortcode( $atts );
			}
		}

		$content_html .= '<div class="dfd-video-box">';
			$content_html .= $thumb_html;
			if (isset($video_options) && $video_options === 'default') {
				$content_html .= '<div class="wpb_video_wrapper">' . $embed . '</div>';
			} 
			if (isset($video_options) && $video_options === 'selfhosted') {
				$content_html .= '<div class="wpb_video_wrapper">' . $video_html . '</div>';
			} 
		$content_html .= '</div>';
	$content_html .= '</div>';
}

$output .= '<div class="animation-container '.$an_class.'" '.$animation_data.'>';
	$output .= '<div id="'.esc_js($unique_id_shortcode).'" class="dfd-videoplayer '.esc_attr($el_class).'" data-id="'.esc_attr($unique_id).'" data-block-id="'.esc_attr($unique_id_shortcode).'">';
		if(isset($main_style) && strcmp($main_style, 'style-2') === 0) {
			$output .= $button_html;
			$output .= $content_html;
		}else{
			$output .= $content_html;
		}
	$output .= '</div>';
	
	if($link_css != '') {
		$output .= '<script type="text/javascript">'
					. '(function($) {'
						. '$("head").append("<style>'.$link_css.'</style>");'
					. '})(jQuery);'
				. '</script>';
	}
	
$output .= '</div>';

echo $output;
