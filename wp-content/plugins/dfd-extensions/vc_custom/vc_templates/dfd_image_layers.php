<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output = $uniqid = $link_css = $el_class = $list_fields = $anim_class = $padding = $padding_css = $periodicity = $alignment = '';
$animation_data = '';

$atts = vc_map_get_attributes( 'dfd_image_layers', $atts );
extract( $atts );

$uniqid = uniqid('dfd-image-layers-').'-'.rand(1,9999);

if(isset($alignment)) {
	$el_class .= ' '.$alignment;
}

$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-image-layers-wrap '.esc_attr($el_class).'">';

	$max_val_x = $max_val_y = $nth_child = 0;
	$translate = -100; $translate_step = 100;
	$nth_child_step = 1;
	$animate_delay = - $periodicity;
	
	if(isset($list_fields) && !empty($list_fields) && function_exists('vc_param_group_parse_atts')) {
		$list_fields = (array) vc_param_group_parse_atts($list_fields);
		
		foreach($list_fields as $fields) {
			
			$image = $offset_x_css = $offset_y_css = '';
			
			if(isset($fields['image_id']) && !empty($fields['image_id'])) {
				if(isset($fields['layer_animation']) && !empty($fields['layer_animation'])) {
					$anim_class = esc_attr($fields['layer_animation']);
				}
				
				$animate_delay = $animate_delay + $periodicity;
				$nth_child = $nth_child_step++;
				$translate = $translate + $translate_step;
			
				$link_css .= '#'.esc_js($uniqid).' .dfd-layer-container:nth-child('.$nth_child.') .dfd-layer-item {-webkit-transition-delay: '.$animate_delay.'s; -moz-transition-delay: '.$animate_delay.'s; -o-transition-delay: '.$animate_delay.'s; transition-delay: '.$animate_delay.'s;}';

				if(!isset($fields['offcet_x'])) {
					$fields['offcet_x'] = 0;
				}
				if(!isset($fields['offcet_y'])) {
					$fields['offcet_y'] = 0;
				}
				if($fields['offcet_x'] >= 100) {
					$fields['offcet_x'] = 100;
				}
				if($fields['offcet_x'] <= -100) {
					$fields['offcet_x'] = -100;
				}
				if($fields['offcet_y'] >= 100) {
					$fields['offcet_y'] = 100;
				}
				if($fields['offcet_y'] <= -100) {
					$fields['offcet_y'] = -100;
				}
				
				if( (isset($fields['offcet_x']) && strcmp($fields['offcet_x'], '') != 0) || (isset($fields['offcet_y']) && strcmp($fields['offcet_y'], '') != 0) ) {
					$offset_x_css = '-webkit-transform: translate('.esc_attr($fields['offcet_x']).'%, '.esc_attr($fields['offcet_y']).'%); -moz-transform: translate('.esc_attr($fields['offcet_x']).'%, '.esc_attr($fields['offcet_y']).'%); -o-transform: translate('.esc_attr($fields['offcet_x']).'%, '.esc_attr($fields['offcet_y']).'%); transform: translate('.esc_attr($fields['offcet_x']).'%, '.esc_attr($fields['offcet_y']).'%);';
				}
				
				$image = wp_get_attachment_image_src($fields['image_id'], 'full');
				
				$img_atts = Dfd_Theme_Helpers::get_image_attrs($image[0], $fields['image_id'], $image[1], $image[2], esc_attr__('Layer','dfd-native'));
				
				$output .= '<div class="dfd-layer-container '.esc_attr($anim_class).'">';
					$output .= '<div class="dfd-layer-centered" style="'.$offset_x_css.' '.$offset_y_css.'">';
						$output .= '<div class="dfd-layer-item">';
							$output .= '<img src="'.esc_url($image[0]).'" '.$img_atts.' />';
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';
			}
		}
		
		if(!empty($link_css)) {
			$output .= '<script type="text/javascript">'
						. '(function($) {'
							. '$("head").append("<style>'.$link_css.'</style>");'
						. '})(jQuery);'
					. '</script>';
		}
	}
	
$output .= '</div>';

echo $output;