<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if(!class_exists('Dfd_Params_Constructor')) {
	class Dfd_Params_Constructor {
		function __construct() {
			
		}
		function style_select($value, $option, $title) {
			$html = '';
			$value = isset($value) && !empty($value) ? $value : '';
			
			$html .= '			<option value="'.$option.'" '.( $option == $value ? 'selected' : '' ).'>'.$title.'</option>';
			
			return $html;
		}
		function input_number($value, $class, $placeholder) {
			$html = '';
			$name = isset($name) && !empty($name) ? $name : '';
			$value = isset($value) && $value != '' ? $value : '';
			$class = isset($class) && !empty($class) ? $class : '';
			
			$html .= '	<input type="number" class="wpb_vc_param_value crum_number_field vc_container_form_field-'.esc_attr($class).'" placeholder="'.esc_attr($placeholder).'" value="'.$value.'" />';
			
			return $html;
		}
		function input_radio($value, $option, $text, $list = true, $class = '') {
			$html = '';
			$name = isset($name) && !empty($name) ? $name : '';
			$value = isset($value) && $value != '' ? $value : '';
			$class = isset($class) && !empty($class) ? $class : '';
			$checked = $value == $option ? 'checked="checked"' : '';
			
			$html .= '	<label><input type="radio" '.$checked.' value="'.$option.'" />'.esc_html($text).'</label>';
			
			if($list) {
				$li_class = '';
				if($checked != '') {
					$li_class = 'active';
				}
				$html = '<li class="'.esc_attr($li_class).'">'.$html.'</li>';
			}
			
			return $html;
		}
		function input_checkbox($value, $label, $name, $checked, $class = '') {
			$html = '';
			$value = isset($value) && $value != '' ? $value : '';
			$label = isset($label) && $label != '' ? $label : '';
			$checked = isset($checked) && $checked ? 'checked="checked"' : '';
			$class = isset($class) && !empty($class) ? $class : '';
			if($label != '') {
				$html .= '<label class="vc_checkbox-label">';
			}
					$html .= '<input type="checkbox" class="wpb_vc_param_value checkbox '.esc_attr($class).'" name="'.esc_attr($name).'" value="'.$value.'" '.$checked.' />';
			if($label != '') {
					$html .= $label;
				$html .= '</label>';
			}
			
			return $html;
		}
		function color($value) {
			$html = '';
			
			$html .= '  <div class="dfd-param-colorpicker-section">';
			$html .= '		<div class="wpb_element_label">'.esc_html__('Color','dfd-native').'</div>';
			$html .= '		<div class="dfd-colorpicker-block">
								<div class="color-group">
									<input class="vc_container_form_field-color-input dfd-color-picker" data-alpha="true" type="text" value="' . $value . '"/>
									<input name="color" class="wpb_vc_param_value field-color-result" type="hidden" value="' . $value . '"/>
								</div>';
			$html .= '		</div>';
			$html .= '  </div>';
			
			return $html;
		}
	}
	//$Dfd_Params_Constructor = new Dfd_Params_Constructor();
	
	foreach(glob(DFD_EXTENSIONS_PLUGIN_PATH.'vc_custom/params/*.php') as $shortcode) {
		require_once($shortcode);
	}
}