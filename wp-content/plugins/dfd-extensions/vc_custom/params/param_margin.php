<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*

# Usage - 
	array(
		"type" => "dfd_margin_param",
		"positions" => array(
			"Top" => "top",
			"Bottom" => "bottom",
			"Left" => "left",
			"Right" => "right"
		),
	),

*/
if(!class_exists('Dfd_VC_Param_Margin')) {
	class Dfd_VC_Param_Margin {
		function __construct() {
			if(function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('dfd_margin_param', array(&$this, 'dfd_margin_param_param'), DFD_EXTENSIONS_PLUGIN_URL.'vc_custom/admin/js/dfd_additional_param.js');
			}
		}
	
		function dfd_margin_param_param($settings, $value) {
			$positions = isset($settings['positions']) ? $settings['positions'] : array();

			$orig_val = isset($value) && !empty($value) ? $value : '';
			if($orig_val == '' && isset($settings['value'])) {
				$orig_val = $settings['value'];
			}
			$values = Dfd_Theme_Helpers::vc_param_parse_value($orig_val, 'vc_margin_get_params');
			
			$html = '<div class="dfd-margins clearfix" style="margin: 0 -15px;">';
					foreach($positions as $position => $key)
						$html .= $this->input_number($values['margin-'.$position], 'margin-'.$position, $key);
			$html .= '  <input type="text" style="display:none" name="'.$settings['param_name'].'" class="wpb_vc_param_value dfd-delimiter-value '.$settings['param_name'].' '.$settings['type'].'_field" value="'.$orig_val.'" />';
			$html .= '</div>';
			return $html;
		}
		function input_number($value, $class, $placeholder) {
			$html = '';
			$name = isset($name) && !empty($name) ? $name : '';
			$value = isset($value) && !empty($value) ? $value : '';
			$class = isset($class) && !empty($class) ? $class : '';
			
			$html .= '<div class="vc_col-xs-3">'
						. '<div class="wpb_element_label">'.esc_attr($placeholder).'</div>'
						. '<div class="crum-number-field-wrap">'
							. '<input class="wpb_vc_param_value crum_number_field vc_margin_container_form_field-'.esc_attr($class).'" value="'.$value.'" />'
						. '</div>'
					. '</div>';
			
			return $html;
		}
		public static function margins_css($value) {
			if(!$value || empty($value)) return;
			
			$css = '';
			$value = str_replace(";", "|", $value);
			$values = Dfd_Theme_Helpers::vc_param_parse_value($value, 'vc_margin_get_params');
			
			if(isset($values['margin-top']) && $values['margin-top'] != '') {
				$css .= 'margin-top: '.esc_attr($values['margin-top']).'px;';
			}
			if(isset($values['margin-bottom']) && $values['margin-bottom'] != '') {
				$css .= 'margin-bottom: '.esc_attr($values['margin-bottom']).'px;';
			}
			if(isset($values['margin-left']) && $values['margin-left'] != '') {
				$css .= 'margin-left: '.esc_attr($values['margin-left']).'px;';
			}
			if(isset($values['margin-right']) && $values['margin-right'] != '') {
				$css .= 'margin-right: '.esc_attr($values['margin-right']).'px;';
			}
			
			return $css;
		}
	}
}

if(class_exists('Dfd_VC_Param_Margin')) {
	$Dfd_VC_Param_Margin = new Dfd_VC_Param_Margin();
}
