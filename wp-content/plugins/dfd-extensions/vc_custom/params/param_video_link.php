<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if(!class_exists('Dfd_Video_Link_Param')) {
	class Dfd_Video_Link_Param {
		function __construct() {
			if(function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('dfd_video_link_param' , array($this, 'dfd_video_link_param_callback'));
			}
		}
	
		function dfd_video_link_param_callback($settings, $value) {
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$doc_link = isset($settings['doc_link']) ? $settings['doc_link'] : '';
			$video_link = isset($settings['video_link']) ? $settings['video_link'] : '';
			
			$output = '<div class="dfd-tutorials-param-wrapper">';
			
			if($doc_link != '') {
				$output .= '<div class="dfd-documentation-link"><a href="'.esc_html($doc_link).'">'.esc_html__('Theme documentation','dfd-native').'</a></div>';
			}
			
			if($video_link != '') {
				$output .= '<div class="dfd-video-tutorial-link"><a href="'.esc_html($video_link).'">'.esc_html__('Video tutorial','dfd-native').'</a></div>';
			}
			
			$output .= '</div>';

//			$output .= '<input type="hidden"  class="wpb_vc_param_value ' . esc_attr($param_name . ' ' . $type . ' ' . $class) . '" name="' . esc_attr($param_name) . '" value="'.$value.'" />';
			return $output;
		}
		
	}
	
	$Dfd_Video_Link_Param = new Dfd_Video_Link_Param();
}
