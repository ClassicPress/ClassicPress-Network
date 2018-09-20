<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(!class_exists('Dfd_Number_Param')) {
	class Dfd_Number_Param {
		function __construct() {
			if(function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('number' , array(&$this, 'number_settings_field' ));
			}
		}
	
		function number_settings_field($settings, $value){
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$min = isset($settings['min']) ? $settings['min'] : '';
			$max = isset($settings['max']) ? $settings['max'] : '';
			$step = isset($settings['step']) ? $settings['step'] : '';
			$suffix = isset($settings['suffix']) ? $settings['suffix'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$output = '<input type="number" min="'.esc_attr($min).'" max="'.esc_attr($max).'" step="'.esc_attr($step).'" class="wpb_vc_param_value ' . esc_attr($param_name . ' ' . $type . ' ' . $class) . '" name="' . esc_attr($param_name) . '" value="'.$value.'" style="max-width:200px; margin-right: 10px;" />'.strip_tags($suffix,'<i><span>');
			return $output;
		}
		
	}
	
	$Dfd_Number_Param = new Dfd_Number_Param();
}
