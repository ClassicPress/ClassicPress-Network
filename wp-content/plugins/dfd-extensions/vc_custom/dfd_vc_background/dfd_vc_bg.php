<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(!class_exists('Dfd_VC_Row_Background')) {
	class Dfd_VC_Row_Background {
		
		private $base_dir = '/vc_custom/dfd_vc_background/';
				
		function get_template_names() {
			$dir = DFD_EXTENSIONS_PLUGIN_PATH.$this->base_dir . 'admin_templates';
			if(!$dir) return;

			if(is_dir($dir)) {
				$options_array = array(
					esc_attr__('None','dfd-native') => ''
				);
				$dir_content = scandir($dir);
				if(!empty($dir_content) && is_array($dir_content)) {
					foreach($dir_content as $item) {
						if(substr_count($item, '.php') == 1) {
							$val = substr($item, 0, -4);
							$options_array[$val] = $val;
						}
					}
				}
				return $options_array;
			}
			return;
		}

		function get_template_files() {
			$dir = DFD_EXTENSIONS_PLUGIN_PATH.$this->base_dir . 'admin_templates';
			
			if(!$dir) return false;
			
			if(is_dir($dir)) {
				foreach(glob($dir.'/*.php') as $file) {
					require_once($file);
				}
				if(isset($row_params) && is_array($row_params)) return $row_params;
			}
			return false;
		}
		
		public function build_backend_options() {
			$bg_variants = $this->get_template_names();
			
			$patterns_list = glob(DFD_EXTENSIONS_PLUGIN_PATH.$this->base_dir.'patterns/*.*');
			$patterns = array();
			
			foreach($patterns_list as $pattern)
				$patterns[basename($pattern)] = DFD_EXTENSIONS_PLUGIN_URL.$this->base_dir.'patterns/'.basename($pattern);

			if(!$bg_variants) return false;

			$row_params = array();
			$row_params[] = array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Background settings', 'dfd-native'),
				'param_name' => 'bg_main',
				'class' => '',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group' => esc_attr__('Background options', 'dfd-native')
			);
			$row_params[] = array(
				'type' => 'dfd_radio_advanced',
				'class' => '',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background style for the row. The text colors will be changed according to the style you choose to make it more readable','dfd-native').'</span></span>'.esc_html__('Row Background Style', 'dfd-native'),
				'param_name' => 'bg_check',
				'value' => '',
				'options' => array(
					esc_attr__('Light', 'dfd-native') => '',
					esc_attr__('Dark', 'dfd-native') => 'row-background-dark'
				),
				'group' => esc_attr__('Background options', 'dfd-native')
			);
			$row_params[] = array(
				'type' => 'dfd_radio_advanced',
				'class' => '',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background style for the row. Animated allows you to add colors changing effect. Canvas allows you to choose one of the following mouse animations. 3 canvas styles are available. Gradient allows you to set the gradient backgrouns. Image allows you to upload the image and add the parallax. Video allows you to set the video as row\'s background','dfd-native').'</span></span>'.esc_attr__('Background style', 'dfd-native'),
				'param_name' => 'dfd_bg_style',
				'value' => '',
				'options' => $bg_variants,
				'edit_field_class'	=> 'vc_column vc_col-sm-12 dfd-text-capitalize',
				'group' => esc_attr__('Background options', 'dfd-native')
			);
			$include_params = $this->get_template_files();
			if($include_params && is_array($include_params)) {
				foreach($include_params as $param) {
					$row_params[] = $param;
				}
			}
			$row_params[] = array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Overlay settings', 'dfd-native'),
				'param_name' => 'bg_overlay',
				'class' => '',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group' => esc_attr__('Background options', 'dfd-native')
			);
			$row_params[] = array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the overlay for the row','dfd-native').'</span></span>'.__('Overlay', 'dfd-native'),
				'param_name' => 'dfd_enable_overlay',
				'value' => '',
				'options' => array(
					'yes' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'group' => esc_attr__('Background options', 'dfd-native'),
			);
			$row_params[] = array(
				'type' => 'colorpicker',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the overlay','dfd-native').'</span></span>'.__('Color', 'dfd-native'),
				'param_name' => 'dfd_overlay_color',
				'value' => '',
				'group' => esc_attr__('Background options', 'dfd-native'),
				'dependency' => Array('element' => 'dfd_enable_overlay', 'value' => array('yes')),
			);
			$row_params[] = array(
				'type' => 'radio_image_box',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the pattern for the overlay','dfd-native').'</span></span>'.__('Pattern','dfd-native'),
				'param_name' => 'dfd_overlay_pattern',
				'value' => '',
				'options' => $patterns,
				'css' => array(
					'width' => '40px',
					'height' => '35px',
					'background-repeat' => 'repeat',
					'background-size' => 'cover' 
				),
				'group' => esc_attr__('Background options', 'dfd-native'),
				'dependency' => Array('element' => 'dfd_enable_overlay', 'value' => array('yes'))
			);
			$row_params[] = array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to controll the pattern\'s opacity for the overlay. Enter value between 0 to 100 (0 is transparent)','dfd-native').'</span></span>'.__('Pattern Opacity','dfd-native'),
				'param_name' => 'dfd_overlay_pattern_opacity',
				'value' => '80',
				'min' => '0',
				'max' => '100',
				'suffix' => '%',
				'group' => esc_attr__('Background options', 'dfd-native'),
				'dependency' => Array('element' => 'dfd_enable_overlay', 'value' => array('yes')),
				'description' => esc_html__('Enter value between 0 to 100 (0 is maximum transparency, while 100 is minimum)','dfd-native')
			);
			$row_params[] = array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the pattern\'s size for the overlay','dfd-native').'</span></span>'.__('Pattern Size','dfd-native'),
				'param_name' => 'dfd_overlay_pattern_size',
				'value' => '',
				'suffix' => 'px',
				'group' => esc_attr__('Background options', 'dfd-native'),
				'dependency' => Array('element' => 'dfd_enable_overlay', 'value' => array('yes')),
			);

			vc_add_params('vc_row',$row_params);
		}
	}
	
	$Dfd_VC_Row_Background = new Dfd_VC_Row_Background;
}