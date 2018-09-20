<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(!class_exists('Dfd_Radio_Post_Select')) {
	class Dfd_Radio_Post_Select {
		function __construct() {	
			if(function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('radio_image_post_select' , array(&$this, 'radio_image_post_select' ) );
			}
		}
	
		function radio_image_post_select($settings, $value) {
			$default_css = array(
				'width' => '25px',
				'height' => '25px',
				'background-repeat' => 'repeat',
				'background-size' => 'cover'
			);
			
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$post_type = isset($settings['post_type']) ? $settings['post_type'] : 'post';
			$options = $this->dfd_custom_taxonomy_item_select($post_type);
			$css = isset($settings['css']) ? $settings['css'] : $default_css;
			$class = isset($settings['class']) ? $settings['class'] : '';
			$useextension = (isset($settings['useextension']) && $settings['useextension'] != '' ) ? $settings['useextension'] : 'true';
			$default = isset($settings['default']) ? $settings['default'] : 'transperant';
			
			$uni = uniqid();
			
			$output = '';
			$output = '<input id="radio_image_setting_val_'.esc_attr($uni).'" class="wpb_vc_param_value ' . esc_attr($param_name) . ' ' . esc_attr($type) . ' ' . esc_attr($class) . ' '.esc_attr($value).'" name="' . $param_name . '"  style="display:none"  value="'.$value.'" />';
			$output .= '<div class="dfd-radio-image-box" data-uniqid="'.$uni.'">';
				if($value == 'transperant')
					$checked = 'checked';
				else
					$checked = '';
				$output .= '<label>
					<input type="radio" name="radio_image_'.esc_attr($uni).'" '.$checked.' class="radio_pattern_image" value="'.$default.'" />
					<span class="pattern-background no-bg" style="background:transparent;"></span>
				</label>';
				foreach($options as $key => $val) {
					if($value == $key)
						$checked = 'checked';
					else
						$checked = '';
					if($useextension != 'true') {
						$temp = pathinfo($key);
						$temp_filename = $temp['filename'];
						$key = $temp_filename;
					}
					$output .= '<label>
						<input type="radio" name="radio_image_'.esc_attr($uni).'" '.$checked.' class="radio_pattern_image" value="'.$key.'" />
						<span class="pattern-background" style="background: url('.esc_url($val['img']).')"></span>
						<span class="image-picker-tooltip">'.esc_html($val['title']).'</span>
					</label>';
				}
			$output .= '</div>';
			$output .= '<style>'
				. '.dfd-radio-image-box label {'
					. 'position: relative;'
				. '}'
				. '.dfd-radio-image-box label .pattern-background {'
					. 'position: relative;'
					. 'background-size: cover !important;'
				. '}'
				.'.dfd-radio-image-box label > input{ /* HIDE RADIO */'
					. 'display: none;'
				. '}'
				. '.dfd-radio-image-box label > input + img{ /* IMAGE STYLES */'
					. 'cursor:pointer;'
				  	. 'border: 2px solid #e6e6e6;'
				. '}'
				. '.dfd-radio-image-box label:hover > input + img, .dfd-radio-image-box label:hover > input + .pattern-background { /* IMAGE STYLES */'
				  	. 'border-color: #586065;'
				.'}'
				. '.dfd-radio-image-box .no-bg {'
					. 'border: 2px solid #e6e6e6;'
				. '}'
				. '.dfd-radio-image-box label > input:checked + img, .dfd-radio-image-box label > input:checked + .pattern-background { /* (CHECKED) IMAGE STYLES */'
				  	. 'border: 2px solid #52d298;'
				. '}'
				. '.pattern-background {';
					foreach($css as $attr => $inine_style) {
						$output .= $attr.':'.$inine_style.';';
					}
					$output .= 'display: inline-block;
					border: 2px solid #e6e6e6;
				}
			</style>';
			$output .= '<script type="text/javascript">
				jQuery(".radio_pattern_image").change(function(){
					var radio_id = jQuery(this).parent().parent().data("uniqid");
					var val = jQuery(this).val();
					jQuery("#radio_image_setting_val_"+radio_id).attr("value",val);
				});
			</script>';
			return $output;
		}
		
		function dfd_custom_taxonomy_item_select($what) {
			$args = array(
				'post_status' => 'publish',
				'post_type' => $what,
				'posts_per_page' => -1,
			);
			$query = new WP_Query($args);
			$items = array();
			if(!empty($query)) {
				foreach($query->posts as $post) {
					if (has_post_thumbnail($post->ID)) {
						$thumb_id = get_post_thumbnail_id($post->ID);
						$img_url = wp_get_attachment_url($thumb_id);
						$img = dfd_aq_resize($img_url, 120, 120, true, true, true);
						if(!$img) {
							$img = $img_url;
						}
					} else {
						$img = Dfd_Theme_Helpers::default_noimage_url('rect_small_140');
					}
					$title = get_the_title($post->ID);
					$items[$post->ID] = array(
							'img' => $img,
							'title' => $title,
						);
				}
			}
			wp_reset_postdata();

			return $items;
		}
	}
	
	$Dfd_Radio_Post_Select = new Dfd_Radio_Post_Select();
}