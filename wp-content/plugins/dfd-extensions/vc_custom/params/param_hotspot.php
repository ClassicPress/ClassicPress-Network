<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if(!class_exists('Dfd_Vc_Param_Hotspot')) {
	class Dfd_Vc_Param_Hotspot {
		function __construct() {
			if(function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('dfd_hotspot_param', array(&$this, 'dfd_hotspot_param'), DFD_EXTENSIONS_PLUGIN_URL.'vc_custom/admin/js/dfd_additional_param.js');
				add_action('admin_enqueue_scripts', array($this, 'load_assets'));
			}
		}
	
		function dfd_hotspot_param($settings, $value) {
			$value = isset($value) && !empty($value) ? $value : '';
			
			$id = uniqid('dfd_hotspot_ls_var-');
			
			$html = '<div class="dfd-hotspot-param-wrapper clearfix">';
				$html .= '<div class="dfd-hotspot-image-holder" data-popup-title="'.esc_attr__('Hotspot tooltip content', 'dfd-native').'" data-save-text="'.esc_attr__('Save changes', 'dfd-native').'" data-close-text="'.esc_attr__('Close','dfd-native').'"></div>';
				$html .= '<input type="hidden" id="'.esc_attr($id).'" name="'.$settings['param_name'].'" class="wpb_vc_param_value dfd_hotspot_ls_var '.$settings['param_name'].' '.$settings['type'].'_field" value=\''.$value.'\' />';
			$html .= '</div>';
			return $html;
		}
		
		function load_assets() {
			wp_enqueue_script('dfd_hotspot_param_js', DFD_EXTENSIONS_PLUGIN_URL.'vc_custom/admin/js/jquery.hotspot.js', array('jquery'), null, true);
		}
	}
}

if(class_exists('Dfd_Vc_Param_Hotspot')) {
	$Dfd_Vc_Param_Hotspot = new Dfd_Vc_Param_Hotspot();
}
