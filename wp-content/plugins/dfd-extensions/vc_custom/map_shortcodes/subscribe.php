<?php //
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Clients Testimonials
*/

class WPBakeryShortCode_Dfd_Subscribe extends WPBakeryShortCode {}

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/subscribe/';
vc_map(
	array(
	   'name'				=> esc_html__('Subscribe','dfd-native'),
	   'base'				=> 'dfd_subscribe',
	   'class'				=> 'dfd_subscribe dfd_shortcode',
	   'icon'				=> 'dfd_subscribe dfd_shortcode',
	   'category'			=> esc_html__('Native','dfd-native'),
	   'description'		=> esc_html__('Allows you to display the subscribe form','dfd-native'),
	   'params'				=> array(
			array(
				'heading'			=> esc_html__( 'Style', 'dfd-native' ),
				'type'				=> 'radio_image_select',
				'param_name'		=> 'main_style',
				'simple_mode'		=> false,
				'options'			=> array(
					'style-1'	=> array(
						'tooltip'	=> esc_html__('Standard','dfd-native'),
						'src'		=> $module_images . 'style-1.png'
					),
					'style-2'	=> array(
						'tooltip'	=> esc_html__('Inside','dfd-native'),
						'src'		=> $module_images . 'style-2.png'
					),
					'style-3'	=> array(
						'tooltip'	=> esc_html__('Separated','dfd-native'),
						'src'		=> $module_images . 'style-3.png'
					),
					'style-4'	=> array(
						'tooltip'	=> esc_html__('Simple','dfd-native'),
						'src'		=> $module_images . 'style-4.png'
					),
					'style-5'	=> array(
						'tooltip'	=> esc_html__('Animated','dfd-native'),
						'src'		=> $module_images . 'style-5.png'
					),
				),
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> esc_html__('Placeholder','dfd-native'),
				'param_name'		=> 'subscribe_module_placeholder',
				'value'				=> esc_html__('Placeholder','dfd-native'),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> esc_html__('Button text','dfd-native'),
				'param_name'		=> 'button_text',
				'admin_label'		=> true,
				'value'				=> 'Subscribe',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> esc_html__('Feedburner feed name', 'dfd-native'),
				'param_name'		=> 'subscribe_module_feed_name',
				'value'				=> 'your@mail',
				'admin_label'		=> true,
				'description'		=> esc_html__('Read more how to setup', 'dfd-native') .' <a href="https://support.google.com/feedburner/answer/78978" target="_blank"> '.esc_html__('Adding FeedBurner Email', 'dfd-native').'</a>',
			),
		   array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Extra features', 'dfd-native' ),
				'param_name'       => 'extra_features_elements_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),
			array(
				'type'				=> 'dropdown',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd-native').'</span></span>'.esc_html__( 'Animation', 'dfd-native' ),
				'param_name'		=> 'module_animation',
				'value'				=> Dfd_Theme_Helpers::dfd_module_animation_styles(),
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd-native').'</span></span>'.esc_html__('Custom CSS Class', 'dfd-native'),
				'param_name'		=> 'el_class',
			),
		   array(
				'type' => 'dfd_video_link_param',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Video tutorial and theme documentation article', 'dfd-native') . '</span></span>' . esc_html__('Tutorials', 'dfd-native'),
				'param_name' => 'tutorials',
				'doc_link' => '//nativewptheme.net/support/visual-composer/subscribe',
				'video_link' => 'https://www.youtube.com/watch?v=Ke4GCz9bZAw&feature=youtu.be',
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Main Styles', 'dfd-native'),
				'param_name'		=> 'field_and_button_styles',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the border radius for the field and button','dfd-native').'</span></span>'.esc_html__('Field & button border radius ', 'dfd-native'),
				'param_name'		=> 'border_radius',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc no-border-bottom',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to set the full width subscribe form according to the row/column width','dfd-native').'</span></span>'.esc_html__('Full width', 'dfd-native'),
				'param_name'		=> 'full_width_style',
				'options'			=> array(
					'full_width'		=> array(
						'on'				=> esc_attr__('Yes', 'dfd-native'),
						'off'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-1', 'style-3', 'style-4')),
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dropdown',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the horizontal alignment for the subscribe button','dfd-native').'</span></span>'.esc_html__('Alignment', 'dfd-native'),
				'param_name'		=> 'field_alignment',
				'value'				=> array(
					esc_html__('Center','dfd-native')	=> 'align-center',
					esc_html__('Left','dfd-native')	=> 'align-left',
					esc_html__('Right','dfd-native')	=> 'align-right',
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-5')),
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Field Styles', 'dfd-native'),
				'param_name'		=> 'field_styles',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the text color for the text typed in the field. The default value is #28262b','dfd-native').'</span></span>'.esc_html__('Text color', 'dfd-native'),
				'param_name'		=> 'field_text_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the placeholder text, the text you see before typing. The default value is #28262b','dfd-native').'</span></span>'.esc_html__('Placeholder color', 'dfd-native'),
				'param_name'		=> 'placeholder_field_text_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the field. The default value is #f2f2f2. The background color for the style Simple is not set','dfd-native').'</span></span>'.esc_html__('Background', 'dfd-native'),
				'param_name'		=> 'field_bg_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc no-border-bottom',
				'group'				=> esc_html__( 'Style', 'dfd-native' ),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the border width for the field. The default border width is 1px','dfd-native').'</span></span>'.esc_html__('Border width', 'dfd-native'),
				'param_name'		=> 'field_border_width',
				'edit_field_class'	=> 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc no-border-bottom',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the border color for the field. The default border color is #e7e7e7','dfd-native').'</span></span>'.esc_html__('Border color', 'dfd-native'),
				'param_name'		=> 'field_border_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc no-border-bottom',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Button Styles', 'dfd-native'),
				'param_name'		=> 'button_styles',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group'				=> esc_html__( 'Style', 'dfd-native' ),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the text color for the button\'s text. The default value is #fff','dfd-native').'</span></span>'.esc_html__('Text color', 'dfd-native'),
				'param_name'		=> 'button_element_color',
				'value'				=> '#ffffff',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the text hover color for the button\'s text. The default value is #fff','dfd-native').'</span></span>'.esc_html__('Text hover color', 'dfd-native'),
				'param_name'		=> 'button_element_hover_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the button. The default color is inherited from Theme Options > Styling Options > Main site color','dfd-native').'</span></span>'.esc_html__('Background', 'dfd-native'),
				'param_name'		=> 'button_background',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background hover color for the button. The default color is inherited from Theme Options > Styling Options > Main site color with box shadow','dfd-native').'</span></span>'.esc_html__('Background hover', 'dfd-native'),
				'param_name'		=> 'button_hover_background',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
		),
	)
);