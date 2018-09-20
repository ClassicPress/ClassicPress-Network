<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(!class_exists('Dfd_Taxonomy_Multicheck_Param')) {
	class Dfd_Taxonomy_Multicheck_Param extends Dfd_Params_Constructor {
		function __construct() {	
			if(function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('dfd_taxonomy_multicheck' , array(&$this, 'dfd_taxonomy_multicheck' ) );
			}
		}
	
		function dfd_taxonomy_multicheck($settings, $value = '') {
			if ( is_array( $value ) ) {
				$value = '';
			}
			$current_value = strlen( $value ) > 0 ? explode( ',', $value ) : array();
			$label = isset($settings['label']) ? $settings['label'] : esc_html__('Categories','dfd-native');
			$taxonomy = isset($settings['taxonomy']) && $settings['taxonomy'] != '' ? $settings['taxonomy'] : 'category';
			$name = isset($settings['param_name']) ? $settings['param_name'] : $taxonomy;
			
			$html = $checked = '';
			
			$args = array(
				'taxonomy' => $taxonomy,
				'type' => 'post',
				'hide_empty' => 0,
			);

			$categories = get_categories($args);

			if(!empty($categories) && is_array($categories)) {
				$html .= '<div class="dfd-taxonomy-multicheck">';
				foreach( $categories as $category ) {
					if(is_object($category)) {
						$checked = count( $current_value ) > 0 && in_array( $category->slug, $current_value ) ? true : false;
						$html .= $this->input_checkbox($category->slug, $category->name, $name, $checked);
					}
				}
				$html .= '<script type="text/javascript">'
							. '(function($) {'
								. 'vc.atts.dfd_taxonomy_multicheck = vc.atts.checkbox;'
							. '})(jQuery)'
						. '</script>';
				$html .= '</div>';
			}
			
			return $html;
		}
	}
	
	$Dfd_Taxonomy_Multicheck_Param = new Dfd_Taxonomy_Multicheck_Param();
}