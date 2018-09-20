<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(!class_exists('Dfd_Resposive_Param')) {
	class Dfd_Resposive_Param extends Dfd_Params_Constructor {
		function __construct() {
//			add_action( 'admin_enqueue_scripts', array( $this, 'param_scripts' ) );

			if(function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('dfd_param_responsive_css', array($this, 'responsive_param'), DFD_EXTENSIONS_PLUGIN_URL.'vc_custom/admin/js/dfd_additional_param.js');
			}
		}
		public static function resolutions() {
			return array(
				'desktop', 'tablet', 'mobile'
			);
		}
		function responsive_param($settings, $value) {
			$label = isset($settings['label']) ? $settings['label'] : esc_html__('Responsive options','dfd-native');

			$values = Dfd_Theme_Helpers::vc_param_parse_value($value, 'vc_responsive_get_params');
			
			$html  = '<div class="dfd-responsive-param-container">';

			$resolutions = $this->resolutions();
			
			$i = 0;
			
			foreach($resolutions as $res) {
				$extra_class = '';
				if($i == 0) {
					$extra_class = 'active';
				}
				$html .= '	<div class="dfd-responsive-properties-wrap '.esc_attr($extra_class).'">';
					$html .= '	<h4 class="resolution"><span class="tooltip">'.esc_html($res).'</span></h4>';
					$html .= '	<div class="inner-wrap">';
						$html .= '	<div class="dfd-margin-size">';
						$html .= '		<label>'.esc_html__('Margin','dfd-native').'</label>';
							$elements = array(
								'_top' => '-',
								'_right' => '-',
								'_bottom' => '-',
								'_left' => '-',
							);
							foreach($elements as $k => $v) {
								$html .=		$this->input_number($values['margin'.$k.'_'.$res], 'margin'.$k.'_'.$res, $v);
							}
							$html .= '	<div class="dfd-border-size">';
							$html .= '		<label>'.esc_html__('Border','dfd-native').'</label>';
							foreach($elements as $k => $v) {
								$html .=		$this->input_number($values['border'.$k.'_'.$res], 'border'.$k.'_'.$res, $v);
							}
								$html .= '	<div class="dfd-padding-size">';
								$html .= '		<label>'.esc_html__('Padding','dfd-native').'</label>';
								foreach($elements as $k => $v) {
									$html .=		$this->input_number($values['padding'.$k.'_'.$res], 'padding'.$k.'_'.$res, $v);
								}
								$html .= '	</div>';
							$html .= '	</div>';
						$html .= '	</div>';
					$html .= '	</div>';
				$html .= '	</div>';
				$i++;
			}
			
			$html .= '	<div class="clear"></div>';
			
			$html .= '</div>';
			
			$html .= '<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value  ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" type="hidden" value="' . $value . '" />';
			
			return $html;
		}
		function param_scripts($hook) {
			wp_enqueue_style( 'dfd-responsive-style', DFD_EXTENSIONS_PLUGIN_URL.'vc_custom/admin/css/dfd_responsive.css');
		}
		public static function responsive_css($value, $class = '') {
			if(!$value || empty($value)) return;
			
			$css = '';
			
			$values = Dfd_Theme_Helpers::vc_param_parse_value($value, 'vc_responsive_get_params');
			
			$resolutions = self::resolutions();
			
			$media_string = array(
				'desktop' => '@media (max-width: 1280px) and (min-width: 1024px)',
				'tablet' => '@media (max-width: 1023px) and (min-width: 800px)',
				'mobile' => '@media (max-width: 799px)',
			);
			
			foreach($resolutions as $res) {
				$single_css = '';

				if(isset($values['margin_top_'.$res]) && $values['margin_top_'.$res] != '') {
					$single_css .= 'margin-top: '.esc_attr($values['margin_top_'.$res]).'px !important;';
				}
				if(isset($values['margin_bottom_'.$res]) && $values['margin_bottom_'.$res] != '') {
					$single_css .= 'margin-bottom: '.esc_attr($values['margin_bottom_'.$res]).'px !important;';
				}
				if(isset($values['margin_left_'.$res]) && $values['margin_left_'.$res] != '') {
					$single_css .= 'margin-left: '.esc_attr($values['margin_left_'.$res]).'px !important;';
				}
				if(isset($values['margin_right_'.$res]) && $values['margin_right_'.$res] != '') {
					$single_css .= 'margin-right: '.esc_attr($values['margin_right_'.$res]).'px !important;';
				}

				if(isset($values['border_top_'.$res]) && $values['border_top_'.$res] != '') {
					$single_css .= 'border-top-width: '.esc_attr($values['border_top_'.$res]).'px !important;';
				}
				if(isset($values['border_bottom_'.$res]) && $values['border_bottom_'.$res] != '') {
					$single_css .= 'border-bottom-width: '.esc_attr($values['border_bottom_'.$res]).'px !important;';
				}
				if(isset($values['border_left_'.$res]) && $values['border_left_'.$res] != '') {
					$single_css .= 'border-left-width: '.esc_attr($values['border_left_'.$res]).'px !important;';
				}
				if(isset($values['border_right_'.$res]) && $values['border_right_'.$res] != '') {
					$single_css .= 'border-right-width: '.esc_attr($values['border_right_'.$res]).'px !important;';
				}

				if(isset($values['padding_top_'.$res]) && $values['padding_top_'.$res] != '') {
					$single_css .= 'padding-top: '.esc_attr($values['padding_top_'.$res]).'px !important;';
				}
				if(isset($values['padding_bottom_'.$res]) && $values['padding_bottom_'.$res] != '') {
					$single_css .= 'padding-bottom: '.esc_attr($values['padding_bottom_'.$res]).'px !important;';
				}
				if(isset($values['padding_left_'.$res]) && $values['padding_left_'.$res] != '') {
					$single_css .= 'padding-left: '.esc_attr($values['padding_left_'.$res]).'px !important;';
				}
				if(isset($values['padding_right_'.$res]) && $values['padding_right_'.$res] != '') {
					$single_css .= 'padding-right: '.esc_attr($values['padding_right_'.$res]).'px !important;';
				}
				
				if($single_css != '') {
					$css .= $media_string[$res].'{'.$class.'{'.$single_css.'}}';
				}
			}
			
			return $css;
		}
	}
}
if(class_exists('Dfd_Resposive_Param')) {
	$Dfd_Resposive_Param = new Dfd_Resposive_Param();
}