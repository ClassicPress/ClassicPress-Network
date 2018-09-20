<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if(!class_exists('Dfd_Date_Time_Picker_Param')) {
	class Dfd_Date_Time_Picker_Param {
		function __construct() {
//			add_action('admin_enqueue_scripts', array($this, 'load_assets'));
			if(function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('dfd_datetimepicker' , array($this, 'datetimepicker'), DFD_EXTENSIONS_PLUGIN_URL.'vc_custom/admin/js/bootstrap-datetimepicker.min.js');
			}
		}
		function datetimepicker($settings, $value) {
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$output = '<div class="dfd-datetime"><input data-format="dd/MM/yyyy hh:mm:ss" readonly class="wpb_vc_param_value ' . esc_attr($param_name) . ' ' . esc_attr($type) . ' ' . esc_attr($class) . '" name="' . $param_name . '" style="width:258px;" value="'.$value.'" /><span class="add-on"><span class="dashicons dashicons-calendar-alt"></span></span></div>';
			
			return $output;
		}
		function load_assets() {
//			wp_enqueue_style('dfd_date_time_picket_styles', DFD_EXTENSIONS_PLUGIN_URL.'vc_custom/admin/css/dfd-date-time-picker.css');
		}
	}
}

if(class_exists('Dfd_Date_Time_Picker_Param')) {
	$Dfd_Date_Time_Picker_Param = new Dfd_Date_Time_Picker_Param();
}
