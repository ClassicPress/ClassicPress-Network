<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$main_style = $uniqid = $el_class = $module_animation = $animation_data = $output = $block_number = $number_text = $number_alignment = $number_position = '';
$title_font_options = $use_google_fonts = $custom_fonts = $subtitle_font_options = $subtitle_google_fonts = $subtitle_custom_fonts = '';
// First side
$link_box = $link = $link_css = $link_html = $mask_background = $title_first = $subtitle_first = $bg_style = $direction = $icon_image_id = $front_content_vertical_offset = '';
$image_url = $img_src = $img_html = $title_html = $subtitle_html = $number_font_options = $number_google_fonts = $number_custom_fonts = $number_font_size = '';
$v_alignment = $h_alignment = $content_alignment = $front_content_horizontal_offset = '';
// Reverse side
$bg_style_reverse = $image_id_reverse = $mask_bg_reverse = $desc_reverse = $back_content_vertical_offset = $back_content_horizontal_offset = '';
$img_src_reverse = $image_url_reverse = $img_reverse_html = $desc_reverse_html = '';
$desc_font_options = $desc_google_fonts = $desc_custom_fonts = '';

$direction_style = $height_block = '';

$atts = vc_map_get_attributes('dfd_rotate_box', $atts);
extract($atts);

$uniqid = uniqid('dfd-rotate-box-').'-'.rand(1,9999);

$el_class .= ' '.$main_style;
$el_class .= ' '.$uniqid;

if(isset($number_position) && $number_position != '' && isset($block_number) && $block_number = 'yes' && isset($number_text) && !empty($number_text)) {
	$el_class .= ' '.$number_position;
}

$direction_style .= $main_style;

if(!($module_animation == '')) {
	$animation_data = ' data-animate="1" data-animate-type = "'.esc_attr($module_animation).'"';
}

$title_font_options = _dfd_parse_text_shortcode_params( $title_font_options, 'dfd-content-title-big', $use_google_fonts, $custom_fonts, true );
$subtitle_font_options = _dfd_parse_text_shortcode_params( $subtitle_font_options, 'dfd-content-subtitle', $subtitle_google_fonts, $subtitle_custom_fonts, true );
$desc_font_options = _dfd_parse_text_shortcode_params( $desc_font_options, '', $desc_google_fonts, $desc_custom_fonts, true );
if(isset($title_font_options['style']) && $title_font_options['style'] != '') {
	$link_css .= '#'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .content-wrap .title-first, .'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .content-wrap .title-first {'.esc_js($title_font_options['style']).'}';
}
if(isset($subtitle_font_options['style']) && $subtitle_font_options['style'] != '') {
	$link_css .= '#'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .content-wrap .subtitle-first, .'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .content-wrap .subtitle-first {'.esc_js($subtitle_font_options['style']).'}';
}
if(isset($desc_font_options['style']) && $desc_font_options['style'] != '') {
	$link_css .= '#'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .content-wrap .description-reverse, .'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .content-wrap .description-reverse {'.esc_js($desc_font_options['style']).'}';
}

// Height block
if(isset($height_block) && !empty($height_block)) {
	$link_css .= '#'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .thumb-wrap-front, #'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .thumb-wrap-back, .'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .thumb-wrap-front, .'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .thumb-wrap-back {min-height: '.$height_block.'px !important; }';
}

// Alignment
if( isset ($v_alignment) ) {
	if ($v_alignment == 'vertical-top') {
		$content_alignment .= 'dfd-rotate-content-top ';
	}
	if ($v_alignment == 'vertical-center') {
		$content_alignment .= 'dfd-rotate-content-v_center ';
	}
	if ($v_alignment == 'vertical-bottom') {
		$content_alignment .= 'dfd-rotate-content-bottom ';
	}
} 
if ( isset ($h_alignment) ) {
	if ($h_alignment == 'horizontal-left') {
		$content_alignment .= 'dfd-rotate-content-left ';
	}
	if ($h_alignment == 'horizontal-center') {
		$content_alignment .= 'dfd-rotate-content-h_center ';
	}
	if($h_alignment == 'horizontal-right') {
		$content_alignment .= 'dfd-rotate-content-right ';
	}
}

if(isset($front_content_vertical_offset) && $front_content_vertical_offset != '') {
	$link_css .= '#'. esc_js($uniqid).' .rotate-box .dfd-rotate-box-item .thumb-wrap .thumb-wrap-front .content-wrap .content-block, .'. esc_js($uniqid).' .rotate-box .dfd-rotate-box-item .thumb-wrap .thumb-wrap-front .content-wrap .content-block {padding-top: '.esc_js($front_content_vertical_offset).'px; padding-bottom: '.esc_js($front_content_vertical_offset).'px;}';
}
if(isset($front_content_horizontal_offset) && $front_content_horizontal_offset != '') {
	$link_css .= '#'. esc_js($uniqid).' .rotate-box .dfd-rotate-box-item .thumb-wrap .thumb-wrap-front .content-wrap .content-block, .'. esc_js($uniqid).' .rotate-box .dfd-rotate-box-item .thumb-wrap .thumb-wrap-front .content-wrap .content-block {padding-left: '.esc_js($front_content_horizontal_offset).'px; padding-right: '.esc_js($front_content_horizontal_offset).'px;}';
}
if(isset($back_content_vertical_offset) && $back_content_vertical_offset != '') {
	$link_css .= '#'. esc_js($uniqid).' .rotate-box .dfd-rotate-box-item .thumb-wrap .thumb-wrap-back .content-wrap, .'. esc_js($uniqid).' .rotate-box .dfd-rotate-box-item .thumb-wrap .thumb-wrap-back .content-wrap {padding-top: '.esc_js($back_content_vertical_offset).'px; padding-bottom: '.esc_js($back_content_vertical_offset).'px;}';
}
if(isset($back_content_horizontal_offset) && $back_content_horizontal_offset != '') {
	$link_css .= '#'. esc_js($uniqid).' .rotate-box .dfd-rotate-box-item .thumb-wrap .thumb-wrap-back .content-wrap, .'. esc_js($uniqid).' .rotate-box .dfd-rotate-box-item .thumb-wrap .thumb-wrap-back .content-wrap {padding-left: '.esc_js($back_content_horizontal_offset).'px; padding-right: '.esc_js($back_content_horizontal_offset).'px;}';
}

$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-rotate-box-wrap '.esc_attr($el_class).'" '.$animation_data.'>';
	$output .= '<div class="dfd-rotate-box-list">';

			// First Side
			if(isset($title_first) && !empty($title_first)) {
				$title_html = '<'.$title_font_options['tag'].' class="title-first '.$title_font_options['class'].'">'.wp_kses( $title_first, array('br' => array()) ).'</'.$title_font_options['tag'].'>';
			}
			if(isset($subtitle_first) && !empty($subtitle_first)){
				$subtitle_html = '<'.$subtitle_font_options['tag'].' class="subtitle-first '.$subtitle_font_options['class'].'">'.wp_kses( $subtitle_first, array('br' => array()) ).'</'.$subtitle_font_options['tag'].'>';
			}

			if(isset($bg_style) && $bg_style == 'image' && isset($icon_image_id) && !empty($icon_image_id)) {
				$image_url = wp_get_attachment_image_src($icon_image_id, 'full');

				if(!$img_src) {
					$img_src = $image_url[0];
				}
				$link_css .= '#'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .thumb-wrap-front, .'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .thumb-wrap-front {background-image: url('.$img_src.'); }';

			} else {
				if (isset($mask_background) && !empty($mask_background)) {
					$link_css .= '#'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .thumb-wrap-front, .'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .thumb-wrap-front {background-color: '.$mask_background.'; }';
				}
			}
			// Reverse Side
			if(isset($desc_reverse) && !empty($desc_reverse)){
				$desc_reverse_html = '<div class="description-reverse">'.wp_kses($desc_reverse, array('br' => array())).'</div>';
			}

			if(isset($bg_style_reverse) && $bg_style_reverse == 'image' && isset($image_id_reverse) && !empty($image_id_reverse)) {
				$image_url_reverse = wp_get_attachment_image_src($image_id_reverse, 'full');

				if(!$img_src_reverse) {
					$img_src_reverse = $image_url_reverse[0];
				}
				$link_css .= '#'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .thumb-wrap-back, .'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .thumb-wrap-back {background-image: url('.$img_src_reverse.'); }';
			} else {
				if (isset($mask_bg_reverse) && !empty($mask_bg_reverse)) {
					$link_css .= '#'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .thumb-wrap-back, .'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .thumb-wrap-back {background-color: '.$mask_bg_reverse.' }';
				}
			}

			if(isset($link_box) && $link_box == 'link_b' && isset($link)) {
				$link = vc_build_link($link);
				$link_target = !empty($link['target']) ? 'target="'.esc_attr(preg_replace('/\s+/', '', $link['target'])).'"' : '';
				$link_html = '<a href="'.esc_url($link['url']).'" class="full-box-link" title="'.esc_attr($link['title']).'" '.$link_target.' rel="'.esc_attr($link['rel']).'"></a>';
			}

			$output .= '<div class="dfd-item-offset rotate-box">';
				$output .= '<div class="dfd-rotate-box-item '.esc_attr($direction_style).'">';
					$output .= '<div class="thumb-wrap">';
							$output .= '<div class="thumb-wrap-front dfd-background-main">';
								$output .= $img_html;
								$output .= '<div class="content-wrap">';
									$output .= '<div class="content-block '. esc_attr($content_alignment) .'">';
										$output .= $title_html;
										$output .= $subtitle_html;
									$output .= '</div>';
								$output .= '</div>';	
							$output .= '</div>';
							$output .= '<div class="thumb-wrap-back dfd-background-main">';
								$output .= $img_reverse_html;
								$output .= '<div class="content-wrap">';
									$output .= $desc_reverse_html;
								$output .= '</div>';
							$output .= '</div>';
					$output .= '</div>';
					$output .= $link_html;	
				$output .= '</div>';
			$output .= '</div>';

			if(isset($block_number) && $block_number = 'yes' && isset($number_text) && !empty($number_text)) {
				if(isset($number_font_size) && $number_font_size != '') {
					$link_css .= '#'. esc_js($uniqid).' .dfd-rotate-box-number, .'. esc_js($uniqid).' .dfd-rotate-box-number {font-size: '.esc_js($number_font_size).'px;}';
					$link_css .= '#'. esc_js($uniqid).'.number-before-content, .'. esc_js($uniqid).'.number-before-content {padding-top: '.(esc_js($number_font_size) / 2).'px;}';
					$link_css .= '#'. esc_js($uniqid).'.number-after-content, .'. esc_js($uniqid).'.number-after-content {padding-bottom: '.(esc_js($number_font_size) / 2).'px;}';
				}
				$number_font_options = _dfd_parse_text_shortcode_params( $number_font_options, '', $number_google_fonts, $number_custom_fonts, true );
				if(isset($number_font_options['style']) && $number_font_options['style'] != '') {
					$link_css .= '#'. esc_js($uniqid).' .dfd-rotate-box-number, .'. esc_js($uniqid).' .dfd-rotate-box-number {'.esc_js($number_font_options['style']).'}';
				}
				$output .= '<div class="dfd-rotate-box-number dfd-content-title-big '.esc_attr($number_alignment).'">'.esc_html($number_text).'</div>';
			}

	$output .= '</div>';

	if(!empty($link_css)) {
		$output .= '<script type="text/javascript">'
					. '(function($) {'
						. '$("head").append("<style>'.$link_css.'</style>");'
					. '})(jQuery);'
				. '</script>';
	}

$output .= '</div>';

echo $output;
