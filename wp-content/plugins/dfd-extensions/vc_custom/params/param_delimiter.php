<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if(!class_exists('Dfd_Delimiter')) {
	class Dfd_Delimiter extends Dfd_Border_Param {
		function __construct() {
			
			add_action('admin_enqueue_scripts', array($this, 'dfd_delimiter_param_scripts'));

			if(function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('dfd_delimiter', array($this, 'dfd_delimiter_param'), DFD_EXTENSIONS_PLUGIN_URL.'vc_custom/admin/js/dfd_additional_param.js');
			}
		}
		function delimiter_styles() {
			return array(
				'none' => esc_html__('None','dfd-native'),
				'solid' => esc_html__('Solid','dfd-native'),
				'dotted' => esc_html__('Dotted','dfd-native'),
				'dashed' => esc_html__('Dashed','dfd-native'),
			);
		}
		function dfd_delimiter_param($settings, $value) {
			$label = isset($settings['label']) ? $settings['label'] : esc_html__('Delimiter style','dfd-native');
			$simple = isset($settings['simple']) && $settings['simple'] ? '' : 'expandable';
			$unit = isset($settings['unit']) ? $settings['unit'] : 'px';
			$enable_radius = isset($settings['enable_radius']) ? $settings['enable_radius'] : true ;

			$values = Dfd_Theme_Helpers::vc_param_parse_value($value, 'vc_delimiter_get_params');
			
			$styles = self::delimiter_styles();
			
			$html  = '<div class="dfd-delimiter-param-container">';

			$html .= '	<div class="dfd-delimiter-style">';
			$html .= '		<div class="delimiter-select-block">';
			$html .= '			<div class="wpb_element_label">'.esc_html__('Delimiter style','dfd-native').'</div>';
			$html .= '			<select class="vc_container_form_field-delimiter_style wpb_vc_param_value">';
			foreach($styles as $k => $v) {
				$html .=				$this->style_select($values['delimiter_style'], $k, $v);
			}
			$html .= '			</select>';
			$html .= '		</div>';
			$html .= '	</div>';
			
			$delimiters = array(
				'delimiter_width' => esc_html__('Width','dfd-native'),
				'delimiter_height' => esc_html__('Height','dfd-native'),
			);
			
			$html .= '	<div class="dfd-delimiter-width '.esc_attr($simple).'">';
			$html .= '		<div class="wpb_element_label">'.esc_html__('Delimiter height/width','dfd-native').'</div>';
			$html .= '		<div class="delimiter-size-block">';
			foreach($delimiters as $k => $v) {
				$html .=		'<div class="input-wrap crum-number-field-wrap">'.$this->input_number($values[$k], $k, $v).'</div>';
			}
			$html .= '		</div>';
			$html .= '	</div>';
			
			$html .= $this->color($values['delimiter_color']);
			
			$html .= '</div>';
			
			$html .= '<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value  ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" type="hidden" value="' . $value . '" />';
			
			return $html;
		}
		
		public static function get_only_style_css($value) {
			return Dfd_Theme_Helpers::vc_param_parse_value($value, 'vc_delimiter_get_params');
		}
		function dfd_delimiter_param_scripts($hook) {
			wp_enqueue_style( 'wp-color-picker' );
//			wp_enqueue_style( 'dfd-delimiter-style', DFD_EXTENSIONS_PLUGIN_URL.'vc_custom/admin/css/dfd-delimiter.css');
		}
		public static function delimiter_css($value) {
			if(!$value || empty($value)) return;
			
			$css = '';
			
			$values = Dfd_Theme_Helpers::vc_param_parse_value($value, 'vc_delimiter_get_params');
			
			if(isset($values['delimiter_style']) && $values['delimiter_style'] != '') {
				$css .= 'border-bottom-style: '.esc_attr($values['delimiter_style']).';';
				if(isset($values['delimiter_width']) && $values['delimiter_width'] != '') {
					$css .= 'width: '.esc_attr($values['delimiter_width']).'px;';
				}
				if(isset($values['delimiter_height']) && $values['delimiter_height'] != '') {
					$css .= 'border-bottom-width: '.esc_attr($values['delimiter_height']).'px;';
				}
				if(isset($values['delimiter_color']) && $values['delimiter_color'] != '') {
					$css .= 'border-bottom-color: '.esc_attr($values['delimiter_color']).';';
				}
			}
			
			return $css;
		}
	}
}
if(class_exists('Dfd_Delimiter')) {
	$Dfd_Delimiter = new Dfd_Delimiter();
}