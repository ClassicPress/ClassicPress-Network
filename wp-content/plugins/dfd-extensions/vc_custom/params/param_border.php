<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(!class_exists('Dfd_Border_Param')) {
	class Dfd_Border_Param extends Dfd_Params_Constructor {
		function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'param_scripts' ) );

			if(function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('dfd_param_border', array($this, 'border_param'), DFD_EXTENSIONS_PLUGIN_URL.'vc_custom/admin/js/dfd_additional_param.js');
			}
		}
		function border_styles() {
			return array(
				'none' => esc_html__('None','dfd-native'),
				'solid' => esc_html__('Solid','dfd-native'),
				'dotted' => esc_html__('Dotted','dfd-native'),
				'dashed' => esc_html__('Dashed','dfd-native'),
				'default' => esc_html__('Theme default','dfd-native'),
			);
		}
		function border_param($settings, $value) {
			$label = isset($settings['label']) ? $settings['label'] : esc_html__('Border style','dfd-native');
			$simple = isset($settings['simple']) && $settings['simple'] ? '' : 'expandable';
			$unit = isset($settings['unit']) ? $settings['unit'] : 'px';
			$enable_radius = isset($settings['enable_radius']) ? $settings['enable_radius'] : true ;

			$values = Dfd_Theme_Helpers::vc_param_parse_value($value, 'vc_border_get_params');
			
			$styles = self::border_styles();
			
			$html  = '<div class="dfd-border-param-container">';

			$html .= '	<div class="dfd-border-style">';
			$html .= '		<div class="border-select-block">';
			$html .= '			<div class="wpb_element_label">'.esc_html__('Border style','dfd-native').'</div>';
			$html .= '			<select class="vc_container_form_field-border_style wpb_vc_param_value">';
			foreach($styles as $k => $v) {
				$html .=				$this->style_select($values['border_style'], $k, $v);
			}
			$html .= '			</select>';
			$html .= '		</div>';
			$html .= '	</div>';
			
			$html .= $this->color($values['border_color']);
			
			if($enable_radius) {
				$html .= '	<div class="dfd-border-radius">';
				$html .= '		<div class="border-radius-block">';
				$html .= '			<div class="wpb_element_label">'.esc_html__('Border radius','dfd-native').'</div>';
				$html .=			'<div class="crum-number-field-wrap">'.$this->input_number($values['border_radius'], 'border_radius', '').'</div>';
				$html .= '		</div>';
				$html .= '	</div>';
			}
			
			$html .= '	<div class="dfd-border-width '.esc_attr($simple).'">';
			$html .= '		<div class="wpb_element_label">'.esc_html__('Border width','dfd-native').'</div>';
			$html .= '		<div class="border-width-block">';
			$html .= '			<a href="#" class="dfd-border-expand" title="expand"></a>';
			$borders = array(
				'border_width' => esc_html__('All','dfd-native'),
				'border_top_width' => esc_html__('Top','dfd-native'),
				'border_bottom_width' => esc_html__('Bottom','dfd-native'),
				'border_left_width' => esc_html__('Left','dfd-native'),
				'border_right_width' => esc_html__('Right','dfd-native'),
			);
			foreach($borders as $k => $v) {
				$html .=		$this->input_number($values[$k], $k, $v);
			}
			$html .= '		</div>';
			$html .= '	</div>';
			
			$html .= '</div>';
			
			$html .= '<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value  ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" type="hidden" value="' . $value . '" />';
			
			return $html;
		}
		function param_scripts($hook) {
			wp_enqueue_style( 'wp-color-picker' );
//			wp_enqueue_style( 'dfd-border-style', DFD_EXTENSIONS_PLUGIN_URL.'vc_custom/admin/css/dfd_border.css');
		}
		public static function border_css($value) {
			if(!$value || empty($value)) return;
			
			$css = '';
			
			$values = Dfd_Theme_Helpers::vc_param_parse_value($value, 'vc_border_get_params');
			
			if(isset($values['border_style']) && $values['border_style'] != '' && $values['border_style'] != 'default') {
				$css .= 'border-style: '.esc_attr($values['border_style']).';';
				if(isset($values['border_width']) && $values['border_width'] != '') {
					$css .= 'border-width: '.esc_attr($values['border_width']).'px;';
				} else {
					if(isset($values['border_top_width']) && $values['border_top_width'] != '') {
						$css .= 'border-top-width: '.esc_attr($values['border_top_width']).'px;';
					}
					if(isset($values['border_bottom_width']) && $values['border_bottom_width'] != '') {
						$css .= 'border-bottom-width: '.esc_attr($values['border_bottom_width']).'px;';
					}
					if(isset($values['border_left_width']) && $values['border_left_width'] != '') {
						$css .= 'border-left-width: '.esc_attr($values['border_left_width']).'px;';
					}
					if(isset($values['border_right_width']) && $values['border_right_width'] != '') {
						$css .= 'border-right-width: '.esc_attr($values['border_right_width']).'px;';
					}
				}
				if(isset($values['border_color']) && $values['border_color'] != '') {
					$css .= 'border-color: '.esc_attr($values['border_color']).';';
				}
				if(isset($values['border_radius']) && $values['border_radius'] != '') {
					$css .= 'border-radius: '.esc_attr($values['border_radius']).'px;';
				}
			}
			
			return $css;
		}
	}
}
if(class_exists('Dfd_Border_Param')) {
	$Dfd_Border_Param = new Dfd_Border_Param();
}