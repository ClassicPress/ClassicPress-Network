<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if(!class_exists('Dfd_Gradient_Param')) {
	class Dfd_Gradient_Param extends Dfd_Params_Constructor {
		function __construct() {
			add_action('admin_enqueue_scripts', array($this, 'load_assets'));
			if(function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('dfd_gradient' , array(&$this, 'gradient_param' ), DFD_EXTENSIONS_PLUGIN_URL.'vc_custom/admin/js/dfd_additional_param.js' );
			}
		}
		function get_dropdown_options() {
			return array(
				'left' => esc_html__('Horizontal','dfd-native'),
				'top' => esc_html__('Vertical','dfd-native'),
				'custom' => esc_html__('Custom','dfd-native'),
			);
		}
		function gradient_param($settings, $value) {
			$html = '';
			
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			
			$values = Dfd_Theme_Helpers::vc_param_parse_value($value, 'vc_gradient_get_params');
			
			$html .= '<div class="dfd-gradient-param-container">';
			
			$styles = self::get_dropdown_options();
			
			$html .= '	<div class="dfd-gradient-direction">';
			$html .= '		<div class="dir-select-block">';
			$html .= '			<div class="wpb_element_label">'.esc_html__('Gradient type','dfd-native').'</div>';
			$html .= '			<select class="vc_container_form_field-gradient_style wpb_vc_param_value">';
			foreach($styles as $k => $v) {
				$html .=				$this->style_select($values['gradient_style'], $k, $v);
			}
			$html .= '			</select>';
			$html .= '		</div>';
			$html .= '	</div>';
			
//			$html .= '	<div class="dfd-gradient-dir-custom '.esc_attr($simple).'">';
			$html .= '	<div class="dfd-gradient-dir-custom">';
			$html .= '		<div class="wpb_element_label">'.esc_html__('Direction','dfd-native').'</div>';
			$html .= '		<div class="direction-custom">';
			
			$html .=		$this->input_number($values['gradient_custom_direction'], 'direction_custom', esc_html__('Custom direction in DEG.','dfd-native'));
			
			$html .= '		</div>';
			$html .= '	</div>';
			
			$html .= '<div class="dfd-gradient-controls"></div>';
			$html .= '<div class="dfd-gradient-demo">';
			$html .= '	<input type="hidden" class="wpb_vc_param_value crum_number_field vc_container_form_field-gradient_css" value="'.$values['gradient_css'].'" />';
			$html .= '	<input type="hidden" class="wpb_vc_param_value crum_number_field vc_container_form_field-gradient_value" value="'.$values['gradient_value'].'" />';
			$html .= '</div>';
			
			$html .= '</div>';
			
			
			$html .= '<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value  ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" type="hidden" value="' . $value . '" />';
			
			return $html;
		}
		public static function gradient_css($value) {
			if(!$value || empty($value)) return;
			
			$css = '';
			
			$values = Dfd_Theme_Helpers::vc_param_parse_value($value, 'vc_gradient_get_params');
			
			if(isset($values['gradient_css']) && $values['gradient_css'] != '') {
				$css .= esc_attr(str_replace('\n','',esc_js($values['gradient_css']))).';';
			}
			
			return $css;
		}
		function load_assets() {
//			wp_enqueue_style( 'dfd-gradient-styles', DFD_EXTENSIONS_PLUGIN_URL.'vc_custom/admin/css/dfd-gradient.css');
			wp_enqueue_script('jquery.classygradient',DFD_EXTENSIONS_PLUGIN_URL.'vc_custom/admin/js/jquery.classygradient.min.js');
		}
	}
}

if(class_exists('Dfd_Gradient_Param')) {
	$Dfd_Gradient_Param = new Dfd_Gradient_Param();
}