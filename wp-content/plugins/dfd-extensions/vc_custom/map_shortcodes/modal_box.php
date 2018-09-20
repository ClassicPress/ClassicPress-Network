<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: DFD Modal Box for Visual Composer
*/

class WPBakeryShortCode_Dfd_Modal_Box extends WPBakeryShortCodesContainer {}
new dfd_hide_unsuport_module_frontend("dfd_modal_box");
vc_map(
	array(
		'name'					=> esc_html__('Modal Box', 'dfd'),
		'base'					=> 'dfd_modal_box',
		'class'					=> 'dfd_modal_box dfd_shortcode',
		'icon'					=> 'dfd_modal_box dfd_shortcode',
		'category'				=> esc_html__('Native', 'dfd'),
		'content_element'		=> true,
		'js_view'				=> 'VcColumnView',
		'controls'				=> 'full',
		'as_parent'				=> array('except' => array('dfd_modal_box')),
		'params'				=> array(
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Delay: this option allows to set the delay for the modal box displaying.On scroll: this option allows you to show the modal box on scroll','dfd').'</span></span>'.esc_html__('Display options', 'dfd'),
				'param_name'		=> 'display_options',
				'value'				=> 'set_timeout',
				'options'			=> array(
					esc_html__('Delay')	=> 'set_timeout',
					esc_html__('On scroll')	=> 'show_scroll',
					esc_html__('On click')	=> 'on_click',
					
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-12 crum_vc'
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the delay timeout for the modal box','dfd').'</span></span>'.esc_html__('Timeout', 'dfd'),
				'param_name'		=> 'time_output',
				'value'				=> 3000,
				'edit_field_class'	=> 'vc_column vc_col-sm-12 crum_vc dfd-number-ml-second',
				'dependency'		=> array('element' => 'display_options', 'value' => 'set_timeout'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__( 'Extra features', 'dfd' ),
				'param_name'		=> 'extra_features_elements_heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),
			array(
				'type'				=> 'dropdown',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the appear effect for the overlay', 'dfd') . '</span></span>' . esc_html__('Animation', 'dfd'),
				'param_name'		=> 'module_animation',
				'value'				=> Dfd_Theme_Helpers::dfd_module_animation_styles(),
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd').'</span></span>'.esc_html__('Custom CSS Class', 'dfd'),
				'param_name'		=> 'el_class',
			),
			array(
				'type' => 'dfd_video_link_param',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Video tutorial and theme documentation article', 'dfd') . '</span></span>' . esc_html__('Tutorials', 'dfd'),
				'param_name' => 'tutorials',
				'doc_link' => '//nativewptheme.net/support/visual-composer/modal-box',
				'video_link' => 'https://youtu.be/i5yXephy3gE',
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose background for the overlay. The default color is #000','dfd').'</span></span>'.esc_html__('Overlay background', 'dfd'),
				'param_name'		=> 'overlay_bg',
				'edit_field_class'	=> 'vc_column vc_col-sm-12 crum_vc',
				'group'				=> esc_html__('Style', 'dfd')
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Modal box settings', 'dfd-native'),
				'param_name'		=> 'modal_settings',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group'				=> esc_html__('Style', 'dfd-native')
			),	
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the width of the modal box according to the width of the container','dfd').'</span></span>'.esc_html__('Modal Box Size', 'dfd'),
				'param_name'		=> 'modal_box_width',
				'edit_field_class'	=> 'vc_column vc_col-sm-12 crum_vc dfd-number-wrap',
				'group'				=> esc_html__('Style', 'dfd')
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the top/bottom paddings for the modal box. The default value is 30px','dfd-native').'</span></span>'.esc_html__('Top/bottom padding', 'dfd-native'),
				'param_name'		=> 'modal_tb_padding',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
				'group'				=> esc_html__('Style', 'dfd')
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the left/right paddings for the modal box. The default value is 30px','dfd-native').'</span></span>'.esc_html__('Left/right padding', 'dfd-native'),
				'param_name'		=> 'modal_lr_padding',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
				'group'				=> esc_html__('Style', 'dfd')
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose background style for the content','dfd').'</span></span>'.esc_html__('Background', 'dfd'),
				'param_name'		=> 'content_bg',
				'value'				=> 'color-background',
				'options'			=> array(
					esc_html__('Color') => 'color-background',
					esc_html__('Image') => 'image-background',
					
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'group'				=> esc_html__('Style', 'dfd')
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('If you choose Dark background the text colors will be changed to make it more visible','dfd-native').'</span></span>'.esc_html__('Dark background', 'dfd-native'),
				'param_name'		=> 'dark_bg',
				'options'		=> array(
					'bg'			=> array(
						'yes'			=> esc_attr__('Yes', 'dfd-native'),
						'no'			=> esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'group'				=> esc_html__('Style', 'dfd')
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose background color for the content','dfd').'</span></span>'.esc_html__('Color background', 'dfd'),
				'param_name'		=> 'color_background',
				'edit_field_class'	=> 'vc_column vc_col-sm-12 crum_vc',
				'dependency'		=> array('element' => 'content_bg', 'value' => array('color-background')),
				'group'				=> esc_html__('Style', 'dfd')
			),
			array(
				'type'				=> 'attach_image',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose background image for the content','dfd').'</span></span>'.esc_html__('Image background', 'dfd'),
				'param_name'		=> 'image_background',
				'edit_field_class'	=> 'vc_column vc_col-sm-12 crum_vc',
				'dependency'		=> array('element' => 'content_bg', 'value' => array('image-background')),
				'group'				=> esc_html__('Style', 'dfd')
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the style for the modal box border','dfd').'</span></span>'.esc_html__('Modal box border', 'dfd'),
				'param_name'		=> 'modal_border',
				'value'				=> '',
				'options'		=> array(
						esc_html__('None', 'dfd') => '',
						esc_html__('Solid', 'dfd') => 'solid',
						esc_html__('Dashed', 'dfd') => 'dashed',
						esc_html__('Dotted', 'dfd') => 'dotted',
						esc_html__('Inset', 'dfd') => 'inset',
						esc_html__('Outset', 'dfd') => 'outset',
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-12 crum_vc no-border-bottom',
				'group'				=> esc_html__('Style', 'dfd')
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the border width','dfd').'</span></span>'.esc_html__('Border width', 'dfd'),
				'param_name'		=> 'modal_border_width',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap no-border-bottom',
				'dependency'		=> array('element' => 'modal_border', 'not_empty' => true),
				'group'				=> esc_html__('Style', 'dfd')
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border color','dfd').'</span></span>'.esc_html__('Border color', 'dfd'),
				'param_name'		=> 'modal_border_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'dependency'		=> array('element' => 'modal_border', 'not_empty' => true),
				'group'				=> esc_html__('Style', 'dfd')
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> esc_html__('Button text', 'dfd-native'),
				'param_name'		=> 'button_text',
				'value'				=> esc_html__('Button', 'dfd-native'),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom',
				'dependency'		=> array('element' => 'display_options', 'value' => 'on_click'),
				'group'				=> esc_html__('Button settings', 'dfd-native')
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the horizontal alignment for the button','dfd-native').'</span></span>'.esc_html__('Button alignment', 'dfd-native'),
				'param_name'		=> 'button_alignment',
				'value'				=> 'button-center',
				'options'			=> array(
					esc_html__('Center','dfd-native')	=> 'button-center',
					esc_html__('Left','dfd-native')	=> 'button-left',
					esc_html__('Right','dfd-native')	=> 'button-right',
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 no-top-padding no-border-bottom',
				'dependency'		=> array('element' => 'display_options', 'value' => 'on_click'),
				'group'				=> esc_html__('Button settings', 'dfd-native')
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Button paddings', 'dfd-native'),
				'param_name'		=> 'button_heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'dependency'		=> array('element' => 'display_options', 'value' => 'on_click'),
				'group'				=> esc_html__('Button settings', 'dfd-native')
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the left padding for the button. Default value is inherited from Theme Options > General options > Default button options > Default button left padding','dfd-native').'</span></span>'.esc_html__('Left padding', 'dfd-native'),
				'param_name'		=> 'padding_left',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc no-border-bottom',
				'dependency'		=> array('element' => 'display_options', 'value' => 'on_click'),
				'group'				=> esc_html__('Button settings', 'dfd-native')
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the right padding for the button. Default value is inherited from Theme Options > General options > Default button options > Default button right padding','dfd-native').'</span></span>'.esc_html__('Right padding', 'dfd-native'),
				'param_name'		=> 'padding_right',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc no-border-bottom',
				'dependency'		=> array('element' => 'display_options', 'value' => 'on_click'),
				'group'				=> esc_html__('Button settings', 'dfd-native')
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Color settings', 'dfd-native'),
				'param_name'		=> 'color_heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'dependency'		=> array('element' => 'display_options', 'value' => 'on_click'),
				'group'				=> esc_html__('Button settings', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the text color for the button. Default color is inherited from Theme Options > General options > Default button options > Default Button Typography','dfd-native').'</span></span>'.esc_html__('Text color', 'dfd-native'),
				'param_name'		=> 'text_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom',
				'dependency'		=> array('element' => 'display_options', 'value' => 'on_click'),
				'group'				=> esc_html__('Button settings', 'dfd-native')
			),			
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the text hover color for the button. Default color is inherited from Theme Options > General options > Default button options > Default button hover text color','dfd-native').'</span></span>'.esc_html__('Hover text color', 'dfd-native'),
				'param_name'		=> 'text_hover_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom',
				'dependency'		=> array('element' => 'display_options', 'value' => 'on_click'),
				'group'				=> esc_html__('Button settings', 'dfd-native')
			),		
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Background settings', 'dfd-native'),
				'param_name'		=> 'background_heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'dependency'		=> array('element' => 'display_options', 'value' => 'on_click'),
				'group'				=> esc_html__('Button settings', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'param_name'		=> 'background',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the background color for the button. Default color is inherited from Theme Options > General options > Default button options > Default button background color','dfd-native').'</span></span>'.esc_html__('Background color', 'dfd-native'),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom no-bottom-padding',
				'dependency'		=> array('element' => 'display_options', 'value' => 'on_click'),
				'group'				=> esc_html__('Button settings', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'param_name'		=> 'hover_background',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the background hover color for the button. Default color is inherited from Theme Options > General options > Default button options > Default button hover background color','dfd-native').'</span></span>'.esc_html__('Hover Background', 'dfd-native'),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom no-bottom-padding',
				'dependency'		=> array('element' => 'display_options', 'value' => 'on_click'),
				'group'				=> esc_html__('Button settings', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Border settings', 'dfd-native'),
				'param_name'		=> 'border_heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'dependency'		=> array('element' => 'display_options', 'value' => 'on_click'),
				'group'				=> esc_html__('Button settings', 'dfd-native')
			),
			array(
				'type'				=> 'dfd_param_border',
				'heading'			=> esc_html__('Idle Border', 'dfd-native'),
				'param_name'		=> 'border',
				'simple'			=> false,
				'enable_radius'		=> true,
				'edit_field_class'	=> 'dfd-vc-border-param-styles vc_column vc_col-sm-12 no-border-bottom no-bottom-padding',
				'value'				=> 'border_style:default',
				'dependency'		=> array('element' => 'display_options', 'value' => 'on_click'),
				'group'				=> esc_html__('Button settings', 'dfd-native')
			),
			array(
				'type'				=> 'dfd_param_border',
				'heading'			=> esc_html__('Border on hover', 'dfd-native'),
				'param_name'		=> 'hover_border',
				'simple'			=> false,
				'enable_radius'		=> true,
				'value'				=> 'border_style:default',
				'edit_field_class'	=> 'dfd-vc-border-param-styles vc_column vc_col-sm-12 no-border-bottom no-bottom-padding',
				'dependency'		=> array('element' => 'display_options', 'value' => 'on_click'),
				'group'				=> esc_html__('Button settings', 'dfd-native')
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Box shadow settings', 'dfd-native'),
				'param_name'		=> 'shadow_heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'dependency'		=> array('element' => 'display_options', 'value' => 'on_click'),
				'group'				=> esc_html__('Button settings', 'dfd-native')
			),
			array(
				'type'				=> 'dfd_box_shadow_param',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the shadow for the button','dfd-native').'</span></span>'.esc_html__('Box Shadow', 'dfd-native'),
				'param_name'		=> 'box_shadow',
				'dependency'		=> array('element' => 'display_options', 'value' => 'on_click'),
				'group'				=> esc_html__('Button settings', 'dfd-native')
			),
			array(
				'type'				=> 'dfd_box_shadow_param',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the shadow for the button on hover','dfd-native').'</span></span>'.esc_html__('Box Shadow on Hover', 'dfd-native'),
				'param_name'		=> 'hover_box_shadow',
				'dependency'		=> array('element' => 'display_options', 'value' => 'on_click'),
				'group'				=> esc_html__('Button settings', 'dfd-native')
			),
			array(
				'type'				=> 'dropdown',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the appear effect for the button', 'dfd') . '</span></span>' . esc_html__('Button animation', 'dfd'),
				'param_name'		=> 'button_animation',
				'value'				=> Dfd_Theme_Helpers::dfd_module_animation_styles(),
				'edit_field_class'	=> 'vc_column vc_col-sm-12 crum_vc no-border-bottom',
				'dependency'		=> array('element' => 'display_options', 'value' => 'on_click'),
				'group'				=> esc_html__('Button settings', 'dfd-native')
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Typography settings', 'dfd-native'),
				'param_name'		=> 'typography_heading',
				'group'				=> esc_html__('Typography', 'dfd-native'),
				'dependency'		=> array('element' => 'button_text', 'not_empty' => true),
				'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'				=> 'dfd_font_container',
				'param_name'		=> 'button_font_options',
				'settings'			=> array(
					'fields'			=> array(
						'font_size',
						'letter_spacing',
						'line_height',
						'font_style',
					),
				),
				'dependency'		=> array('element' => 'button_text', 'not_empty' => true),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'param_name'		=> 'button_google_fonts',
				'options'			=> array(
					'yes'				=> array(
						'yes'				=> esc_attr__('Yes', 'dfd-native'),
						'no'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'dependency'		=> array('element' => 'button_text', 'not_empty' => true),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'google_fonts',
				'param_name'		=> 'button_custom_fonts',
				'settings'			=> array(
					'fields'			=> array(
						'font_family_description' => esc_html__('Select font family.', 'dfd-native'),
						'font_style_description'  => esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'dependency'		=> array('element' => 'button_google_fonts', 'value' => 'yes'),
				'edit_field_class'	=> 'no-top-margin vc_column vc_col-sm-12',
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
		)
	)
);