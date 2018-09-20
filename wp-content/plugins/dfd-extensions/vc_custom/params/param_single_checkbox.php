<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if(!class_exists('Dfd_Single_Checkbox_Param')) {
	
	class Dfd_Single_Checkbox_Param {
		
		function __construct() {	
			if(function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('dfd_single_checkbox' , array($this, 'dfd_single_checkbox'));
			}
		}
	
		function dfd_single_checkbox($settings, $value) {
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$options = isset($settings['options']) ? $settings['options'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			
			$output = $checked = '';
			
			if(is_array($options) && !empty($options)){
				foreach($options as $key => $opts){
					$checked = "";
					$animation_class = 'right-active';
					$data_val = $key;
					if($value == $key){
						$checked = "checked";
						$animation_class = '';
					}
					
					$uniq_id = uniqid('dfd_single_checkbox-'.rand());
					if(isset($opts['label']))
						$label = $opts['label'];
					else
						$label = '';
					
					$output .= '<div class="dfd_single_checkbox_wrap">
									<input type="checkbox" name="'.esc_attr($param_name).'" value="'.esc_attr($value).'" class="wpb_vc_param_value ' . esc_attr($param_name) . ' ' . esc_attr($type) . ' ' . esc_attr($class) . '" id="'.esc_attr($uniq_id).'" '.$checked.'>
									<label class="dfd_single_checkbox" for="'.esc_attr($param_name).'" data-value="'.esc_attr($data_val).'">
										<span class="button-animation '.esc_attr($animation_class).'"></span>
									</label>
									<span class="param-title">'.esc_html($label).'</span>
								</div>';
				}
			}
			
			$output .= '<script type="text/javascript">
							jQuery("#'.esc_js($uniq_id).'").next(".dfd_single_checkbox").click(function(){
								var $self = jQuery(this),
									$button = $self.find(".button-animation"),
									$checkbox = $self.siblings("#'.esc_js($uniq_id).'");
										
								$button.toggleClass("right-active");

								if($self.find(".button-animation").hasClass("right-active")) {
									$checkbox.removeAttr("checked").val("");
								} else {
									$checkbox.attr("checked","checked").val($self.data("value"));
								}

								$checkbox.trigger("change");
							});
						</script>';
			
			return $output;
		}
	}
	
	$Dfd_Single_Checkbox_Param = new Dfd_Single_Checkbox_Param();
}