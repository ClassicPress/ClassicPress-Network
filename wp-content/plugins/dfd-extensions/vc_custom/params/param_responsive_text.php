<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(!class_exists('Dfd_Resposive_Text_Param')) {
	class Dfd_Resposive_Text_Param extends Dfd_Params_Constructor {
		function __construct() {
//			add_action( 'admin_enqueue_scripts', array( $this, 'param_scripts' ) );

			if(function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('dfd_param_responsive_text', array($this, 'responsive_text_param'), DFD_EXTENSIONS_PLUGIN_URL.'vc_custom/admin/js/dfd_additional_param.js');
			}
		}
		public static function resolutions() {
			return array(
				'desktop' => esc_html__('Screen resolutions from 1280px to 1025px','dfd-native'),
				'tablet' => esc_html__('Screen resolutions from 1024px to 800px','dfd-native'),
				'mobile' => esc_html__('Screen resolutions less than 800px','dfd-native')
			);
		}
		function responsive_text_param($settings, $value) {
			$values = Dfd_Theme_Helpers::vc_param_parse_value($value, 'vc_responsive_text_get_params');
			
			$html  = '<div class="dfd-responsive-text-param-container">';

			$resolutions = $this->resolutions();
			
			foreach($resolutions as $res => $title) {
				$wrap_class = '';
				if(substr_count($value, $res) > 0) {
					$wrap_class = 'expanded';
				}
				$html .= '	<div class="inner-wrap '.esc_attr($wrap_class).'">';
					$html .= '	<div class="item">';
						$html .= '	<div class="wpb_element_label">'
										. '<span class="dfd-vc-toolip">'
											. '<i class="dfd-socicon-question-sign"></i>'
											. '<span class="dfd-vc-tooltip-text">'.esc_html($title).'</span>'
										. '</span>'
										. esc_html($res)
									.'</div>';
						$html .= '	<a href="#" class="dfd-resolution-section-expand" title="'.esc_attr__('Expand / Collapse','dfd-native').'"><span class="button-animation"></span></a>';
					$html .= '	</div>';
					$elements = array(
						'font_size',
						'line_height',
						'letter_spacing',
					);
					foreach($elements as $k) {
						$label = str_replace($res, '', $k);
						$label = str_replace('_', ' ', $label);
						$html .= '<div class="item input-cover">'
									. '<div class="wpb_element_label">'.esc_html($label).'</div>'
									. '<div class="crum-number-field-wrap">'.$this->input_number($values[$k.'_'.$res], $k.'_'.$res, '').'</div>'
								. '</div>';
					}
				$html .= '	</div>';
			}
			
			$html .= '	<div class="clear"></div>';
			
			$html .= '</div>';
			
			$html .= '<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value  ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" type="hidden" value="' . $value . '" />';
			
			return $html;
		}
		public static function responsive_css($value, $class = '') {
			if(!$value || empty($value)) return;
			
			$css = '';
			
			$values = Dfd_Theme_Helpers::vc_param_parse_value($value, 'vc_responsive_text_get_params');
			
			$resolutions = self::resolutions();
			
			$media_string = array(
				'desktop' => '@media (max-width: 1280px) and (min-width: 1024px)',
				'tablet' => '@media (max-width: 1023px) and (min-width: 800px)',
				'mobile' => '@media (max-width: 799px)',
			);
			
			foreach($resolutions as $res => $title) {
				$single_css = '';
				if(isset($values['font_size_'.$res]) && $values['font_size_'.$res] != '') {
					$single_css .= 'font-size: '.esc_attr($values['font_size_'.$res]).'px !important;';
				}
				if(isset($values['letter_spacing_'.$res]) && $values['letter_spacing_'.$res] != '') {
					$single_css .= 'letter-spacing: '.esc_attr($values['letter_spacing_'.$res]).'px !important;';
				}
				if(isset($values['line_height_'.$res]) && $values['line_height_'.$res] != '') {
					$single_css .= 'line-height: '.esc_attr($values['line_height_'.$res]).'px !important;';
				}
				
				if($single_css != '') {
					$css .= $media_string[$res].'{'.$class.'{'.$single_css.'}}';
				}
			}
			
			return $css;
		}
	}
}
if(class_exists('Dfd_Resposive_Text_Param')) {
	$Dfd_Resposive_Text_Param = new Dfd_Resposive_Text_Param();
}